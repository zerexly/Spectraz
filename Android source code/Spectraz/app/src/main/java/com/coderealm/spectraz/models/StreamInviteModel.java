package com.coderealm.spectraz.models;

import java.io.Serializable;

public class StreamInviteModel implements Serializable {
    public boolean isAccept;

    public StreamInviteModel() {
    }

    public boolean isAccept() {
        return isAccept;
    }

    public void setAccept(boolean accept) {
        isAccept = accept;
    }
}
