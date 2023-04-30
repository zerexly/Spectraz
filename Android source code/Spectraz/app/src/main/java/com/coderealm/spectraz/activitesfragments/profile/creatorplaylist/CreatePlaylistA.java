package com.coderealm.spectraz.activitesfragments.profile.creatorplaylist;


import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import androidx.fragment.app.FragmentTransaction;
import com.coderealm.spectraz.interfaces.FragmentCallBack;
import com.coderealm.spectraz.R;
import com.coderealm.spectraz.simpleclasses.AppCompatLocaleActivity;
import com.coderealm.spectraz.simpleclasses.Functions;
import com.coderealm.spectraz.simpleclasses.Variables;

public class CreatePlaylistA extends AppCompatLocaleActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Functions.setLocale(Functions.getSharedPreference(this).getString(Variables.APP_LANGUAGE_CODE,Variables.DEFAULT_LANGUAGE_CODE)
                , this, getClass(),false);
        setContentView(R.layout.activity_create_playlist);

        initContol();
    }

    private void initContol() {
        findViewById(R.id.goBack).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onBackPressed();
            }
        });
        findViewById(R.id.btnStartCreate).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                CreatePlaylistStepOneF f = new CreatePlaylistStepOneF(new FragmentCallBack() {
                    @Override
                    public void onResponce(Bundle bundle) {
                        if (!(bundle.getBoolean("isShow")))
                        {
                            onBackPressed();
                        }
                    }
                });
                Bundle bundle=new Bundle();
                f.setArguments(bundle);
                FragmentTransaction ft = getSupportFragmentManager().beginTransaction();
                ft.setCustomAnimations(R.anim.in_from_right, R.anim.out_to_left, R.anim.in_from_left, R.anim.out_to_right);
                ft.replace(R.id.createPlaylistContainerId, f,"CreatePlaylistStepOneF").addToBackStack("CreatePlaylistStepOneF").commit();
            }
        });
    }


    @Override
    public void onBackPressed() {
        Intent intent = new Intent();
        intent.putExtra("isShow", true);
        setResult(RESULT_OK, intent);
        finish();
    }

}