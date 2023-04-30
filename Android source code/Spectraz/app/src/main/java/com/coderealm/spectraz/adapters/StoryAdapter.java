package com.coderealm.spectraz.adapters;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RelativeLayout;
import android.widget.TextView;
import androidx.recyclerview.widget.RecyclerView;
import com.facebook.drawee.view.SimpleDraweeView;
import com.coderealm.spectraz.interfaces.AdapterClickListener;
import com.coderealm.spectraz.models.StoryModel;
import com.coderealm.spectraz.R;
import com.coderealm.spectraz.simpleclasses.Functions;
import java.util.ArrayList;

public class StoryAdapter extends RecyclerView.Adapter<StoryAdapter.CustomViewHolder> {

    ArrayList<StoryModel> dataList;
    AdapterClickListener adapterClickListener;

    public StoryAdapter(ArrayList<StoryModel> userDatalist, AdapterClickListener adapterClickListener) {
        this.dataList = userDatalist;
        this.adapterClickListener = adapterClickListener;
    }

    @Override
    public CustomViewHolder onCreateViewHolder(ViewGroup viewGroup, int viewtype) {
        View view = LayoutInflater.from(viewGroup.getContext()).inflate(R.layout.item_home_story_layout, viewGroup,false);
        return new CustomViewHolder(view);
    }

    @Override
    public void onBindViewHolder(final CustomViewHolder holder, final int i) {

        StoryModel itemModel = dataList.get(i);

        holder.tvUserPic.setText(itemModel.getUserModel().getUsername());
        holder.ivUserPic.setController(Functions.frescoImageLoad(itemModel.getUserModel().getProfilePic(),R.drawable.ic_user_icon,holder.ivUserPic,false));


        holder.bind(i, itemModel, adapterClickListener);
    }


    @Override
    public int getItemCount() {
        return dataList.size();
    }

    class CustomViewHolder extends RecyclerView.ViewHolder {

        public RelativeLayout tabUserPic;
        public TextView tvUserPic;
        public SimpleDraweeView ivUserPic;

        public CustomViewHolder(View view) {
            super(view);
            tvUserPic = view.findViewById(R.id.tvUserPic);
            ivUserPic = view.findViewById(R.id.ivUserPic);
            tabUserPic=view.findViewById(R.id.tabUserPic);
        }

        public void bind(final int pos, final Object item,
                         final AdapterClickListener adapterClickListener) {
            tabUserPic.setOnClickListener(v -> {
                adapterClickListener.onItemClick(v, pos, item);

            });

        }

    }

}