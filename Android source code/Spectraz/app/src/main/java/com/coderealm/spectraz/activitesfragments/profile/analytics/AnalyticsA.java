package com.coderealm.spectraz.activitesfragments.profile.analytics;

import android.os.Bundle;
import android.view.View;

import androidx.annotation.NonNull;
import androidx.viewpager2.widget.ViewPager2;

import com.google.android.material.tabs.TabLayout;
import com.google.android.material.tabs.TabLayoutMediator;
import com.coderealm.spectraz.R;
import com.coderealm.spectraz.adapters.ViewPagerAdapter;
import com.coderealm.spectraz.simpleclasses.AppCompatLocaleActivity;
import com.coderealm.spectraz.simpleclasses.Functions;
import com.coderealm.spectraz.simpleclasses.Variables;

public class AnalyticsA extends AppCompatLocaleActivity {



    protected TabLayout tabLayout;
    protected ViewPager2 pager;
    private ViewPagerAdapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        Functions.setLocale(Functions.getSharedPreference(this).getString(Variables.APP_LANGUAGE_CODE,Variables.DEFAULT_LANGUAGE_CODE)
                , this, getClass(),false);
        setContentView(R.layout.activity_analytics);

        findViewById(R.id.backBtn).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });

        SetTabs();
    }


    public void SetTabs() {
        adapter = new ViewPagerAdapter(this);
        pager = (ViewPager2) findViewById(R.id.pager);
        tabLayout = (TabLayout) findViewById(R.id.tabs);

        pager.setOffscreenPageLimit(3);
        pager.setUserInputEnabled(false);

        adapter.addFrag(OverviewF.newInstance());
        adapter.addFrag(ContentAnalyticF.newInstance());
        adapter.addFrag(FollowersAnalyticsF.newInstance());

        pager.setAdapter(adapter);
        addTabs();

    }

    private void addTabs() {
        TabLayoutMediator tabLayoutMediator=new TabLayoutMediator(tabLayout, pager, new TabLayoutMediator.TabConfigurationStrategy() {
            @Override
            public void onConfigureTab(@NonNull TabLayout.Tab tab, int position) {
                if (position==0)
                {
                    tab.setText(R.string.overview);
                }
                else
                if (position==1)
                {
                    tab.setText(R.string.content);
                }
                else
                if (position==2)
                {
                    tab.setText(R.string.following);
                }
            }
        });
        tabLayoutMediator.attach();
    }



}