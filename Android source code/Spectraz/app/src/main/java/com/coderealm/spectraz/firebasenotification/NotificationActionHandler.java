package com.coderealm.spectraz.firebasenotification;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.util.Log;
import androidx.core.app.NotificationManagerCompat;

import com.coderealm.spectraz.Constants;
import com.coderealm.spectraz.activitesfragments.WatchVideosA;
import com.coderealm.spectraz.activitesfragments.chat.ChatA;
import com.coderealm.spectraz.activitesfragments.livestreaming.activities.LiveUsersA;
import com.coderealm.spectraz.activitesfragments.profile.ProfileA;
import com.coderealm.spectraz.mainmenu.MainMenuActivity;
import com.coderealm.spectraz.simpleclasses.Functions;
import com.coderealm.spectraz.simpleclasses.Variables;

public class NotificationActionHandler extends BroadcastReceiver {

    @Override
    public void onReceive(Context context, Intent intent) {
        try {
            String receiver_id=""+intent.getStringExtra("receiver_id");
            String sender_id=""+intent.getStringExtra("sender_id");
            String user_id=""+intent.getStringExtra("user_id");
            String video_id=""+intent.getStringExtra("video_id");
            String image=""+intent.getStringExtra("image");
            String title=""+intent.getStringExtra("title");


            NotificationManagerCompat notificationManager = NotificationManagerCompat.from(context);
            notificationManager.cancel(intent.getIntExtra("notification_id",0));

            if (Functions.getSharedPreference(context).getString(Variables.U_ID,"").equalsIgnoreCase(receiver_id))
            {
                if (intent.getStringExtra("type").equals("live"))
                {
                    Intent goingIntent=new Intent(context, LiveUsersA.class);
                    goingIntent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                    context.startActivity(goingIntent);
                }
                else
                if (intent.getStringExtra("type").equals("follow"))
                {
                    Intent goingIntent=new Intent(context, ProfileA.class);
                    goingIntent.putExtra("user_id", ""+sender_id);
                    goingIntent.putExtra("user_name", ""+(title.replace(" started following you","")));
                    goingIntent.putExtra("user_pic", ""+image);
                    goingIntent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                    context.startActivity(goingIntent);
                }
                else
                if (intent.getStringExtra("type").equals("video_new_post"))
                {
                    Intent goingIntent=new Intent(context, WatchVideosA.class);
                    goingIntent.putExtra("video_id", ""+video_id);
                    goingIntent.putExtra("position", 0);
                    goingIntent.putExtra("pageCount", 0);
                    goingIntent.putExtra("userId",""+receiver_id);
                    goingIntent.putExtra("whereFrom","IdVideo");
                    goingIntent.putExtra("video_comment",false);
                    goingIntent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                    context.startActivity(goingIntent);
                }
                else
                if (intent.getStringExtra("type").equals("message"))
                {
                    Intent goingIntent=new Intent(context, ChatA.class);
                    goingIntent.putExtra("user_id", ""+user_id);
                    goingIntent.putExtra("user_name", ""+title);
                    goingIntent.putExtra("user_pic", ""+image);
                    goingIntent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                    context.startActivity(goingIntent);
                }
                else if (intent.getStringExtra("type").equals("comment"))
                {
                    Intent goingIntent=new Intent(context, WatchVideosA.class);
                    goingIntent.putExtra("video_id", ""+video_id);
                    goingIntent.putExtra("position", 0);
                    goingIntent.putExtra("pageCount", 0);
                    goingIntent.putExtra("userId",""+receiver_id);
                    goingIntent.putExtra("whereFrom","IdVideo");
                    goingIntent.putExtra("video_comment",true);
                    goingIntent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                    context.startActivity(goingIntent);
                }

                else if (intent.getStringExtra("type").equals("video_like"))
                {
                    Intent goingIntent=new Intent(context, WatchVideosA.class);
                    goingIntent.putExtra("video_id", ""+video_id);
                    goingIntent.putExtra("position", 0);
                    goingIntent.putExtra("pageCount", 0);
                    goingIntent.putExtra("userId",""+receiver_id);
                    goingIntent.putExtra("whereFrom","IdVideo");
                    goingIntent.putExtra("video_comment",false);
                    goingIntent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                    context.startActivity(goingIntent);
                }

                else
                {
                    Intent goingIntent=new Intent(context, MainMenuActivity.class);
                    goingIntent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK|Intent.FLAG_ACTIVITY_NEW_TASK|Intent.FLAG_ACTIVITY_CLEAR_TOP);
                    context.startActivity(goingIntent);
                }

            }

            
        }catch (Exception e)
        {
            Log.d(Constants.tag,"Exception: Notification Handler: "+e);
        }
    }


}
