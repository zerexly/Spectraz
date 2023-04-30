package com.coderealm.spectraz.adapters;

import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import androidx.databinding.DataBindingUtil;
import androidx.recyclerview.widget.RecyclerView;

import com.coderealm.spectraz.Constants;
import com.coderealm.spectraz.R;
import com.coderealm.spectraz.databinding.PromotionHistoryItemViewBinding;
import com.coderealm.spectraz.interfaces.AdapterClickListener;
import com.coderealm.spectraz.models.PromotionHistoryModel;
import com.coderealm.spectraz.simpleclasses.Functions;

import java.util.ArrayList;

public class PromotionHistoryAdapter extends RecyclerView.Adapter<PromotionHistoryAdapter.ViewHolder> {

    ArrayList<PromotionHistoryModel> datalist;
    AdapterClickListener adapterClickListener;

    public PromotionHistoryAdapter(ArrayList<PromotionHistoryModel> arrayList, AdapterClickListener adapterClickListener) {
        datalist = arrayList;
        this.adapterClickListener = adapterClickListener;
    }

    @Override
    public ViewHolder onCreateViewHolder(ViewGroup viewGroup, int viewtype) {
        PromotionHistoryItemViewBinding binding= DataBindingUtil.inflate(LayoutInflater.from(viewGroup.getContext()),R.layout.promotion_history_item_view, viewGroup, false);
        return new ViewHolder(binding);
    }


    @Override
    public int getItemCount() {
        return datalist.size();
    }


    @Override
    public void onBindViewHolder(final ViewHolder holder, final int i) {
        PromotionHistoryModel item = datalist.get(i);
        holder.binding.ivVideo.setController(Functions.frescoImageLoad(item.getVideo_thumb(),R.drawable.image_placeholder,holder.binding.ivVideo,false));

        holder.binding.tvDuration.setText(Functions.getDurationInDays("yyyy-MM-dd HH:mm:ss",item.getStart_datetime(),item.getEnd_datetime())+" "+holder.binding.getRoot().getContext().getString(R.string.day));
        holder.binding.tvCoins.setText(Functions.getSuffix(item.getCoin()));
        holder.binding.tvLinkClicks.setText(Functions.getSuffix(item.getDestination_tap()));
        holder.binding.tvVideoViews.setText(Functions.getSuffix(item.getVideo_views()));
        if (checkIsPromotionCompleted(Functions.getDurationInDays("yyyy-MM-dd HH:mm:ss",Functions.getCurrentDate("yyyy-MM-dd HH:mm:ss"),item.getEnd_datetime())))
        {
            holder.binding.tabStatus.setVisibility(View.VISIBLE);
        }
        else
        {
            holder.binding.tabStatus.setVisibility(View.GONE);
        }

        holder.bind(i, item, adapterClickListener);

    }

    private boolean checkIsPromotionCompleted(String durationInDays) {
        try {
            Log.d(Constants.tag,"durationInDays: "+durationInDays);
            long number=Long.parseLong(durationInDays);
            if (number<1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (Exception e)
        {
            return false;
        }
    }


    class ViewHolder extends RecyclerView.ViewHolder {

        PromotionHistoryItemViewBinding binding;

        public ViewHolder(PromotionHistoryItemViewBinding binding) {
            super(binding.getRoot());
            this.binding=binding;
        }

        public void bind(final int pos, final Object item, final AdapterClickListener listener) {


            binding.btnPromoteAgain.setOnClickListener(v -> {
                listener.onItemClick(v, pos, item);
            });
        }


    }


}

