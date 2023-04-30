<?php include('config.php') ?>

    <div class="wrapper">
        
        <div class="tab-content" id="myTabContent">
                <div class="mainHeader">
                    <div class="mainHeaderTop">
                        <a onclick="showAudience('noaction')" class="btnPrevious fleft" onclick="back_on_destination()" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;">
                            Back
                        </a>
                        <a class="btnNext fright" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;" onclick="review_promotion()">
                            Next
                        </a>
                        <h3 class="tabsMainHeading">Budget and duration</h3>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="tab-pane  show active" id="destination" role="tabpanel">
                    <section class="audience az_audience audience1 d-block" style="background: #fff;">
                        <div class="tabSection az_tabSection">
                            <div class="tab-content">
                                <div id="potentialReachedTabs1" class="tab-pane fade in active show">
                                    <h2 class="tabsIn az_tabsIn" id="budget_and_duration_reach">30</h2>
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
                        </div>
                        <div class="destinationMainContent">
                            <div class="destinationMainContentProfile budget">
                                <label for="male" class="changeindestination" style="margin-bottom: 15px;">
                                    <p>Budget</p>
                                </label>
                                
                                <div style="width: 86%;margin: 0 auto;margin-bottom: 20px;">
                                    <input name="budgetindays" id="basic" type="text" onchange="budget_and_duration_reach(this.value)" data-slider-min="10" data-slider-max="100" data-slider-step="5" data-slider-value="30"/>    
                                </div>
                                
                            </div>
                            <div class="destinationMainContentProfile" >
                                <label for="male" class="changeindestination" style="margin-bottom: 15px;">
                                    <p>Days</p>
                                </label>
                                <div style="width: 86%;margin: 0 auto;margin-bottom: 20px;">
                                    <input name="daysforbugedet" id="vertical" type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1"/>  
                                </div>
                            </div>
                        </div>
                        <style>
                            .budget .tooltip-inner::before
                            {
                                content: '$';
                            }
                        </style>
                </div>
            </div>
        </section>
    </div>
            </div>
      
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.min.js"></script>
   