package com.coderealm.spectraz.models;


import com.coderealm.spectraz.Constants;

import java.io.Serializable;

/**
 * Created by qboxus on 2/22/2019.
 */


public class SoundsModel implements Serializable {

    public String id, sound_name, description, section, thum, duration, date_created, fav;
    private String acc_path;

    public SoundsModel() {
    }

    public String getAcc_path() {
        String soundPath = acc_path;
        if (soundPath != null && soundPath.contains("http"))
            acc_path =soundPath;
        else
            acc_path = Constants.BASE_URL +acc_path;
        return acc_path;
    }

    public void setAcc_path(String acc_path) {
        this.acc_path = acc_path;
    }
}
