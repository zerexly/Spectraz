package com.coderealm.spectraz.activitesfragments.chat.viewholders;

import android.view.View;
import android.widget.RelativeLayout;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

import com.facebook.drawee.view.SimpleDraweeView;
import com.coderealm.spectraz.R;
import com.coderealm.spectraz.activitesfragments.chat.ChatAdapter;
import com.coderealm.spectraz.activitesfragments.chat.ChatModel;

public class ChatStoryLikeViewholder extends RecyclerView.ViewHolder {
    public TextView datetxt, messageSeen,storyEmoticon;
    public RelativeLayout tabStory;
    public SimpleDraweeView userStory;
    public View view;

    public ChatStoryLikeViewholder(View itemView) {
        super(itemView);
        view = itemView;
        userStory=view.findViewById(R.id.userStory);
        storyEmoticon = view.findViewById(R.id.storyEmoticon);
        datetxt = view.findViewById(R.id.datetxt);
        messageSeen = view.findViewById(R.id.message_seen);
        tabStory=view.findViewById(R.id.tabStory);
    }

    public void bind(final ChatModel item, final ChatAdapter.OnItemClickListener listener, int position) {
        tabStory.setOnClickListener(v -> {
            listener.onItemClick(item, v,position);
        });
    }
}

