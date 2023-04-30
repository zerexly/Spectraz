package com.coderealm.spectraz.adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

import com.coderealm.spectraz.interfaces.AdapterClickListener;
import com.coderealm.spectraz.models.HashTagModel;
import com.coderealm.spectraz.R;
import com.coderealm.spectraz.simpleclasses.Functions;

import java.util.ArrayList;

public class HashTagFavouriteAdapter extends RecyclerView.Adapter<HashTagFavouriteAdapter.CustomViewHolder> {
    public Context context;

    ArrayList<HashTagModel> datalist;
    AdapterClickListener adapterClickListener;

    public HashTagFavouriteAdapter(Context context, ArrayList<HashTagModel> arrayList, AdapterClickListener adapterClickListener) {
        this.context = context;
        datalist = arrayList;
        this.adapterClickListener = adapterClickListener;
    }

    @Override
    public CustomViewHolder onCreateViewHolder(ViewGroup viewGroup, int viewtype) {
        View view = LayoutInflater.from(viewGroup.getContext()).inflate(R.layout.item_hashtag_favourite_list, viewGroup, false);
        return new CustomViewHolder(view);
    }


    @Override
    public int getItemCount() {
        return datalist.size();
    }


    @Override
    public void onBindViewHolder(final CustomViewHolder holder, final int i) {
        holder.setIsRecyclable(false);
        HashTagModel item = datalist.get(i);
        holder.nameTxt.setText(item.name);

        int videoCount=Integer.valueOf(item.videos_count);
        if (videoCount>1)
        {
            holder.viewsTxt.setText(Functions.getSuffix(""+videoCount)+" "+(holder.itemView.getContext().getString(R.string.videos)).toLowerCase());

        }
        else
        {
            holder.viewsTxt.setText(Functions.getSuffix(""+videoCount)+" "+(holder.itemView.getContext().getString(R.string.video)).toLowerCase());

        }

        holder.bind(i, item, adapterClickListener);

    }

    class CustomViewHolder extends RecyclerView.ViewHolder {

        TextView nameTxt, viewsTxt;

        public CustomViewHolder(View view) {
            super(view);

            nameTxt = view.findViewById(R.id.name_txt);
            viewsTxt = view.findViewById(R.id.views_txt);
        }

        public void bind(final int pos, final Object item, final AdapterClickListener listener) {


            itemView.setOnClickListener(v -> {

                listener.onItemClick(v, pos, item);

            });
        }


    }


}

