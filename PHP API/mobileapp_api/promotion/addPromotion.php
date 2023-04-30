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
    <div class="tab-content" id="myTabContent">
        <div class="mainHeader">
            <div class="mainHeaderTop">
                <a onclick="select_audience_id_next()" class="btnPrevious fleft" onclick="back_on_destination()" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;">
                    Back
                </a>
                <a class="btnNext fright" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;">
                </a>
                <h3 class="tabsMainHeading">Review</h3>
                <div class="clear"></div>
            </div>
        </div>
        
        <section class="tabsMain" style="padding-top: 50px;">
            <div class="tab-pane  show active" id="destination" role="tabpanel">
                <div class="text-center">
                    <div class="tabSection az_tabSection">
                        <div class="tab-content">
                            <div id="potentialReachedTabs1" class="tab-pane fade in active show">
                                <h2 class="tabsIn az_tabsIn" style="font-size: 22px;margin-top: 0px;">Review your promotion</h2>
                                <p class="audParagraph az_audParagraph">Your estmated reach is 2,500-6,700 people</p>
                            </div>
                        </div>
                    </div>
                    <div class="destinationMainContent">
                        <div class="destinationMainContentProfile">
                            <div style="text-align:left;">
                                
                                <div class="destinationMainContentProfile">
                                    <label for="websiteshow" class="changeindestination" style="margin-bottom: 15px;line-height: 22px;">
                                        <p>
                                            Preview Promotion
                                        </p>
                                        <div class="radioChecked1" style="color:#979595;">
                                            <i class="fas fa-chevron-right " aria-hidden="true"></i>
                                        </div>
                                    </label>
                                </div>
                                
                                <div class="destinationMainContentProfile">
                                    <label for="" class="changeindestination" style="margin-bottom: 15px;">
                                        <p>
                                            Destination
                                            <br>
                                            <span id="data_destination" style="font-size: 14px !important;color:#979595;">
                                                -
                                            </span>
                                        </p>
                                    </label>
                                </div>
                                
                                <div class="destinationMainContentProfile">
                                    <label for="" class="changeindestination" style="margin-bottom: 15px;">
                                        <p>
                                            Audience
                                            <br>
                                            <span id="raw_audience_data" style="font-size: 14px !important;color:#979595;">
                                                -
                                            </span>
                                        </p>
                                    </label>
                                </div>
                                
                                <div class="destinationMainContentProfile">
                                    <label for="" class="changeindestination" style="margin-bottom: 15px;">
                                        <p>
                                            Budget and duration
                                            <br>
                                            <span style="font-size: 14px !important;color:#979595;">
                                                $<span id="data_price">-</span> over <span id="data_days">-</span> days
                                            </span>
                                        </p>
                                    </label>
                                </div>
                                
                                <div class="destinationMainContentProfile">
                                    <label for="" class="changeindestination" style="margin-bottom: 15px;">
                                        <p>
                                            Payment
                                            <br>
                                            <span style="font-size: 14px !important;color:#979595;">
                                                Paypal account (Fast & Secure)
                                            </span>
                                        </p>
                                    </label>
                                </div>
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>">
                                
                                <div class="createPromotions text-center mt-3 az_createPromotions" onclick="create_promotion()">
                                    <button class="createPromotion" type="submit">Create Promotion</button>
                                </div>
                                
                                <!--<div class="review-btn az_reviewBtn">-->
                                <!--    <p class="review-p">By creating a promotion you agree to Instagram's<span-->
                                <!--                class="term-color">Terms </span>and <span class="term-color">Advertising Guidelines</span>-->
                                <!--    </p>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
