<?php include('config.php');


$currentURl=$_SERVER['HTTP_REFERER'];
$video_id=explode("video_id=",$currentURl);


$data = 
    [
        "video_id" => $video_id[1],
    ];
$endpoint = $baseurl."showVideoDetail";
$json_data = curl_request($data, $endpoint);
$user_id = $json_data['msg']['Video']['user_id'];


//showAudiences
$data = [
    "user_id" => $user_id,
];
$endpoint = $baseurl."showAudiences";
$json_data = curl_request($data, $endpoint);
$json_data = $json_data['msg'];


?>
    <form method="post" action="process.php?action=showDestinationajax">
        <div class="wrapper">
            <section class="tabsMain">
                <div class="tab-content" id="myTabContent">
                    <div class="mainHeader">
                        <div class="mainHeaderTop">
                            <a onclick="back_on_destination_home()" class="btnPrevious fleft" onclick="back_on_destination()" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;">
                                Back
                            </a>
                            <a class="btnNext fright" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;" disabled="disabled">
                                Next
                            </a>
                            <h3 class="tabsMainHeading">Audience</h3>
                            <div class="clear"></div>
                        </div>
                    </div>
                    
                    <section class="tabsMain" style="padding-top: 50px;">
                        <div class="tab-pane  show active" id="destination" role="tabpanel">
                            <div class="destinationMainHeader py-5">
                                <h3>Select Target Audience</h3>
                            </div>
                            <div class="destinationMainContent" style="">
                                <?php
                                    foreach ($json_data as $single):
                                    
                                    $loca = $single['AudienceLocation'];
                                    $content = [];
                                    foreach ($loca as $singleloc) {
                                        $content[] = $singleloc['Country']['name'];
                                    }
                                    
                                    if($single['Audience']['name']!="")
                                    {
                                        $data=ucfirst($single['Audience']['name'])." | ".ucfirst($single['Audience']['gender'])." Age ".$single['Audience']['min_age']."-". $single['Audience']['max_age']." | ".implode(", ", $content);
                                        ?>
                                            <div class="destinationMainContentProfile" id="<?php echo $single['Audience']['id']; ?>_audienceRow">
                                                <label for="<?php echo $single['Audience']['id']; ?>_audience" class="changeindestination" onclick="select_audience_id('<?php echo $single['Audience']['id']; ?>','<?php echo $data; ?>')" style="margin-bottom: 15px;">
                                                    <p>
                                                        <?php echo ucfirst($single['Audience']['name']) ?>
                                                        <br>
                                                        <span style="font-size: 14px !important;color:#979595;">
                                                            <?php echo ucfirst($single['Audience']['gender']) ?>,
                                                            ages <?php echo $single['Audience']['min_age'] ?>
                                                            to <?php echo $single['Audience']['max_age'] ?> ,
                                                            <?php echo implode(", ", $content); ?>
                                                        </span>
                                                    </p>
                                                    <div class="radioChecked1">
                                                        <input type="radio" name="audience[]" value="<?php echo $single['Audience']['id'] ?>" id="<?php echo $single['Audience']['id']; ?>_audience"  name="destinationProfile">
                                                        <span onclick="deleteAudience('<?php echo $single['Audience']['id']; ?>')" class="far fa-trash-alt" style="padding: 10px 10px 10px 15px;cursor: pointer;"></span>
                                                    </div>
                                                </label>
                                            </div>
                                        
                                        <?php 
                                    }
                                    
                                    endforeach; 
                                ?>
                                    
                                <!--<div class="destinationMainContentProfile" id="91_audienceRow">-->
                                <!--    <label for="0_audience" class="changeindestination" onclick="promoteWithInfluencer()" style="margin-bottom: 15px;">-->
                                <!--        <p>-->
                                <!--            Promote with influencer-->
                                <!--        </p>-->
                                <!--        <div class="radioChecked1">-->
                                <!--            <input type="radio" value="0" id="0_audience">-->
                                <!--        </div>-->
                                <!--    </label>-->
                                <!--</div>-->
                                
                                <div class="destinationMainContentProfile">
                                    <label for="websiteshow" class="changeindestination" style="margin-bottom: 15px;line-height: 22px;" onclick="showAddAudience()" >
                                        <p>
                                            Create your own
                                            <br>
                                            <span style="font-size: 14px !important;color:#979595;">
                                                Manually enter your targeting options
                                            </span>
                                        </p>
                                        <div class="radioChecked1" style="color:#979595;">
                                            <i class="fas fa-chevron-right " aria-hidden="true"></i>
                                        </div>
                                    </label>
                                </div>
                                
                               
                                
                            </div>
                        </div>
                    </section>
                    

    </form>