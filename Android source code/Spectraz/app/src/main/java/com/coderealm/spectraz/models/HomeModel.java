package com.coderealm.spectraz.models;

import java.io.Serializable;
import java.util.ArrayList;

/**
 * Created by qboxus on 2/18/2019.
 */

public class HomeModel implements Serializable {
    public String user_id="", username="", first_name="", last_name="", profile_pic="", verified="";
    public String video_id="", video_description="", video_url="", gif="", thum="", created_date="";

    public String promote="";


    public String sound_id="", sound_name="", sound_pic="", sound_url_acc="", sound_url_mp3="",video_user_id="";

    public String privacy_type="", allow_comments="", allow_duet="", liked="", like_count="", video_comment_count="", views="", duet_video_id="",
            duet_username="",favourite_count="",share="",duration="0",pin="0";

    //for playlist
    public String playlistVideoId;
    public String playlistId="", playlistName="";
    //for video block
    public String block="",aws_label="";
    //repost
    public String repost_video_id="", repost_user_id="",repost="";
    // additional param
    public String favourite;
    public String follow_status_button;

    public PrivacyPolicySettingModel apply_privacy_model;

    public PushNotificationSettingModel apply_push_notification_model;

    //user story manage
    public ArrayList<StoryModel> storyDataList;

    private PromotionModel promotionModel;

    public PromotionModel getPromotionModel() {
        return promotionModel;
    }

    public void setPromotionModel(PromotionModel promotionModel) {
        this.promotionModel = promotionModel;
    }
}
