package com.coderealm.spectraz.adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.ViewGroup;

import androidx.core.content.ContextCompat;
import androidx.databinding.DataBindingUtil;
import androidx.recyclerview.widget.RecyclerView;

import com.coderealm.spectraz.R;
import com.coderealm.spectraz.databinding.ItemPromotionAudienceSelectionLayoutBinding;
import com.coderealm.spectraz.interfaces.AdapterClickListener;
import com.coderealm.spectraz.models.PromotionAudiencesModel;

import java.util.ArrayList;

public class PromotionAudiencesAdapter extends RecyclerView.Adapter<PromotionAudiencesAdapter.CustomViewHolder> {

    public Context context;
    private ArrayList<PromotionAudiencesModel> dataList;

    AdapterClickListener adapterClickListener;

    public PromotionAudiencesAdapter(Context context, ArrayList<PromotionAudiencesModel> dataList, AdapterClickListener adapterClickListener) {
        this.context = context;
        this.dataList = dataList;
        this.adapterClickListener = adapterClickListener;

    }

    @Override
    public CustomViewHolder onCreateViewHolder(ViewGroup viewGroup, int viewtype) {
        ItemPromotionAudienceSelectionLayoutBinding binding = DataBindingUtil.inflate(LayoutInflater.from(viewGroup.getContext()),R.layout.item_promotion_audience_selection_layout, viewGroup,false);
        return new CustomViewHolder(binding);
    }

    @Override
    public void onBindViewHolder(final CustomViewHolder holder, final int i) {
        PromotionAudiencesModel item=dataList.get(i);
        if (item.isSelected())
        {
            holder.binding.ivSelection.setImageDrawable(ContextCompat.getDrawable(holder.binding.getRoot().getContext(),R.drawable.ic_circle_selection));
        }
        else
        {
            holder.binding.ivSelection.setImageDrawable(ContextCompat.getDrawable(holder.binding.getRoot().getContext(),R.drawable.ic_un_selected));
        }

        holder.binding.tvTitle.setText(""+item.getName());
        holder.bind(i, item, adapterClickListener);

    }

    @Override
    public int getItemCount() {
        return dataList.size();
    }


    class CustomViewHolder extends RecyclerView.ViewHolder {
        ItemPromotionAudienceSelectionLayoutBinding binding;

        public CustomViewHolder(ItemPromotionAudienceSelectionLayoutBinding binding) {
            super(binding.getRoot());
            this.binding=binding;
        }

        public void bind(final int position, final PromotionAudiencesModel item, final AdapterClickListener listener) {
            binding.tabSelection.setOnClickListener(v -> {
                adapterClickListener.onItemClick(v, position, item);

            });
        }

    }


}
