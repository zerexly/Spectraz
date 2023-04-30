<?php 
include('config.php') ;
?>
<div class="mainHeader">
    <div class="mainHeaderTop">
        <a href="?video_id=<?php echo @$_GET['video_id'];?>&action=closePopup" class="btnPrevious fleft" onclick="" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;">
            Cancel
        </a>
        <a class="btnNext fright" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;" disabled="disabled">
            Next
        </a>
        <h3 class="tabsMainHeading">Destination</h3>
        <div class="clear"></div>
    </div>
</div>
<section class="tabsMain" style="padding-top: 50px;">
    <div class="tab-pane  show active" id="destination" role="tabpanel">
        <div class="destinationMainHeader py-5">
            <h3>Select Where To Send People</h3>
        </div>
        <div class="destinationMainContent" style="">
            <div class="destinationMainContentProfile">
                <label for="profileshow" class="changeindestination" onclick="destination_option_profile()" style="margin-bottom: 15px;">
                    <p>Your Profile</p>
                    <div class="radioChecked1">
                        <input type="radio" class="profileshow" id="profileshow" value="0" class=""  name="destinationProfile">
                    </div>
                </label>
            </div>
            <div class="destinationMainContentProfile">
                <label for="websiteshow" class="changeindestination" onclick="destination_option_website()" style="margin-bottom: 15px;">
                    <p>Your Website</p>
                    <div class="radioChecked1">
                        <input type="radio" value="1" class="websiteshow" id="websiteshow" name="destinationProfile">
                    </div>
                </label>
            </div>
            
            <div class="destinationMainContentProfile" id="websitediv" style="display:none;">
                
                <div class="destinationMainContentProfile">
                    
                    <div class="inputing">
                        <input class="inputTypenoboders" id="websiteurl" placeholder="http://www." type="text">
                        <img class="specfichelp" src="assets/images/1.png">
                    </div>
                </div>
                
                
            </div>

        </div>
        
    </div>
</section>