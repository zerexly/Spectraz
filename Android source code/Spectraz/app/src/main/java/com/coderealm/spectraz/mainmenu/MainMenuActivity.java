package com.coderealm.spectraz.mainmenu;

import static com.coderealm.spectraz.activitesfragments.livestreaming.Constants.KEY_CLIENT_ROLE;

import android.app.Activity;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import androidx.activity.result.ActivityResult;
import androidx.activity.result.ActivityResultCallback;
import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.annotation.NonNull;
import androidx.annotation.RequiresApi;
import androidx.core.content.ContextCompat;
import androidx.viewpager2.widget.ViewPager2;

import com.google.android.material.tabs.TabLayout;
import com.google.android.material.tabs.TabLayoutMediator;
import com.google.firebase.database.DataSnapshot;
import com.google.firebase.database.DatabaseError;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.ValueEventListener;
import com.coderealm.spectraz.activitesfragments.DiscoverF;
import com.coderealm.spectraz.activitesfragments.HomeF;
import com.coderealm.spectraz.activitesfragments.NotificationF;
import com.coderealm.spectraz.activitesfragments.livestreaming.activities.MultiViewLiveA;
import com.coderealm.spectraz.activitesfragments.livestreaming.activities.SingleCastJoinA;
import com.coderealm.spectraz.activitesfragments.livestreaming.model.LiveUserModel;
import com.coderealm.spectraz.activitesfragments.profile.ProfileTabF;
import com.coderealm.spectraz.activitesfragments.profile.settings.ShowLocationPermissionF;
import com.coderealm.spectraz.activitesfragments.videorecording.VideoRecoderA;
import com.coderealm.spectraz.activitesfragments.walletandwithdraw.MyWallet;
import com.coderealm.spectraz.adapters.ViewPagerAdapter;
import com.coderealm.spectraz.firebasenotification.NotificationActionHandler;
import com.coderealm.spectraz.interfaces.FragmentCallBack;
import com.coderealm.spectraz.models.StreamJoinModel;
import com.coderealm.spectraz.services.UploadService;
import com.coderealm.spectraz.simpleclasses.AppCompatLocaleActivity;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.messaging.FirebaseMessaging;
import com.coderealm.spectraz.activitesfragments.chat.ChatA;
import com.coderealm.spectraz.activitesfragments.profile.ProfileA;
import com.coderealm.spectraz.activitesfragments.WatchVideosA;
import com.coderealm.spectraz.Constants;
import com.coderealm.spectraz.simpleclasses.DarkModePrefManager;
import com.coderealm.spectraz.simpleclasses.LocationTracker;
import com.coderealm.spectraz.simpleclasses.TicTic;
import com.volley.plus.VPackages.VolleyRequest;
import com.volley.plus.interfaces.Callback;
import com.coderealm.spectraz.models.UserModel;
import com.coderealm.spectraz.R;
import com.coderealm.spectraz.apiclasses.ApiLinks;
import com.coderealm.spectraz.simpleclasses.DataParsing;
import com.coderealm.spectraz.simpleclasses.Functions;
import com.coderealm.spectraz.simpleclasses.PermissionUtils;
import com.coderealm.spectraz.simpleclasses.Variables;

import org.json.JSONObject;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;


public class MainMenuActivity extends AppCompatLocaleActivity {
    public static MainMenuActivity mainMenuActivity;
    long mBackPressed;
    Context context;

    PermissionUtils takePermissionUtils;
    public static TabLayout tabLayout;
    protected ViewPager2 pager;
    private ViewPagerAdapter adapter;

    DatabaseReference rootRef;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        try { getWindow().addFlags(WindowManager.LayoutParams.FLAG_KEEP_SCREEN_ON); }catch (Exception e){}
        Functions.setLocale(Functions.getSharedPreference(MainMenuActivity.this).getString(Variables.APP_LANGUAGE_CODE,Variables.DEFAULT_LANGUAGE_CODE)
                , this, getClass(),false);
        setContentView(R.layout.activity_main_menu);
        context=MainMenuActivity.this;
        mainMenuActivity = this;
        rootRef = FirebaseDatabase.getInstance().getReference();

        Intent intent=getIntent();
        chechDeepLink(intent);
        if (intent != null && intent.hasExtra("type")) {

            Intent actionIntent = new Intent(this, NotificationActionHandler.class);
            actionIntent.putExtra("title",""+intent.getStringExtra("title"));
            actionIntent.putExtra("body",""+intent.getStringExtra("body"));
            actionIntent.putExtra("image",""+intent.getStringExtra("image"));
            actionIntent.putExtra("receiver_id",""+intent.getStringExtra("receiver_id"));
            actionIntent.putExtra("sender_id",""+intent.getStringExtra("sender_id"));
            actionIntent.putExtra("user_id",""+intent.getStringExtra("user_id"));
            actionIntent.putExtra("video_id",""+intent.getStringExtra("video_id"));
            actionIntent.putExtra("type",""+intent.getStringExtra("type"));
            sendBroadcast(actionIntent);

        }

        if (Functions.getSharedPreference(this).getBoolean(Variables.IS_LOGIN, false)) {
            getPublicIP();
        }

        if(!Functions.getSharedPreference(this).getBoolean(Variables.IsExtended,false))
            checkLicence();

        Functions.makeDirectry(Functions.getAppFolder(this)+Variables.APP_HIDED_FOLDER);
        Functions.makeDirectry(Functions.getAppFolder(this)+Variables.DRAFT_APP_FOLDER);

        setIntent(null);

        if(Functions.getSharedPreference(this).getString(Variables.countryRegion,"null").equalsIgnoreCase("null")){
            String region=Functions.getCountryCode(this);
            Functions.getSharedPreference(this).edit().putString(Variables.countryRegion,region).commit();
        }

        checkCurrentLocationUpdates();

        SetTabs();

    }

    private void checkCurrentLocationUpdates() {
        takePermissionUtils=new PermissionUtils(MainMenuActivity.this,mPermissionLocationResult);
        if (takePermissionUtils.isLocationPermissionGranted())
        {
            getLoactionLatlng();
        }
        else
        {
            getLocationPermission();
        }
    }

    public void SetTabs() {
        adapter = new ViewPagerAdapter(this);
        pager = findViewById(R.id.viewpager);
        tabLayout = findViewById(R.id.tabs);
        pager.setOffscreenPageLimit(4);
        registerFragmentWithPager();
        pager.setAdapter(adapter);
        addTabs();
        setupTabIcons();
        pager.registerOnPageChangeCallback(new ViewPager2.OnPageChangeCallback() {
            @Override
            public void onPageSelected(int position) {
                super.onPageSelected(position);
                tabLayout.getTabAt(position).select();
            }
        });
        pager.setUserInputEnabled(false);
    }

    private void setupTabIcons() {

        View view1 = LayoutInflater.from(context).inflate(R.layout.item_tablayout, null);
        ImageView imageView1 = view1.findViewById(R.id.image);
        TextView title1 = view1.findViewById(R.id.text);
        imageView1.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_home_white));
        imageView1.setColorFilter(ContextCompat.getColor(context, R.color.whiteColor), android.graphics.PorterDuff.Mode.SRC_IN);
        title1.setText(context.getString(R.string.home));
        title1.setTextColor(ContextCompat.getColor(context,R.color.whiteColor));
        tabLayout.getTabAt(0).setCustomView(view1);


        View view2 = LayoutInflater.from(context).inflate(R.layout.item_tablayout, null);
        ImageView imageView2 = view2.findViewById(R.id.image);
        TextView title2 = view2.findViewById(R.id.text);
        imageView2.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_discovery_gray));
        imageView2.setColorFilter(ContextCompat.getColor(context, R.color.colorwhite_50), android.graphics.PorterDuff.Mode.SRC_IN);
        title2.setText(context.getString(R.string.discover));
        title2.setTextColor(ContextCompat.getColor(context,R.color.colorwhite_50));
        tabLayout.getTabAt(1).setCustomView(view2);


        View view3 = LayoutInflater.from(context).inflate(R.layout.item_add_tab_layout, null);
        tabLayout.getTabAt(2).setCustomView(view3);


        View view4 = LayoutInflater.from(context).inflate(R.layout.item_tablayout, null);
        ImageView imageView4 = view4.findViewById(R.id.image);
        TextView title4 = view4.findViewById(R.id.text);
        imageView4.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_notification_gray));
        imageView4.setColorFilter(ContextCompat.getColor(context, R.color.colorwhite_50), android.graphics.PorterDuff.Mode.SRC_IN);
        title4.setText(context.getString(R.string.inbox));
        title4.setTextColor(ContextCompat.getColor(context,R.color.colorwhite_50));
        tabLayout.getTabAt(3).setCustomView(view4);


        View view5 = LayoutInflater.from(context).inflate(R.layout.item_tablayout, null);
        ImageView imageView5 = view5.findViewById(R.id.image);
        TextView title5 = view5.findViewById(R.id.text);
        imageView5.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_profile_gray));
        imageView5.setColorFilter(ContextCompat.getColor(context, R.color.colorwhite_50), android.graphics.PorterDuff.Mode.SRC_IN);
        title5.setText(context.getString(R.string.profile));
        title5.setTextColor(ContextCompat.getColor(context,R.color.colorwhite_50));
        tabLayout.getTabAt(4).setCustomView(view5);


        tabLayout.addOnTabSelectedListener(new TabLayout.OnTabSelectedListener() {


            @Override
            public void onTabSelected(TabLayout.Tab tab) {
                View v = tab.getCustomView();
                ImageView image = v.findViewById(R.id.image);
                TextView title = v.findViewById(R.id.text);

                switch (tab.getPosition()) {
                    case 0:
                        Functions.blackStatusBar(MainMenuActivity.this);
                        onHomeClick();
                        image.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_home_white));
                        image.setColorFilter(ContextCompat.getColor(context, R.color.whiteColor), android.graphics.PorterDuff.Mode.SRC_IN);
                        title.setTextColor(ContextCompat.getColor(context,R.color.whiteColor));
                        break;

                    case 1:
                        Functions.whiteStatusBar(MainMenuActivity.this);
                        onotherTabClick();
                        image.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_discover_red));
                        image.setColorFilter(ContextCompat.getColor(context, R.color.appColor), android.graphics.PorterDuff.Mode.SRC_IN);
                        title.setTextColor(ContextCompat.getColor(context,R.color.appColor));
                        break;


                    case 3:
                        Functions.whiteStatusBar(MainMenuActivity.this);
                        onotherTabClick();
                        image.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_notification_red));
                        image.setColorFilter(ContextCompat.getColor(context, R.color.appColor), android.graphics.PorterDuff.Mode.SRC_IN);
                        title.setTextColor(ContextCompat.getColor(context,R.color.appColor));
                        break;
                    case 4:
                        Functions.whiteStatusBar(MainMenuActivity.this);
                        onotherTabClick();
                        image.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_profile_red));
                        image.setColorFilter(ContextCompat.getColor(context, R.color.appColor), android.graphics.PorterDuff.Mode.SRC_IN);
                        title.setTextColor(ContextCompat.getColor(context,R.color.appColor));
                        break;
                }
                tab.setCustomView(v);
            }

            @Override
            public void onTabUnselected(TabLayout.Tab tab) {
                View v = tab.getCustomView();
                ImageView image = v.findViewById(R.id.image);
                TextView title = v.findViewById(R.id.text);

                switch (tab.getPosition()) {
                    case 0:
                        image.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_home_gray));
                        image.setColorFilter(ContextCompat.getColor(context, R.color.darkgray), android.graphics.PorterDuff.Mode.SRC_IN);
                        title.setTextColor(ContextCompat.getColor(context,R.color.darkgray));
                        break;
                    case 1:
                        image.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_discovery_gray));
                        image.setColorFilter(ContextCompat.getColor(context, R.color.darkgray), android.graphics.PorterDuff.Mode.SRC_IN);
                        title.setTextColor(ContextCompat.getColor(context,R.color.darkgray));
                        break;

                    case 3:
                        image.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_notification_gray));
                        image.setColorFilter(ContextCompat.getColor(context, R.color.darkgray), android.graphics.PorterDuff.Mode.SRC_IN);
                        title.setTextColor(ContextCompat.getColor(context,R.color.darkgray));
                        break;
                    case 4:
                        image.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_profile_gray));
                        image.setColorFilter(ContextCompat.getColor(context, R.color.darkgray), android.graphics.PorterDuff.Mode.SRC_IN);
                        title.setTextColor(ContextCompat.getColor(context,R.color.darkgray));
                        break;
                }
                tab.setCustomView(v);
            }

            @Override
            public void onTabReselected(TabLayout.Tab tab) {

            }

        });


        final LinearLayout tabStrip = ((LinearLayout) tabLayout.getChildAt(0));
        tabStrip.setEnabled(false);

        tabStrip.getChildAt(2).setClickable(false);
        view3.setOnClickListener(v -> {
            takePermissionUtils=new PermissionUtils(MainMenuActivity.this,mPermissionResult);
            if (takePermissionUtils.isStorageCameraRecordingPermissionGranted()) {

                uploadNewVideo();
            }
            else
            {
                takePermissionUtils.showStorageCameraRecordingPermissionDailog(context.getString(R.string.we_need_storage_camera_recording_permission_for_make_new_video));
            }
        });


        tabStrip.getChildAt(3).setClickable(false);
        view4.setOnClickListener(v -> {
            if (Functions.checkLoginUser(MainMenuActivity.this)) {

                TabLayout.Tab tab = tabLayout.getTabAt(3);
                tab.select();
            }
        });

        tabStrip.getChildAt(4).setClickable(false);
        view5.setOnClickListener(v -> {
            if (Functions.checkLoginUser(MainMenuActivity.this)) {

                TabLayout.Tab tab = tabLayout.getTabAt(4);
                tab.select();
            }


        });

        onHomeClick();

        if (getIntent() != null) {

            if (getIntent().hasExtra("action_type")) {


                if (Functions.getSharedPreference(context).getBoolean(Variables.IS_LOGIN, false)) {
                    String action_type = getIntent().getExtras().getString("action_type");

                    if (action_type.equals("message")) {

                        new Handler(Looper.getMainLooper()).postDelayed(new Runnable() {
                            @Override
                            public void run() {
                                TabLayout.Tab tab = tabLayout.getTabAt(3);
                                tab.select();
                            }
                        }, 1500);


                        String id = getIntent().getExtras().getString("senderid");
                        String name = getIntent().getExtras().getString("title");
                        String icon = getIntent().getExtras().getString("icon");

                        chatFragment(id, name, icon);

                    }
                }

            }

        }
    }

    // open the chat fragment when click on notification of message
    public void chatFragment(String receiverid, String name, String picture) {

        Intent intent=new Intent(context,ChatA.class);
        intent.putExtra("user_id", receiverid);
        intent.putExtra("user_name", name);
        intent.putExtra("user_pic", picture);
        resultChatCallback.launch(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }



    private void uploadNewVideo() {
        Functions.makeDirectry(Functions.getAppFolder(context)+Variables.APP_HIDED_FOLDER);
        Functions.makeDirectry(Functions.getAppFolder(context)+Variables.DRAFT_APP_FOLDER);
        if (Functions.checkLoginUser(MainMenuActivity.this))
        {
            if (Functions.isMyServiceRunning(context, new UploadService().getClass())) {
                Toast.makeText(context, context.getString(R.string.video_already_in_progress), Toast.LENGTH_SHORT).show();
            } else {
                Intent intent = new Intent(context, VideoRecoderA.class);
                startActivity(intent);
                overridePendingTransition(R.anim.in_from_bottom, R.anim.out_to_top);
            }
        }
    }


    // add the listener of home bth which will open the recording screen
    public void onHomeClick() {

        TabLayout.Tab tab1 = tabLayout.getTabAt(1);
        View view1 = tab1.getCustomView();
        ImageView imageView1 = view1.findViewById(R.id.image);
        imageView1.setColorFilter(ContextCompat.getColor(context, R.color.colorwhite_50), android.graphics.PorterDuff.Mode.SRC_IN);
        TextView tex1 = view1.findViewById(R.id.text);
        tex1.setTextColor(ContextCompat.getColor(context,R.color.colorwhite_50));
        tab1.setCustomView(view1);

        TabLayout.Tab tab2 = tabLayout.getTabAt(2);
        View view2 = tab2.getCustomView();
        ImageView image = view2.findViewById(R.id.image);
        image.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_add_white));
        tab2.setCustomView(view2);

        TabLayout.Tab tab3 = tabLayout.getTabAt(3);
        View view3 = tab3.getCustomView();
        ImageView imageView3 = view3.findViewById(R.id.image);
        imageView3.setColorFilter(ContextCompat.getColor(context, R.color.colorwhite_50), android.graphics.PorterDuff.Mode.SRC_IN);
        TextView tex3 = view3.findViewById(R.id.text);
        tex3.setTextColor(ContextCompat.getColor(context,R.color.colorwhite_50));
        tab3.setCustomView(view3);


        TabLayout.Tab tab4 = tabLayout.getTabAt(4);
        View view4 = tab4.getCustomView();
        ImageView imageView4 = view4.findViewById(R.id.image);
        imageView4.setColorFilter(ContextCompat.getColor(context, R.color.colorwhite_50), android.graphics.PorterDuff.Mode.SRC_IN);
        TextView tex4 = view4.findViewById(R.id.text);
        tex4.setTextColor(ContextCompat.getColor(context,R.color.colorwhite_50));
        tab4.setCustomView(view4);

        tabLayout.setBackground(ContextCompat.getDrawable(context,R.drawable.d_top_gray_line_trans));

        getWindow().setNavigationBarColor(ContextCompat.getColor(context, R.color.blackColor));
        getWindow().getDecorView().setSystemUiVisibility(0);
    }


    // profile and notification tab click listener handler when user is not login into app
    public void onotherTabClick() {

        TabLayout.Tab tab1 = tabLayout.getTabAt(1);
        View view1 = tab1.getCustomView();
        TextView tex1 = view1.findViewById(R.id.text);
        ImageView imageView1 = view1.findViewById(R.id.image);
        imageView1.setColorFilter(ContextCompat.getColor(context, R.color.darkgray), android.graphics.PorterDuff.Mode.SRC_IN);
        tex1.setTextColor(ContextCompat.getColor(context,R.color.darkgray));
        tab1.setCustomView(view1);

        TabLayout.Tab tab2 = tabLayout.getTabAt(2);
        View view2 = tab2.getCustomView();
        ImageView image = view2.findViewById(R.id.image);
        image.setImageDrawable(ContextCompat.getDrawable(context,R.drawable.ic_add_black));
        tab2.setCustomView(view2);

        TabLayout.Tab tab3 = tabLayout.getTabAt(3);
        View view3 = tab3.getCustomView();
        ImageView imageView3 = view3.findViewById(R.id.image);
        imageView3.setColorFilter(ContextCompat.getColor(context, R.color.darkgray), android.graphics.PorterDuff.Mode.SRC_IN);
        TextView tex3 = view3.findViewById(R.id.text);
        tex3.setTextColor(ContextCompat.getColor(context,R.color.darkgray));
        tab3.setCustomView(view3);


        TabLayout.Tab tab4 = tabLayout.getTabAt(4);
        View view4 = tab4.getCustomView();
        ImageView imageView4 = view4.findViewById(R.id.image);
        imageView4.setColorFilter(ContextCompat.getColor(context, R.color.darkgray), android.graphics.PorterDuff.Mode.SRC_IN);
        TextView tex4 = view4.findViewById(R.id.text);
        tex4.setTextColor(ContextCompat.getColor(context,R.color.darkgray));
        tab4.setCustomView(view4);

        tabLayout.setBackground(ContextCompat.getDrawable(context,R.drawable.ractengle_white));

        getWindow().setNavigationBarColor(ContextCompat.getColor(context, R.color.white));
        if(new DarkModePrefManager(MainMenuActivity.this).isNightMode())
        {
            getWindow().getDecorView().setSystemUiVisibility(0);
        }
        else
        {
            getWindow().getDecorView().setSystemUiVisibility(getWindow().getDecorView().getSystemUiVisibility() | View.SYSTEM_UI_FLAG_LIGHT_STATUS_BAR);
        }

    }


    private ActivityResultLauncher<String[]> mPermissionResult = registerForActivityResult(
            new ActivityResultContracts.RequestMultiplePermissions(), new ActivityResultCallback<Map<String, Boolean>>() {
                @RequiresApi(api = Build.VERSION_CODES.M)
                @Override
                public void onActivityResult(Map<String, Boolean> result) {

                    boolean allPermissionClear=true;
                    List<String> blockPermissionCheck=new ArrayList<>();
                    for (String key : result.keySet())
                    {
                        if (!(result.get(key)))
                        {
                            allPermissionClear=false;
                            blockPermissionCheck.add(Functions.getPermissionStatus(MainMenuActivity.this,key));
                        }
                    }
                    if (blockPermissionCheck.contains("blocked"))
                    {
                        Functions.showPermissionSetting(context,context.getString(R.string.we_need_storage_camera_recording_permission_for_make_new_video));
                    }
                    else
                    if (allPermissionClear)
                    {
                        uploadNewVideo();
                    }

                }
            });



    private void addTabs() {
        TabLayoutMediator tabLayoutMediator=new TabLayoutMediator(tabLayout, pager, new TabLayoutMediator.TabConfigurationStrategy() {
            @Override
            public void onConfigureTab(@NonNull TabLayout.Tab tab, int position) {
                if (position==0)
                {
                    tab.setText(context.getString(R.string.home));
                }
                else
                if (position==1)
                {
                    tab.setText(context.getString(R.string.discover));
                }
                else
                if (position==2)
                {
                    tab.setText(context.getString(R.string.upload));
                }
                else
                if (position==3)
                {
                    tab.setText(context.getString(R.string.notifications));
                }
                else
                if (position==4)
                {
                    tab.setText(context.getString(R.string.profile));
                }
            }
        });
        tabLayoutMediator.attach();
    }


    private void registerFragmentWithPager() {
        adapter.addFrag(HomeF.newInstance());
        adapter.addFrag(DiscoverF.newInstance());
        adapter.addFrag(BlankFragment.newInstance());
        adapter.addFrag(NotificationF.newInstance());
        adapter.addFrag(ProfileTabF.newInstance());
    }


    private void getLocationPermission() {
        final ShowLocationPermissionF fragment = new ShowLocationPermissionF(new FragmentCallBack() {
            @Override
            public void onResponce(Bundle bundle) {
                if (bundle.getBoolean("isShow"))
                {
                    takePermissionUtils.showLocationPermissionDailog(getString(R.string.we_need_location_permission_to_show_you_nearby_contents));
                }
            }
        });
        fragment.show(getSupportFragmentManager(), "ShowLocationPermissionF");
    }

    private void getLoactionLatlng() {
        LocationTracker locationTracker = new LocationTracker(this);
        if (locationTracker.isGooglePlayServicesAvailable() && locationTracker.isGPSEnabled()) {
            double latitude = locationTracker.getLatitude();
            double longitude = locationTracker.getLongitude();
            Functions.getSharedPreference(MainMenuActivity.this).edit().putString(Variables.DEVICE_LAT, ""+latitude).commit();
            Functions.getSharedPreference(MainMenuActivity.this).edit().putString(Variables.DEVICE_LNG, ""+longitude).commit();
            locationTracker.stopUsingGPS();
        } else {
            Log.d(Constants.tag,"You Have no services");
            // Handle the case where the necessary services are not available
        }
    }

    private ActivityResultLauncher<String[]> mPermissionLocationResult = registerForActivityResult(
            new ActivityResultContracts.RequestMultiplePermissions(), new ActivityResultCallback<Map<String, Boolean>>() {
                @RequiresApi(api = Build.VERSION_CODES.M)
                @Override
                public void onActivityResult(Map<String, Boolean> result) {

                    boolean allPermissionClear=true;
                    List<String> blockPermissionCheck=new ArrayList<>();
                    for (String key : result.keySet())
                    {
                        if (!(result.get(key)))
                        {
                            allPermissionClear=false;
                            blockPermissionCheck.add(Functions.getPermissionStatus(MainMenuActivity.this,key));
                        }
                    }
                    if (blockPermissionCheck.contains("blocked"))
                    {
                        Functions.showPermissionSetting(context,context.getString(R.string.we_need_location_permission_to_show_you_nearby_contents));
                    }
                    else
                    if (allPermissionClear)
                    {
                        getLoactionLatlng();
                    }

                }
            });



    String streamId="";
    private void chechDeepLink(Intent intent) {
        try {
            Uri uri=intent.getData();
            String linkUri=""+uri;
            String userId="";
            String videoId="";

            String profileURL=Variables.https+"://"+getString(R.string.share_profile_domain_second)+getString(R.string.share_profile_endpoint_second);
            String streamURL=Variables.https+"://"+getString(R.string.share_profile_domain_second)+getString(R.string.share_stream_endpoint_second);

            if (linkUri.contains(streamURL))
            {
                String[] parts = linkUri.split(streamURL);
                streamId = parts[1];

                streamingOpen();
            }
            else
            if (linkUri.contains(profileURL))
            {
                String[] parts = linkUri.split(profileURL);
                userId = parts[1];

                OpenProfileScreen(userId);
            }
            else
            if (linkUri.contains(Constants.BASE_URL))
            {
                String[] parts = linkUri.split(Constants.BASE_URL);
                videoId = parts[1].substring(4, (parts[1].length()-3));
                openWatchVideo(videoId);
            }
        }
        catch (Exception e){
            Log.d(Constants.tag,"Exception Link : "+e);
        }
    }


    private void streamingOpen() {
        takePermissionUtils=new PermissionUtils(MainMenuActivity.this,mPermissionStreamResult);
        if (takePermissionUtils.isCameraRecordingPermissionGranted())
        {
            goLive(streamId);
        }
        else
        {
            takePermissionUtils.showCameraRecordingPermissionDailog(getString(R.string.we_need_camera_and_recording_permission_for_live_streaming));
        }
    }

    private ActivityResultLauncher<String[]> mPermissionStreamResult = registerForActivityResult(
            new ActivityResultContracts.RequestMultiplePermissions(), new ActivityResultCallback<Map<String, Boolean>>() {
                @RequiresApi(api = Build.VERSION_CODES.M)
                @Override
                public void onActivityResult(Map<String, Boolean> result) {

                    boolean allPermissionClear=true;
                    List<String> blockPermissionCheck=new ArrayList<>();
                    for (String key : result.keySet())
                    {
                        if (!(result.get(key)))
                        {
                            allPermissionClear=false;
                            blockPermissionCheck.add(Functions.getPermissionStatus(MainMenuActivity.this,key));
                        }
                    }
                    if (blockPermissionCheck.contains("blocked"))
                    {
                        Functions.showPermissionSetting(context,context.getString(R.string.we_need_camera_and_recording_permission_for_live_streaming));
                    }
                    else
                    if (allPermissionClear)
                    {
                        goLive(streamId);
                    }

                }
            });




    private void goLive(String streamId) {
        rootRef.child("LiveStreamingUsers")
                .child(streamId)
                .addListenerForSingleValueEvent(new ValueEventListener() {
                    @Override
                    public void onDataChange(@NonNull DataSnapshot snapshot) {
                        if (snapshot.exists())
                        {
                            LiveUserModel selectLiveModel = snapshot.getValue(LiveUserModel.class);
                            if (selectLiveModel.getJoinStreamPrice()!=null)
                            {

                                if (selectLiveModel.getJoinStreamPrice().equalsIgnoreCase("0"))
                                {
                                    runOnUiThread(new Runnable() {
                                        @Override
                                        public void run() {
                                            joinStream(selectLiveModel);
                                        }
                                    });
                                }
                                else
                                {
                                    rootRef.child("LiveStreamingUsers").child(selectLiveModel.getStreamingId())
                                            .child("FeePaid").child(Functions.getSharedPreference(context).getString(Variables.U_ID,"")).addListenerForSingleValueEvent(new ValueEventListener() {
                                        @Override
                                        public void onDataChange(@NonNull DataSnapshot snapshot) {
                                            runOnUiThread(new Runnable() {
                                                @Override
                                                public void run() {
                                                    if (snapshot.exists())
                                                    {
                                                        joinStream(selectLiveModel);
                                                    }
                                                    else
                                                    {
                                                        showPriceOffJoin(selectLiveModel);
                                                    }
                                                }
                                            });
                                        }

                                        @Override
                                        public void onCancelled(@NonNull DatabaseError error) {
                                            runOnUiThread(new Runnable() {
                                                @Override
                                                public void run() {
                                                    showPriceOffJoin(selectLiveModel);
                                                }
                                            });
                                        }
                                    });

                                }

                            }
                            else
                            {
                                Toast.makeText(context, context.getString(R.string.user)+" "+context.getString(R.string.is_offline_now), Toast.LENGTH_SHORT).show();
                            }

                        }
                        else
                        {
                            runOnUiThread(new Runnable() {
                                @Override
                                public void run() {
                                    Toast.makeText(context, context.getString(R.string.user)+" "+context.getString(R.string.is_offline_now), Toast.LENGTH_SHORT).show();
                                }
                            });
                        }
                    }

                    @Override
                    public void onCancelled(@NonNull DatabaseError error) {

                    }
                });

    }

    private void joinStream(LiveUserModel selectLiveModel) {
        Log.d(Constants.tag,"getOnlineType: "+selectLiveModel.getOnlineType());
        if (selectLiveModel.getOnlineType().equals("single"))
        {
            Functions.showLoader(context,false,false);
            rootRef.child("LiveStreamingUsers").child(selectLiveModel.getStreamingId()).child("JoinStream")
                    .addListenerForSingleValueEvent(new ValueEventListener() {
                        @Override
                        public void onDataChange(@NonNull DataSnapshot snapshot) {

                            HashMap<String, StreamJoinModel> joinStreamMap=new HashMap<>();
                            for (DataSnapshot postData:snapshot.getChildren())
                            {
                                StreamJoinModel item=postData.getValue(StreamJoinModel.class);
                                if(item!=null && item.getUserId()!=null)
                                {
                                    joinStreamMap.put(item.getUserId(),item);
                                }

                            }
                            runOnUiThread(new Runnable() {
                                @Override
                                public void run() {
                                    Functions.cancelLoader();
                                    if (snapshot.exists())
                                    {
                                        if (joinStreamMap.keySet().size()>0)
                                        {
                                            if (joinStreamMap.keySet().size()==1)
                                            {
                                                if (joinStreamMap.containsKey(Functions.getSharedPreference(context).getString(Variables.U_ID,"")))
                                                {
                                                    goSingleLive(selectLiveModel);
                                                }
                                                else
                                                {
                                                    Toast.makeText(context, context.getString(R.string.streaming_already_join_by_an_other_user), Toast.LENGTH_SHORT).show();
                                                }
                                            }
                                            else
                                            {
                                                Toast.makeText(context, context.getString(R.string.streaming_already_join_by_an_other_user), Toast.LENGTH_SHORT).show();
                                            }
                                        }
                                        else
                                        {
                                            goSingleLive(selectLiveModel);
                                        }
                                    }
                                    else
                                    {
                                        goSingleLive(selectLiveModel);
                                    }
                                }
                            });
                        }

                        @Override
                        public void onCancelled(@NonNull DatabaseError error) {
                            runOnUiThread(new Runnable() {
                                @Override
                                public void run() {
                                    Functions.cancelLoader();
                                }
                            });
                            Log.d(Constants.tag,"DatabaseError: "+error);
                        }
                    });


        }
        else
        if (selectLiveModel.getOnlineType().equals("multicast"))
        {
            ArrayList<LiveUserModel> dataList = new ArrayList<>();
            dataList.add(selectLiveModel);
            final Intent intent = new Intent();
            intent.putExtra("user_id", selectLiveModel.getUserId());
            intent.putExtra("user_name", selectLiveModel.getUserName());
            intent.putExtra("user_picture", selectLiveModel.getUserPicture());
            intent.putExtra("user_role", io.agora.rtc.Constants.CLIENT_ROLE_AUDIENCE);
            intent.putExtra("onlineType", "multicast");
            intent.putExtra("description", selectLiveModel.getDescription());
            intent.putExtra("secureCode", "");
            intent.putExtra("dataList",dataList);
            intent.putExtra("position",0);
            intent.setClass(context, MultiViewLiveA.class);
            startActivity(intent);
        }

    }

    private void showPriceOffJoin(LiveUserModel selectLiveModel) {
        final Dialog alertDialog = new Dialog(context);
        alertDialog.requestWindowFeature(Window.FEATURE_NO_TITLE);
        alertDialog.setContentView(R.layout.price_to_join_stream_view);
        alertDialog.getWindow().setBackgroundDrawable(context.getDrawable(R.drawable.d_round_white_background));

        RelativeLayout tabAccept = alertDialog.findViewById(R.id.tabAccept);
        ImageView closeBtn = alertDialog.findViewById(R.id.closeBtn);
        TextView tvJoiningAmount=alertDialog.findViewById(R.id.tvJoiningAmount);

        tvJoiningAmount.setText(""+selectLiveModel.getJoinStreamPrice()+" "+context.getString(R.string.coins_are_deducted_from_your_wallet_to_join_the_stream));


        closeBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                alertDialog.dismiss();
            }
        });

        tabAccept.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                alertDialog.dismiss();
                deductPriceFromWallet(selectLiveModel);
            }
        });

        alertDialog.setCancelable(false);
        alertDialog.setCanceledOnTouchOutside(false);
        alertDialog.show();
    }

    private void deductPriceFromWallet(LiveUserModel selectLiveModel) {
        JSONObject parameters = new JSONObject();
        try {
            parameters.put("user_id", Functions.getSharedPreference(context).getString(Variables.U_ID,"0"));
            parameters.put("live_streaming_id", selectLiveModel.getStreamingId());
            parameters.put("coin", selectLiveModel.getJoinStreamPrice());
        } catch (Exception e) {
            e.printStackTrace();
        }
        Functions.showLoader(context,false,false);
        VolleyRequest.JsonPostRequest(MainMenuActivity.this, ApiLinks.watchLiveStream,parameters, Functions.getHeaders(context),new Callback() {
            @Override
            public void onResponce(String resp) {
                Functions.checkStatus(MainMenuActivity.this,resp);
                Functions.cancelLoader();
                try {
                    JSONObject jsonObject = new JSONObject(resp);
                    String code = jsonObject.optString("code");
                    if (code.equals("200")) {
                        JSONObject msgObj=jsonObject.getJSONObject("msg");
                        UserModel userDetailModel= DataParsing.getUserDataModel(msgObj.getJSONObject("User"));
                        Functions.getSharedPreference(context).edit().putString(Variables.U_WALLET, ""+userDetailModel.getWallet()).commit();

                        String userId=Functions.getSharedPreference(context).getString(Variables.U_ID,"");
                        HashMap<String,String> map=new HashMap<>();
                        map.put("userId",userId);
                        rootRef.child("LiveStreamingUsers").child(selectLiveModel.getStreamingId())
                                .child("FeePaid").child(userId)
                                .setValue(map);
                        joinStream(selectLiveModel);
                    }
                    else
                    {
                        startActivity(new Intent(context, MyWallet.class));
                    }
                } catch (Exception e) {
                    android.util.Log.d(Constants.tag,"Exception : "+e);
                }
            }
        });


    }

    private void goSingleLive(LiveUserModel selectLiveModel) {
        final Intent intent = new Intent(context, SingleCastJoinA.class);
        intent.putExtra("bookingId",selectLiveModel.getStreamingId());
        intent.putExtra("dataModel",selectLiveModel);
        intent.putExtra(KEY_CLIENT_ROLE, io.agora.rtc.Constants.CLIENT_ROLE_AUDIENCE);
        TicTic ticTic = (TicTic)MainMenuActivity.this.getApplication();
        ticTic.engineConfig().setChannelName(selectLiveModel.getStreamingId());
        startActivity(intent);
    }


    private void openWatchVideo(String videoId) {
        Intent intent = new Intent(MainMenuActivity.this, WatchVideosA.class);
        intent.putExtra("video_id", videoId);
        intent.putExtra("position", 0);
        intent.putExtra("pageCount", 0);
        intent.putExtra("userId",Functions.getSharedPreference(MainMenuActivity.this).getString(Variables.U_ID,""));
        intent.putExtra("whereFrom","IdVideo");
        startActivity(intent);
    }

    private void OpenProfileScreen(String userId) {
        JSONObject parameters = new JSONObject();
        try {
            parameters.put("user_id", userId);
        } catch (Exception e) {
            e.printStackTrace();
        }

        VolleyRequest.JsonPostRequest(MainMenuActivity.this, ApiLinks.showUserDetail, parameters,Functions.getHeaders(this), new Callback() {
            @Override
            public void onResponce(String resp) {
                Functions.checkStatus(MainMenuActivity.this,resp);
                try {
                    JSONObject jsonObject = new JSONObject(resp);
                    String code = jsonObject.optString("code");
                    if (code.equals("200")) {
                        JSONObject msg = jsonObject.optJSONObject("msg");


                        UserModel userDetailModel= DataParsing.getUserDataModel(msg.optJSONObject("User"));

                        moveToProfile(userDetailModel.getId()
                                ,userDetailModel.getUsername()
                                ,userDetailModel.getProfilePic());


                    }
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        });
    }


    private void moveToProfile(String id,String username,String pic) {
        Intent intent=new Intent(MainMenuActivity.this, ProfileA.class);
        intent.putExtra("user_id", id);
        intent.putExtra("user_name", username);
        intent.putExtra("user_pic", pic);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_bottom, R.anim.out_to_top);
    }


    @Override
    protected void onNewIntent(final Intent intent) {
        super.onNewIntent(intent);
        chechDeepLink(intent);
        if (intent != null) {
            String type = intent.getStringExtra("type");
            if (type != null && type.equalsIgnoreCase("message")) {
                new Handler(Looper.getMainLooper()).postDelayed(new Runnable() {
                    @Override
                    public void run() {

                        Intent chatIntent=new Intent(MainMenuActivity.this,ChatA.class);
                        chatIntent.putExtra("user_id", intent.getStringExtra("user_id"));
                        chatIntent.putExtra("user_name", intent.getStringExtra("user_name"));
                        chatIntent.putExtra("user_pic", intent.getStringExtra("user_pic"));
                        resultChatCallback.launch(chatIntent);
                        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);

                    }
                }, 2000);

            }
        }

    }

    ActivityResultLauncher<Intent> resultChatCallback = registerForActivityResult(
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


    public void getPublicIP() {
        VolleyRequest.JsonGetRequest(this, "https://api.ipify.org/?format=json", new Callback() {
            @Override
            public void onResponce(String s) {
                try {
                    JSONObject responce = new JSONObject(s);
                    String ip = responce.optString("ip");
                    Functions.getSharedPreference(MainMenuActivity.this).edit().putString(Variables.DEVICE_IP, ip).commit();
                    if (Functions.getSharedPreference(MainMenuActivity.this).getString(Variables.DEVICE_TOKEN,"").equalsIgnoreCase(""))
                    {
                        addFirebaseToken();
                    }
                    else {
                        Functions.addDeviceData(MainMenuActivity.this);
                    }
                } catch (Exception e) {
                    Log.d(Constants.tag,"Exception : "+e);
                }
            }
        });
    }



    public void addFirebaseToken() {
        FirebaseMessaging.getInstance().getToken()
                .addOnCompleteListener(new OnCompleteListener<String>() {
                    @Override
                    public void onComplete(@NonNull Task<String> task) {
                        if (!task.isSuccessful()) {
                            return;
                        }
                        // Get new FCM registration token
                        String token = task.getResult();
                        Functions.getSharedPreference(MainMenuActivity.this).edit().putString(Variables.DEVICE_TOKEN, token).commit();
                        Functions.addDeviceData(MainMenuActivity.this);
                    }
                });


    }



    public void checkLicence(){
        VolleyRequest.JsonPostRequest(MainMenuActivity.this, ApiLinks.showLicense, null,Functions.getHeaders(this), new Callback() {
            @Override
            public void onResponce(String resp) {
                Functions.checkStatus(MainMenuActivity.this,resp);
                try {
                    JSONObject jsonObject=new JSONObject(resp);
                    String code=jsonObject.optString("code");
                    if(code!=null && code.equals("200")){
                        Functions.getSharedPreference(MainMenuActivity.this).edit().putBoolean(Variables.IsExtended,true).commit();
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                }

            }
        });

    }


    @Override
    public void onBackPressed() {
        if (pager.getCurrentItem()!=0)
        {
            tabLayout.getTabAt(0).select();
            return;
        }

        if (mBackPressed + 2000 > System.currentTimeMillis()) {
            super.onBackPressed();
            return;
        } else {
            Functions.showToast(getBaseContext(), getString(R.string.tap_to_exist));
            mBackPressed = System.currentTimeMillis();

        }

    }


    @Override
    protected void onDestroy() {
        if (mPermissionResult!=null)
        {
            mPermissionResult.unregister();
        }
        super.onDestroy();
    }

}
