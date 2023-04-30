package com.coderealm.spectraz.activitesfragments.profile;

import com.coderealm.spectraz.activitesfragments.profile.settings.AppThemA;
import com.coderealm.spectraz.activitesfragments.profile.settings.CreatorToolsA;
import com.coderealm.spectraz.simpleclasses.AppCompatLocaleActivity;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.activity.result.ActivityResult;
import androidx.activity.result.ActivityResultCallback;
import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;

import com.facebook.login.LoginManager;
import com.google.android.gms.auth.api.signin.GoogleSignIn;
import com.google.android.gms.auth.api.signin.GoogleSignInClient;
import com.google.android.gms.auth.api.signin.GoogleSignInOptions;
import com.coderealm.spectraz.activitesfragments.accounts.LoginA;
import com.coderealm.spectraz.activitesfragments.accounts.ManageAccountsF;
import com.coderealm.spectraz.activitesfragments.profile.settings.BlockUserListA;
import com.coderealm.spectraz.activitesfragments.videorecording.DraftVideosA;
import com.coderealm.spectraz.activitesfragments.walletandwithdraw.MyWallet;
import com.coderealm.spectraz.activitesfragments.profile.settings.AppLanguageChangeA;
import com.coderealm.spectraz.activitesfragments.profile.settings.AppSpaceClearA;
import com.coderealm.spectraz.activitesfragments.profile.settings.ManageProfileA;
import com.coderealm.spectraz.activitesfragments.profile.settings.PrivacyPolicySettingA;
import com.coderealm.spectraz.activitesfragments.profile.settings.ProfileVarificationA;
import com.coderealm.spectraz.activitesfragments.profile.settings.PushNotificationSettingA;
import com.coderealm.spectraz.activitesfragments.profile.settings.QrCodeProfileA;
import com.coderealm.spectraz.activitesfragments.profile.settings.WalletPaymentA;
import com.coderealm.spectraz.activitesfragments.WebviewA;
import com.coderealm.spectraz.apiclasses.ApiLinks;
import com.volley.plus.VPackages.VolleyRequest;
import com.coderealm.spectraz.Constants;
import com.volley.plus.interfaces.Callback;
import com.coderealm.spectraz.interfaces.FragmentCallBack;
import com.coderealm.spectraz.mainmenu.MainMenuActivity;
import com.coderealm.spectraz.R;
import com.coderealm.spectraz.simpleclasses.Functions;
import com.coderealm.spectraz.simpleclasses.Variables;

import org.json.JSONObject;

import io.paperdb.Paper;

public class SettingAndPrivacyA extends AppCompatLocaleActivity implements View.OnClickListener{

    TextView tvLanguage;
    LinearLayout tabVerifyProfile;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Functions.setLocale(Functions.getSharedPreference(SettingAndPrivacyA.this).getString(Variables.APP_LANGUAGE_CODE,Variables.DEFAULT_LANGUAGE_CODE)
                , this, getClass(),false);
        setContentView(R.layout.activity_setting_and_privacy);

        InitControl();
    }

    private void InitControl() {
        findViewById(R.id.back_btn).setOnClickListener(this);
        findViewById(R.id.tabManageAccount).setOnClickListener(this);
        findViewById(R.id.tabPrivacy).setOnClickListener(this);
        findViewById(R.id.tabCreatorTools).setOnClickListener(this);
        findViewById(R.id.tabBalance).setOnClickListener(this);
        findViewById(R.id.tabQr).setOnClickListener(this);
        findViewById(R.id.tabShareProfile).setOnClickListener(this);
        findViewById(R.id.tabPushNotificaiton).setOnClickListener(this);
        findViewById(R.id.tabApplanguage).setOnClickListener(this);
        findViewById(R.id.tabFreeSpace).setOnClickListener(this);
        findViewById(R.id.tabTermsOfService).setOnClickListener(this);
        findViewById(R.id.tabPrivacyPolicy).setOnClickListener(this);
        findViewById(R.id.tabSwitchAccount).setOnClickListener(this);
        findViewById(R.id.tabLogout).setOnClickListener(this);
        findViewById(R.id.tabPayoutSetting).setOnClickListener(this);
        findViewById(R.id.tabBlockUser).setOnClickListener(this);
        findViewById(R.id.tabDraftVideo).setOnClickListener(this);
        findViewById(R.id.tabDarkmode).setOnClickListener(this);
        tabVerifyProfile=findViewById(R.id.tabVerifyProfile);
        tabVerifyProfile.setOnClickListener(this);
        tvLanguage=findViewById(R.id.tvLanguage);

        setUpScreenData();
    }

    private void setUpScreenData() {
        if (Functions.getSharedPreference(SettingAndPrivacyA.this).getString(Variables.IS_VERIFIED,"0").equals("1"))
        {
            tabVerifyProfile.setVisibility(View.GONE);
        }
        else
        {
            tabVerifyProfile.setVisibility(View.VISIBLE);
        }
    }

    @Override
    public void onClick(View view) {
        switch (view.getId())
        {
            case R.id.back_btn:
            {
                onBackPressed();
            }
            break;
            case R.id.tabVerifyProfile:
            {
                openRequestVerification();
            }
            break;
            case R.id.tabManageAccount:
            {
                openManageAccount();
            }
            break;
            case R.id.tabPrivacy:
            {
                openPrivacySetting();
            }
            break;
            case R.id.tabCreatorTools:
            {
                openCreatorTools();
            }
            break;
            case R.id.tabPayoutSetting:
            {
                openPayoutSetting();
            }
            break;
            case R.id.tabBlockUser:
            {
                openBlockUserList();
            }
            break;
            case R.id.tabDraftVideo:
            {
                openDraftVideo();
            }
            break;
            case R.id.tabDarkmode:
            {
                openDarkMode();
            }
            break;
            case R.id.tabBalance:
            {
                openMyWallet();
            }
            break;
            case R.id.tabQr:
            {
                openQrCode();
            }
            break;
            case R.id.tabShareProfile:
            {
                shareProfile();
            }
            break;
            case R.id.tabPushNotificaiton:
            {
                openPushNotificationSetting();
            }
            break;
            case R.id.tabApplanguage:
            {
                openAppLanguage();
            }
            break;
            case R.id.tabFreeSpace:
            {
                openAppSpace();
            }
            break;
            case R.id.tabTermsOfService:
            {
                openWebUrl(getString(R.string.terms_amp_conditions), Constants.terms_conditions);
            }
            break;
            case R.id.tabPrivacyPolicy:
            {
                openWebUrl(getString(R.string.privacy_policy), Constants.privacy_policy);
            }
            break;
            case R.id.tabSwitchAccount:
            {
                openManageMultipleAccounts();
            }
            break;
            case R.id.tabLogout:
            {
                logoutProceed();
            }
            break;
        }
    }

    private void openCreatorTools() {
        Intent intent=new Intent(SettingAndPrivacyA.this, CreatorToolsA.class);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }

    private void openManageAccount() {
        Intent intent=new Intent(SettingAndPrivacyA.this, ManageProfileA.class);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }

    private void openDarkMode() {
        Intent intent=new Intent(SettingAndPrivacyA.this, AppThemA.class);
        resultDarkModeCallback.launch(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }

    private void openMyWallet() {
        Intent intent=new Intent(SettingAndPrivacyA.this, MyWallet.class);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }

    private void openQrCode() {
        Intent intent=new Intent(SettingAndPrivacyA.this, QrCodeProfileA.class);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }

    ActivityResultLauncher<Intent> resultDarkModeCallback = registerForActivityResult(
            new ActivityResultContracts.StartActivityForResult(), new ActivityResultCallback<ActivityResult>() {
                @Override
                public void onActivityResult(ActivityResult result) {
                    if (result.getResultCode() == Activity.RESULT_OK ) {
                        Log.d(Constants.tag,"Mode Active outer");
                        Intent data = result.getData();
                        if (data.getBooleanExtra("isShow",false))
                        {
                            Log.d(Constants.tag,"Mode Active inner");
                            Intent intent = new Intent(SettingAndPrivacyA.this,MainMenuActivity.class);
                            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK|Intent.FLAG_ACTIVITY_CLEAR_TOP|Intent.FLAG_ACTIVITY_NEW_TASK);
                            startActivity(intent);
                        }
                    }
                }
            });


    @Override
    protected void onResume() {
        super.onResume();
        tvLanguage.setText(Functions.getSharedPreference(SettingAndPrivacyA.this).getString(Variables.APP_LANGUAGE,Variables.DEFAULT_LANGUAGE));
    }

    private void openPayoutSetting() {
        Intent intent=new Intent(SettingAndPrivacyA.this, WalletPaymentA.class);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }

    private void openBlockUserList() {

        Intent intent=new Intent(SettingAndPrivacyA.this, BlockUserListA.class);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }

    public void openRequestVerification() {
        Intent intent=new Intent(SettingAndPrivacyA.this, ProfileVarificationA.class);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);

    }

    public void openDraftVideo() {
        Intent intent=new Intent(SettingAndPrivacyA.this, DraftVideosA.class);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }


    private void shareProfile() {

        String userId=Functions.getSharedPreference(SettingAndPrivacyA.this).getString(Variables.U_ID,"");
        String userName=Functions.getSharedPreference(SettingAndPrivacyA.this).getString(Variables.U_NAME,"");
        String fullName=Functions.getSharedPreference(SettingAndPrivacyA.this).getString(Variables.F_NAME,"")+" "+Functions.getSharedPreference(SettingAndPrivacyA.this).getString(Variables.L_NAME,"");
        String userPic=Functions.getSharedPreference(SettingAndPrivacyA.this).getString(Variables.U_PIC,"");

        final ShareUserProfileF fragment = new ShareUserProfileF(userId,userName,fullName,userPic,"",false,true, new FragmentCallBack() {
            @Override
            public void onResponce(Bundle bundle) {
                if (bundle.getBoolean("isShow",false))
                {

                }
            }
        });
        fragment.show(getSupportFragmentManager(), "ShareUserProfileF");

    }


    private void openPrivacySetting() {
        Intent intent=new Intent(SettingAndPrivacyA.this, PrivacyPolicySettingA.class);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }


    private void openPushNotificationSetting() {
        Intent intent=new Intent(SettingAndPrivacyA.this, PushNotificationSettingA.class);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }

    private void openAppLanguage() {
        Intent intent=new Intent(SettingAndPrivacyA.this, AppLanguageChangeA.class);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }

    private void openAppSpace() {
        Intent intent=new Intent(SettingAndPrivacyA.this, AppSpaceClearA.class);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }





    private void logoutProceed() {
        if (Paper.book(Variables.MultiAccountKey).getAllKeys().size()>1)
        {
            Functions.showDoubleButtonAlert(SettingAndPrivacyA.this,
                    getString(R.string.are_you_sure_to_logout),
                    "",
                    getString(R.string.logout),
                    getString(R.string.switch_account),true,
                    new FragmentCallBack() {
                        @Override
                        public void onResponce(Bundle bundle) {
                            if (bundle.getBoolean("isShow",false))
                            {
                                openManageMultipleAccounts();
                            }
                            else
                            {
                                logout();
                            }
                        }
                    }
            );
        }
        else
        {
            logout();
        }
    }


    public void openWebUrl(String title, String url) {
        Intent intent=new Intent(SettingAndPrivacyA.this, WebviewA.class);
        intent.putExtra("url", url);
        intent.putExtra("title", title);
        startActivity(intent);
        overridePendingTransition(R.anim.in_from_right, R.anim.out_to_left);
    }


    public void logout() {

        JSONObject params = new JSONObject();
        try {
            params.put("user_id", Functions.getSharedPreference(SettingAndPrivacyA.this).getString(Variables.U_ID, ""));
        } catch (Exception e) {
            e.printStackTrace();
        }

        Functions.showLoader(SettingAndPrivacyA.this,false,false);
        VolleyRequest.JsonPostRequest(SettingAndPrivacyA.this, ApiLinks.logout, params, Functions.getHeaders(this),new Callback() {
            @Override
            public void onResponce(String resp) {
                Functions.checkStatus(SettingAndPrivacyA.this,resp);
                Functions.cancelLoader();
                try {
                    JSONObject jsonObject = new JSONObject(resp);
                    String code = jsonObject.optString("code");

                    if (code.equalsIgnoreCase("200")) {
                        removePreferenceData();
                    }
                    else
                    {
                        removePreferenceData();
                    }

                } catch (Exception e) {
                    Log.d(Constants.tag,"Exception : "+e);
                }


            }
        });

    }

    private void removePreferenceData() {
        Paper.book(Variables.PrivacySetting).destroy();

        GoogleSignInOptions gso = new GoogleSignInOptions.
                Builder(GoogleSignInOptions.DEFAULT_SIGN_IN).
                build();
        GoogleSignInClient googleSignInClient = GoogleSignIn.getClient(SettingAndPrivacyA.this, gso);
        googleSignInClient.signOut();

        LoginManager.getInstance().logOut();

        Functions.removeMultipleAccount(SettingAndPrivacyA.this);

        SharedPreferences.Editor editor = Functions.getSharedPreference(SettingAndPrivacyA.this).edit();
        editor.clear();
        editor.commit();

        Functions.setUpExistingAccountLogin(SettingAndPrivacyA.this);

        Intent intent=new Intent(SettingAndPrivacyA.this, MainMenuActivity.class);
        intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK|Intent.FLAG_ACTIVITY_NEW_TASK|Intent.FLAG_ACTIVITY_CLEAR_TOP);
        startActivity(intent);
    }


    private void openManageMultipleAccounts() {
        ManageAccountsF f = new ManageAccountsF(new FragmentCallBack() {
            @Override
            public void onResponce(Bundle bundle) {
                if (bundle.getBoolean("isShow",false))
                {
                    Functions.hideSoftKeyboard(SettingAndPrivacyA.this);
                    Intent intent = new Intent(SettingAndPrivacyA.this, LoginA.class);
                    startActivity(intent);
                   overridePendingTransition(R.anim.in_from_bottom, R.anim.out_to_top);
                }
            }
        });
        f.show(getSupportFragmentManager(), "ManageAccountsF");
    }
}