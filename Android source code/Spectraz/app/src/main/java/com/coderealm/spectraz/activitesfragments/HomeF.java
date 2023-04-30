package com.coderealm.spectraz.activitesfragments;


import android.app.Activity;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.graphics.Bitmap;
import android.os.Bundle;

import com.coderealm.spectraz.activitesfragments.livestreaming.activities.LiveUsersA;
import com.coderealm.spectraz.activitesfragments.profile.ProfileA;
import com.coderealm.spectraz.adapters.HomeSuggestionAdapter;
import com.coderealm.spectraz.adapters.ViewPagerStatAdapter;
import com.coderealm.spectraz.Constants;
import com.coderealm.spectraz.mainmenu.MainMenuActivity;
import com.coderealm.spectraz.simpleclasses.DebounceClickHandler;
import com.coderealm.spectraz.simpleclasses.VerticalViewPager;
import com.volley.plus.interfaces.APICallBack;
import com.coderealm.spectraz.interfaces.AdapterClickListener;
import com.coderealm.spectraz.models.FollowingModel;
import com.coderealm.spectraz.models.HomeModel;
import com.coderealm.spectraz.models.UserModel;
import com.coderealm.spectraz.services.UploadService;
import com.coderealm.spectraz.apiclasses.ApiLinks;
import com.volley.plus.VPackages.VolleyRequest;
import com.volley.plus.interfaces.Callback;

import androidx.activity.result.ActivityResult;
import androidx.activity.result.ActivityResultCallback;
import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.annotation.Nullable;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;
import androidx.viewpager.widget.ViewPager;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.RelativeLayout;
import android.widget.TextView;
import com.coderealm.spectraz.R;
import com.coderealm.spectraz.interfaces.FragmentCallBack;
import com.coderealm.spectraz.simpleclasses.DataParsing;
import com.coderealm.spectraz.simpleclasses.Functions;
import com.coderealm.spectraz.simpleclasses.Variables;
import com.google.android.gms.ads.AdListener;
import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.InterstitialAd;
import com.yarolegovich.discretescrollview.DSVOrientation;
import com.yarolegovich.discretescrollview.DiscreteScrollView;
import com.yarolegovich.discretescrollview.InfiniteScrollAdapter;
import com.yarolegovich.discretescrollview.transform.ScaleTransformer;
import org.json.JSONArray;
import org.json.JSONObject;
import java.util.ArrayList;
import java.util.Collections;

import io.paperdb.Paper;

/**
 * A simple {@link Fragment} subclass.
 */

// this is the main view which is show all  the video in list
public class HomeF extends Fragment implements FragmentCallBack {

    View view;
    Context context;
    ArrayList<HomeModel> dataList=new ArrayList<>();
    SwipeRefreshLayout swiperefresh;
    TextView followingBtn, relatedBtn, liveUsers;
    String type = "related";
    DiscreteScrollView rvSugesstion;
    HomeSuggestionAdapter adapterSuggestion;
    RelativeLayout tabPlaylist;
    View tabSneekbarView;
    TextView tvPlaylistTitle;

    public HomeF() {

    }


    public static HomeF newInstance() {
        HomeF fragment = new HomeF();
        Bundle args = new Bundle();
        fragment.setArguments(args);
        return fragment;
    }


    int page_count = 0;
    boolean isApiRuning = false;
    Handler handler;
    FrameLayout tabNoFollower;
    RelativeLayout uploadVideoLayout;
    ImageView uploadingThumb;
    private static ProgressBar progressBar;
    private static TextView tvProgressCount;
    UploadingVideoBroadCast mReceiver;

    @Override
    public void onResponce(Bundle bundle) {
        if (bundle != null && bundle.get("action").equals("showad")) {
            showCustomAd();
        } else if (bundle != null && bundle.get("action").equals("hidead")) {
            hideCustomad();
        }
        else if (bundle != null && bundle.get("action").equals("removeList")) {
            pagerSatetAdapter.removeFragment(menuPager.getCurrentItem());
            dataList.remove(menuPager.getCurrentItem());
        }
    }

    private class UploadingVideoBroadCast extends BroadcastReceiver {

        @Override
        public void onReceive(Context context, Intent intent) {

            if (Functions.isMyServiceRunning(context, UploadService.class)) {
                uploadVideoLayout.setVisibility(View.VISIBLE);
                Bitmap bitmap = Functions.base64ToBitmap(Functions.getSharedPreference(context).getString(Variables.UPLOADING_VIDEO_THUMB, ""));
                if (bitmap != null)
                    uploadingThumb.setImageBitmap(bitmap);

            } else {
                uploadVideoLayout.setVisibility(View.GONE);
            }

        }
    }


    public static FragmentCallBack uploadingCallback=new FragmentCallBack() {
        @Override
        public void onResponce(Bundle bundle) {
            if (bundle.getBoolean("isShow"))
            {
                int currentProgress=bundle.getInt("currentpercent",0);
                if (progressBar!=null && tvProgressCount!=null)
                {

                    progressBar.setProgress(currentProgress);
                    tvProgressCount.setText(currentProgress+"%");
                }
            }
        }
    };


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        view = inflater.inflate(R.layout.fragment_home, container, false);
        context = getContext();
        oldSwipeValue = Constants.SHOW_AD_ON_EVERY;

        handler = new Handler(Looper.getMainLooper());
        tvProgressCount=view.findViewById(R.id.tvProgressCount);
        progressBar=view.findViewById(R.id.progressBar);
        followingBtn = view.findViewById(R.id.following_btn);
        relatedBtn = view.findViewById(R.id.related_btn);
        tabNoFollower=view.findViewById(R.id.tabNoFollower);
        tvPlaylistTitle=view.findViewById(R.id.tvPlaylistTitle);
        tabSneekbarView=view.findViewById(R.id.tabSneekbarView);
        tabPlaylist=view.findViewById(R.id.tabPlaylist);
        liveUsers = view.findViewById(R.id.live_users);
        swiperefresh = view.findViewById(R.id.swiperefresh);
        liveUsers.setOnClickListener(new DebounceClickHandler(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                onPause();
                Intent intent=new Intent(view.getContext(), LiveUsersA.class);
                startActivity(intent);
                getActivity().overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
            }
        }));
        tabPlaylist.setOnClickListener(new DebounceClickHandler(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                openPlaylist();
            }
        }));
        followingBtn.setOnClickListener(new DebounceClickHandler(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (Functions.checkLoginUser(getActivity())) {
                    type = "following";
                    swiperefresh.setRefreshing(true);
                    relatedBtn.setTextColor(ContextCompat.getColor(context,R.color.graycolor2));
                    followingBtn.setTextColor(ContextCompat.getColor(context,R.color.whiteColor));
                    page_count = 0;
                    oldSwipeValue = Constants.SHOW_AD_ON_EVERY;
                    dataList.clear();
                    callVideoApi();
                }
            }
        }));
        relatedBtn.setOnClickListener(new DebounceClickHandler(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                type = "related";
                swiperefresh.setRefreshing(true);
                relatedBtn.setTextColor(ContextCompat.getColor(context,R.color.whiteColor));
                followingBtn.setTextColor(ContextCompat.getColor(context,R.color.graycolor2));
                page_count = 0;
                oldSwipeValue = Constants.SHOW_AD_ON_EVERY;
                dataList.clear();
                callVideoApi();
            }
        }));

        swiperefresh.setProgressViewOffset(false, 0, 200);
        swiperefresh.setColorSchemeResources(R.color.black);
        swiperefresh.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                page_count = 0;
                oldSwipeValue = Constants.SHOW_AD_ON_EVERY;
                dataList.clear();
                callVideoApi();
            }
        });


        if (!Constants.IS_REMOVE_ADS)
            loadAdd();

        uploadVideoLayout = view.findViewById(R.id.upload_video_layout);
        uploadingThumb = view.findViewById(R.id.uploading_thumb);
        mReceiver = new UploadingVideoBroadCast();
        getActivity().registerReceiver(mReceiver, new IntentFilter("uploadVideo"));



        if (Functions.isMyServiceRunning(context, UploadService.class)) {
            uploadVideoLayout.setVisibility(View.VISIBLE);
            Bitmap bitmap = Functions.base64ToBitmap(Functions.getSharedPreference(context).getString(Variables.UPLOADING_VIDEO_THUMB, ""));
            if (bitmap != null)
                uploadingThumb.setImageBitmap(bitmap);
        }
        else
        {
            uploadVideoLayout.setVisibility(View.GONE);
        }


        setTabs(true);
        callVideoApi();

        return view;
    }


    // set the fragments for all the videos list

    int oldSwipeValue = 0;
    protected VerticalViewPager menuPager;
    ViewPagerStatAdapter pagerSatetAdapter;


    public void setTabs(boolean isFirstTime) {
        dataList.clear();
        if (isFirstTime)
        {
            try {
                if (Paper.book(Variables.PromoAds).contains(Variables.PromoAdsModel))
                {
                    HomeModel item=Paper.book(Variables.PromoAds).read(Variables.PromoAdsModel);
                    dataList.add(item);
                }
            }catch (Exception e)
            {
                Log.d(Constants.tag,"Exception: "+e);
            }
        }


        pagerSatetAdapter = new ViewPagerStatAdapter(getChildFragmentManager(),menuPager,isFirstTime,this::onResponce);
        menuPager =  view.findViewById(R.id.viewpager);
        menuPager.setAdapter(pagerSatetAdapter);
        menuPager.setOffscreenPageLimit(1);
        menuPager.setOnPageChangeListener(new ViewPager.OnPageChangeListener() {
            @Override
            public void onPageScrolled(int position, float positionOffset, int positionOffsetPixels) {

            }

            @Override
            public void onPageSelected(int position) {
                if (position==0)
                {
                    swiperefresh.setEnabled(true);
                }
                else
                {
                    swiperefresh.setEnabled(false);
                }
                if (position == 0 && (pagerSatetAdapter !=null && pagerSatetAdapter.getCount()>0)) {
                    VideosListF fragment = (VideosListF) pagerSatetAdapter.getItem(menuPager.getCurrentItem());
                    fragment.setData();
                    new Handler(Looper.getMainLooper()).postDelayed(new Runnable() {
                        @Override
                        public void run() {
                            fragment.setPlayer(is_visible_to_user);
                        }
                    }, 200);

                }

                updatePlaylistView();


                if (dataList.size() > 5 && (dataList.size() -5) == (position+1)) {
                    if(!isApiRuning) {
                        page_count++;
                        callVideoApi();
                    }
                }


                if ((position+1)==oldSwipeValue) {

                    oldSwipeValue=(position+1)+Constants.SHOW_AD_ON_EVERY;
                    showAdd();
                }
            }

            @Override
            public void onPageScrollStateChanged(int state) {

            }
        });

    }

    private void updatePlaylistView() {
        try {
            if (dataList.get(menuPager.getCurrentItem()).playlistId.equals("0"))
            {
                tabPlaylist.setVisibility(View.GONE);
                tabSneekbarView.setVisibility(View.GONE);
            }
            else
            {
                tvPlaylistTitle.setText(context.getString(R.string.playlist)+" . "+dataList.get(menuPager.getCurrentItem()).playlistName);
                tabPlaylist.setVisibility(View.VISIBLE);
                tabSneekbarView.setVisibility(View.VISIBLE);
            }
        }
        catch (Exception e){
            tabPlaylist.setVisibility(View.GONE);
            tabSneekbarView.setVisibility(View.GONE);
        }
    }


    private void openPlaylist() {
        HomeModel itemUpdate=dataList.get(menuPager.getCurrentItem());
        ShowHomePlaylistF fragment = new ShowHomePlaylistF(itemUpdate.video_id,itemUpdate.playlistId, itemUpdate.user_id, itemUpdate.playlistName, new FragmentCallBack() {
            @Override
            public void onResponce(Bundle bundle) {
                if (bundle.getBoolean("isShow",false))
                {
                    if (bundle.getString("type").equalsIgnoreCase("videoPlay"))
                    {
                        int playlistVideoPosition=bundle.getInt("position",0);
                        openPlaylistVideo(itemUpdate.playlistId,itemUpdate.playlistName,itemUpdate.user_id,playlistVideoPosition);
                    }
                }
            }
        });
        fragment.show(getActivity().getSupportFragmentManager(), "ShowHomePlaylistF");
    }

    // open the videos in full screen on click
    private void openPlaylistVideo(String id,String playlistName,String userId,int position) {

        Intent intent = new Intent(getActivity(), WatchVideosA.class);
        intent.putExtra("playlist_id", id);
        intent.putExtra("position", position);
        intent.putExtra("pageCount","0" );
        intent.putExtra("userId",userId);
        intent.putExtra("playlistName",playlistName);
        intent.putExtra("whereFrom","playlistVideo");
        resultInfoAgainCallback.launch(intent);
    }

    ActivityResultLauncher<Intent> resultInfoAgainCallback = registerForActivityResult(
            new ActivityResultContracts.StartActivityForResult(), new ActivityResultCallback<ActivityResult>() {
                @Override
                public void onActivityResult(ActivityResult result) {
                    if (result.getResultCode() == Activity.RESULT_OK) {
                        Intent data = result.getData();
                        if (data.getBooleanExtra("isShow",false))
                        {

                        }
                    }
                }
            });




    ArrayList<FollowingModel> suggestionList=new ArrayList<>();
    private InfiniteScrollAdapter<?> infiniteAdapter;
    private void setUpSuggestionRecyclerview() {
        rvSugesstion=view.findViewById(R.id.rvSugesstion);


        rvSugesstion.setOrientation(DSVOrientation.HORIZONTAL);
        adapterSuggestion=new HomeSuggestionAdapter(suggestionList, new AdapterClickListener() {
            @Override
            public void onItemClick(View view, int postion, Object object) {
                FollowingModel item= (FollowingModel) object;
                if (view.getId()==R.id.tvFollowBtn)
                {
                    if (Functions.checkLoginUser(getActivity()))
                    {
                        followSuggestedUser(item.fb_id,postion);
                    }

                }
                else
                if (view.getId()==R.id.user_image)
                {
                    Intent intent=new Intent(view.getContext(), ProfileA.class);
                    intent.putExtra("user_id", item.fb_id);
                    intent.putExtra("user_name", item.username);
                    intent.putExtra("user_pic", item.profile_pic);
                    startActivity(intent);
                    getActivity().overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
                }
                else
                if (view.getId()==R.id.ivCross)
                {
                    suggestionList.remove(postion);
                    adapterSuggestion.notifyDataSetChanged();
                }
            }
        });
        infiniteAdapter = InfiniteScrollAdapter.wrap(adapterSuggestion);
        rvSugesstion.setAdapter(infiniteAdapter);
        rvSugesstion.setItemTransitionTimeMillis(150);
        rvSugesstion.setItemTransformer(new ScaleTransformer.Builder()
                .setMinScale(0.8f)
                .build());

        if (suggestionList.isEmpty())
        {
            getSuggestionUserList();
        }

    }

    private void getSuggestionUserList() {
        JSONObject parameters = new JSONObject();
        try {
            parameters.put("user_id", Functions.getSharedPreference(context).getString(Variables.U_ID, "0"));
            parameters.put("starting_point", "0");
        } catch (Exception e) {
            e.printStackTrace();
        }


        VolleyRequest.JsonPostRequest(getActivity(), ApiLinks.showSuggestedUsers, parameters,Functions.getHeaders(getActivity()), new Callback() {
            @Override
            public void onResponce(String resp) {
                Functions.checkStatus(getActivity(),resp);

                suggestionList.clear();

                try {
                    JSONObject jsonObject = new JSONObject(resp);
                    String code = jsonObject.optString("code");
                    if (code.equals("200")) {
                        JSONArray msgArray = jsonObject.getJSONArray("msg");
                        for (int i = 0; i < msgArray.length(); i++) {

                            JSONObject object = msgArray.optJSONObject(i);
                            JSONArray videoArray = object.getJSONArray("Video");
                            UserModel userDetailModel= DataParsing.getUserDataModel(object.optJSONObject("User"));

                            FollowingModel item = new FollowingModel();
                            item.fb_id = userDetailModel.getId();
                            item.first_name = userDetailModel.getFirstName();
                            item.last_name =userDetailModel.getLastName();
                            item.bio = userDetailModel.getBio();
                            item.username = userDetailModel.getUsername();

                            item.profile_pic = userDetailModel.getProfilePic();

                            item.follow_status_button = "follow";

                            if (videoArray.length()>0)
                            {
                                item.gifLink=videoArray.getJSONObject(0).optString("gif");
                            }
                            else
                            {
                                item.gifLink="";
                            }


                            suggestionList.add(item);
                            adapterSuggestion.notifyDataSetChanged();
                        }

                        if (suggestionList.isEmpty())
                        {
                            view.findViewById(R.id.tvNoSuggestionFound).setVisibility(View.VISIBLE);
                        }
                        else
                        {
                            view.findViewById(R.id.tvNoSuggestionFound).setVisibility(View.GONE);
                        }

                    } else {
                        view.findViewById(R.id.tvNoSuggestionFound).setVisibility(View.VISIBLE);
                    }




                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        });
    }

    private void followSuggestedUser(String userId,int position) {
        Functions.callApiForFollowUnFollow(getActivity(),
                Functions.getSharedPreference(context).getString(Variables.U_ID, ""),
                userId,
                new APICallBack() {
                    @Override
                    public void arrayData(ArrayList arrayList) {
                    }

                    @Override
                    public void onSuccess(String responce) {

                        suggestionList.remove(position);
                        adapterSuggestion.notifyDataSetChanged();
                        callVideoApi();
                    }

                    @Override
                    public void onFail(String responce) {

                    }

                });

    }


    @Override
    public void onPause() {
        super.onPause();

        if(pagerSatetAdapter !=null && pagerSatetAdapter.getCount()>0) {

            VideosListF fragment = (VideosListF) pagerSatetAdapter.getItem(menuPager.getCurrentItem());
            fragment.mainMenuVisibility(false);
        }

    }

    public void callVideoApi() {
        isApiRuning = true;
        if (type.equalsIgnoreCase("following")) {

            callApiForGetFollowingvideos();
        }
        else {

            callApiForGetAllvideos();
        }
    }


    // api for get the videos list from server
    private void callApiForGetAllvideos() {
        JSONObject parameters = new JSONObject();
        try {

            if (Functions.getSharedPreference(context).getString(Variables.U_ID, null) != null) {
                parameters.put("user_id", Functions.getSharedPreference(context).getString(Variables.U_ID, "0"));
            }
            parameters.put("device_id", Functions.getSharedPreference(context).getString(Variables.DEVICE_ID, "0"));
            parameters.put("starting_point", "" + page_count);

        }
        catch (Exception e) {
            e.printStackTrace();
        }

        VolleyRequest.JsonPostRequest(getActivity(), ApiLinks.showRelatedVideos, parameters, Functions.getHeaders(getActivity()),new Callback() {
            @Override
            public void onResponce(String resp) {
                Functions.checkStatus(getActivity(),resp);
                swiperefresh.setRefreshing(false);
                parseData(resp);
            }
        });


    }

    // call the api for get the api list of the follower user list
    private void callApiForGetFollowingvideos() {

        JSONObject parameters = new JSONObject();
        try {

            if (Functions.getSharedPreference(context).getString(Variables.U_ID, null) != null)
                parameters.put("user_id", Functions.getSharedPreference(context).getString(Variables.U_ID, "0"));

            parameters.put("device_id", Functions.getSharedPreference(context).getString(Variables.DEVICE_ID, "0"));
            parameters.put("starting_point", "" + page_count);

        }

        catch (Exception e) {
            e.printStackTrace();
        }

        VolleyRequest.JsonPostRequest(getActivity(), ApiLinks.showFollowingVideos, parameters,Functions.getHeaders(getActivity()), new Callback() {
            @Override
            public void onResponce(String resp) {
                Functions.checkStatus(getActivity(),resp);
                swiperefresh.setRefreshing(false);
                parseData(resp);
            }
        });


    }


    // parse the list of the videos
    public void parseData(String responce) {
        try {
            JSONObject jsonObject = new JSONObject(responce);
            String code = jsonObject.optString("code");

            if (code.equals("200")) {
                JSONArray msgArray = jsonObject.getJSONArray("msg");

                ArrayList<HomeModel> temp_list = new ArrayList();
                for (int i = 0; i < msgArray.length(); i++) {
                    JSONObject itemdata = msgArray.optJSONObject(i);

                    JSONObject video = itemdata.optJSONObject("Video");
                    JSONObject sound = itemdata.optJSONObject("Sound");
                    JSONObject user = itemdata.optJSONObject("User");
                    JSONObject userPrivacy = user.optJSONObject("PrivacySetting");
                    JSONObject pushNotification = user.optJSONObject("PushNotification");

                    HomeModel item = Functions.parseVideoData(user, sound, video, userPrivacy, pushNotification);

                    if (item.username!=null && !(item.username.equals("null")))
                    {
                          if (Constants.IS_DEMO_APP) {
                        if (i < Constants.DEMO_APP_VIDEOS_COUNT)
                            temp_list.add(item);
                    }
                    else {
                        temp_list.add(item);
                    }

                    }



                }

                Collections.shuffle(temp_list);


                if(dataList.isEmpty()){
                    setTabs(false);
                }
                dataList.addAll(temp_list);

                for (HomeModel item : temp_list) {
                    pagerSatetAdapter.addFragment(new VideosListF(false,item,menuPager, this,R.id.mainMenuFragment), "");
                }
                pagerSatetAdapter.refreshStateSet(false);
                pagerSatetAdapter.notifyDataSetChanged();
                if (!(swiperefresh.isEnabled()))
                {swiperefresh.setEnabled(false);}

                tabNoFollower.setVisibility(View.GONE);
                menuPager.setVisibility(View.VISIBLE);

            } else {
                hideCustomad();
                if (dataList.isEmpty() && type.equalsIgnoreCase("following")) {
                    Functions.showToast(getActivity(), view.getContext().getString(R.string.follow_an_account_to_see_there_video_here));
                    tabNoFollower.setVisibility(View.VISIBLE);
                    menuPager.setVisibility(View.GONE);
                    onPause();
                    swiperefresh.setEnabled(false);
                    setUpSuggestionRecyclerview();
                }
            }
        } catch (Exception e) {
            Log.d(Constants.tag,"Exception: showRelatedVideos "+e);

            if(page_count>0)
                page_count--;

        } finally {
            isApiRuning = false;
            updatePlaylistView();
        }

    }

    private static int callbackVideoLisCode=3292;
    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode==callbackVideoLisCode)
        {
            Bundle bundle=new Bundle();
            bundle.putBoolean("isShow",true);
            VideosListF.videoListCallback.onResponce(bundle);
        }
    }


    public void showCustomAd() {
        if(is_visible_to_user && (type!=null && type.equalsIgnoreCase("related"))) {

            view.findViewById(R.id.top_btn_layout).setVisibility(View.GONE);

            if (MainMenuActivity.tabLayout != null)
                MainMenuActivity.tabLayout.setVisibility(View.GONE);

        }
    }

    public void hideCustomad() {

        if (MainMenuActivity.tabLayout != null)
            MainMenuActivity.tabLayout.setVisibility(View.VISIBLE);

            view.findViewById(R.id.top_btn_layout).setVisibility(View.VISIBLE);


    }



    // loader the ad and make it ready for show when 4 videos watched
    InterstitialAd mInterstitialAd;
    public void loadAdd() {

        mInterstitialAd = new InterstitialAd(context);
        mInterstitialAd.setAdUnitId(context.getResources().getString(R.string.my_Interstitial_Add));
        mInterstitialAd.loadAd(new AdRequest.Builder().build());
        mInterstitialAd.setAdListener(new AdListener() {
            @Override
            public void onAdClosed() {
                mInterstitialAd.loadAd(new AdRequest.Builder().build());
                getActivity().runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        VideosListF fragment = (VideosListF) pagerSatetAdapter.getItem(menuPager.getCurrentItem());
                        fragment.exoplayer.setPlayWhenReady(true);
                    }
                });
            }

            @Override
            public void onAdOpened() {
                new Handler(Looper.getMainLooper()).postDelayed(new Runnable() {
                    @Override
                    public void run() {
                        getActivity().runOnUiThread(new Runnable() {
                            @Override
                            public void run() {
                                try {
                                    VideosListF fragment = (VideosListF) pagerSatetAdapter.getItem(menuPager.getCurrentItem());
                                    fragment.exoplayer.setPlayWhenReady(false);
                                }
                                catch (Exception e)
                                {Log.d(Constants.tag,"Exception: "+e);}
                            }
                        });
                    }
                },1000);
            }
        });


    }


    public void showAdd() {
        if (mInterstitialAd != null && mInterstitialAd.isLoaded()) {
            mInterstitialAd.show();
        }
    }



    // this will call when go to the home tab From other tab.
    // this is very importent when for video play and pause when the focus is changes
    boolean is_visible_to_user;
    @Override
    public void setMenuVisibility(final boolean visible) {
        super.setMenuVisibility(visible);
        is_visible_to_user = visible;

        if (is_visible_to_user && pagerSatetAdapter != null && pagerSatetAdapter.getCount() > 0) {

            new Handler(Looper.getMainLooper()).postDelayed(new Runnable() {
                @Override
                public void run() {
                    if (tabNoFollower.getVisibility()==View.VISIBLE)
                    {
                        onPause();
                    }
                    else
                    {
                        VideosListF fragment = (VideosListF) pagerSatetAdapter.getItem(menuPager.getCurrentItem());
                        fragment.mainMenuVisibility(is_visible_to_user);
                    }
                }
            },200);

        }

    }



    @Override
    public void onDestroy() {
        super.onDestroy();

        if (mReceiver != null) {
            getActivity().unregisterReceiver(mReceiver);
            mReceiver = null;
        }

    }


}
