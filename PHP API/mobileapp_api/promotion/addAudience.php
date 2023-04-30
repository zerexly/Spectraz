<?php 
include('config.php');

$currentURl=$_SERVER['HTTP_REFERER'];
$video_id=explode("video_id=",$currentURl);

$data = 
    [
        "video_id" => $video_id[1],
    ];
$endpoint = $baseurl."showVideoDetail";
$json_data = curl_request($data, $endpoint);
$user_id = @$json_data['msg']['Video']['user_id'];


?>
    
    <div class="wrapper">
        <section class="tabsMain">
            <div class="tab-content" id="myTabContent">
                <div class="mainHeader">
                    <div class="mainHeaderTop">
                        <a class="btnPrevious fleft" onclick="back_on_audience()" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;">
                            Cancel
                        </a>
                        <a class="btnNext fright" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;" onclick="add_Audience()">
                            Done
                        </a>
                        <h3 class="tabsMainHeading">Create Audience</h3>
                        <div class="clear"></div>
                    </div>
                </div>
            
                <div class="tab-pane  show active" id="destination" role="tabpanel">
                    <section class="audience az_audience audience1 d-block" style="background: #fff;">
                        <div class="tabSection az_tabSection">
                            <div class="tab-content">
                                <div id="potentialReachedTabs1" class="tab-pane fade in active show">
                                    <h2 class="tabsIn az_tabsIn" id="create_audience_reach">N/A</h2>
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
                            
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
                            <div class="inputing" style="margin: -8px 0px 0 0px;">
                                <input class="inputTypenoboders" name="audience_name" id="audience_name" placeholder="Audience Name" type="text" style="border-top: 0px;">
                            </div>
                            
                            <div class="destinationMainContentProfile" style="padding: 10px 0;border-bottom: 1px solid #f2f2f2cc;">
                                <label for="websiteshow" class="changeindestination" onclick="selectLocations()" >
                                    <p style="line-height: 25px;">
                                        Locations
                                    </p>
                                    <div class="radioChecked1" style="color:#979595;">
                                        <i class="fas fa-chevron-right " aria-hidden="true"></i>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="destinationMainContentProfile" style="padding: 10px 0;border-bottom: 1px solid #f2f2f2cc;">
                                <label for="websiteshow" class="changeindestination" onclick="selectAgeGender()">
                                    <p style="line-height: 25px;">
                                        Age and gender
                                        <br>
                                        <span style="font-size: 14px !important;color:#979595;">
                                            <span id="selected_gender">All</span> | <span id="selected_age_range">18 - 60</span> yr
                                        </span>
                                    </p>
                                    <div class="radioChecked1" style="color:#979595;">
                                        <i class="fas fa-chevron-right " aria-hidden="true"></i>
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
    
