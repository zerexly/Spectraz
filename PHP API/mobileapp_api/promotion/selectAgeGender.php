<?php include('config.php') ?>

<form method="post" action="process.php?action=addAudience">
    <div class="wrapper">
        <section class="tabsMain">
            <div class="tab-content" id="myTabContent">
                <div class="mainHeader">
                    <div class="mainHeaderTop">
                        <a class="btnPrevious fleft" onclick="back_on_add_audience()" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;">
                            Cancel
                        </a>
                        <a class="btnNext fright" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;" onclick="add_age_gender()" >
                            Done
                        </a>
                        <h3 class="tabsMainHeading">Age and gender</h3>
                        <div class="clear"></div>
                    </div>
                </div>
            
                <div class="tab-pane  show active" id="destination" role="tabpanel">
                    <section class="audience az_audience audience1 d-block" style="background: #fff;">
                        <div class="tabSection az_tabSection">
                            <div class="tab-content">
                                <div id="potentialReachedTabs1" class="tab-pane fade in active show">
                                    <h2 class="tabsIn az_tabsIn">N/A</h2>
                                    <p class="audParagraph az_audParagraph">Potential People Reached</p>
                                </div>
                            </div>
                            <ul class="nav nav-tabs tabCollapse potentialReachedTabs">
                                <li class="">
                                    <a class="" data-toggle="tab" style="border-radius:0px;"></a>
                                </li>
                                <li>
                                    <a class="active" data-toggle="tab" style="border-radius:0px;"></a>
                                </li>
                                <li>
                                    <a class="" data-toggle="tab" style="border-radius:0px;"></a>
                                </li>
                            </ul>
                            <!--<div class="broad">-->
                            <!--    <h2>Too broad</h2>-->
                            <!--</div>-->
                        </div>
                        
                        <div class="destinationMainContent" style="">
                            
                            <div class="destinationMainContentProfile">
                                <label for="male" class="changeindestination" style="margin-bottom: 15px;">
                                    <p>Age</p>
                                </label>
                                <div style="width: 86%;margin: 0 auto;margin-bottom: 20px;">
                                    <input id="range2" name="rangs" type="text"/>
                                </div>
                            </div>
                           
                            <div class="destinationMainContentProfile">
                                <label for="male" class="changeindestination" style="margin-bottom: 15px;">
                                    <p>Male</p>
                                    <div class="radioChecked1">
                                        <input type="checkbox" value="male" class="websiteshow" id="male" name="destinationProfile" checked>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="destinationMainContentProfile">
                                <label for="female" class="changeindestination" style="margin-bottom: 15px;">
                                    <p>Female</p>
                                    <div class="radioChecked1">
                                        <input type="checkbox" value="female" class="websiteshow" id="female" name="destinationProfile" checked>
                                    </div>
                                </label>
                            </div>
                        </div>

                </div>
            </div>
        </section>
    </div>
    </div>
    </section>
    </div>
</form>
