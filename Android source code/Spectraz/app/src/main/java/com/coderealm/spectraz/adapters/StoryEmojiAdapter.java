package com.coderealm.spectraz.adapters;

import android.view.LayoutInflater;
import android.view.ViewGroup;

import androidx.databinding.DataBindingUtil;
import androidx.recyclerview.widget.RecyclerView;

import com.coderealm.spectraz.interfaces.AdapterClickListener;
import com.coderealm.spectraz.R;
import com.coderealm.spectraz.databinding.StoryEmojiItemViewBinding;

import java.util.ArrayList;

public class StoryEmojiAdapter extends RecyclerView.Adapter<StoryEmojiAdapter.CustomViewHolder> {
    ArrayList<String> list;
    private AdapterClickListener listener;


    public StoryEmojiAdapter(ArrayList<String> datalist, AdapterClickListener listener) {
        this.list = datalist;
        this.listener = listener;

    }

    @Override
    public CustomViewHolder onCreateViewHolder(ViewGroup viewGroup, int viewtype) {
        StoryEmojiItemViewBinding binding = DataBindingUtil.inflate(LayoutInflater.from(viewGroup.getContext()),R.layout.story_emoji_item_view, viewGroup,false);
        return new CustomViewHolder(binding);
    }

    @Override
    public int getItemCount() {
        return list.size();
    }


    @Override
    public void onBindViewHolder(final CustomViewHolder holder, final int i) {
        String item=list.get(i);

        holder.binding.tvEmoji.setText(item);

        holder.bind(i,item, listener);
    }

    class CustomViewHolder extends RecyclerView.ViewHolder {
        StoryEmojiItemViewBinding binding;

        public CustomViewHolder(StoryEmojiItemViewBinding binding) {
            super(binding.getRoot());
            this.binding=binding;
        }

        public void bind(int position,String item,AdapterClickListener listener) {

            itemView.setOnClickListener(v -> {
                listener.onItemClick(v,position,item);
            });


        }

    }
}