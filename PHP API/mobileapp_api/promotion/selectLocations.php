<?php include('config.php') ?>


<div class="wrapper">
    <form action="addAudience.php" method="GET" name="sendlocations">
    <section class="tabsMain">
        <div class="tab-content" id="myTabContent">
            <div class="mainHeader">
                <div class="mainHeaderTop">
                    <a class="btnPrevious fleft" onclick="back_on_add_audience()" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;">
                        Cancel
                    </a>
                    <a class="btnNext fright" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;" onclick="select_country()" >
                        Done
                    </a>
                    <h3 class="tabsMainHeading">Locations</h3>
                    <div class="clear"></div>
                </div>
            </div>
            
            
            <div class="tab-pane  show active" id="destination" role="tabpanel">
                <section class="audience az_audience audLocationPage audLocationPage1 d-block" style="background: #ffff;">
                    <div class="tabSection az_tabSection">
                        <div class="tab-content">
                            <div id="potentialReachedTabs1" class="tab-pane fade in active show">
                                <h2 class="tabsIn az_tabsIn" id="selected_country_reach">N/A</h2>
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
                    
                    <div class="tab-content">
                        <div id="regionalAdd" class="tab-pane fade in active show">
                            <div class="audbarHead az_audbarHead">
                                <div style="margin-bottom: 6px;">
                                    <div style="margin-top: 10px;">
                                        <i class="fa fa-search" style="margin: 12px 0 0 9px;position: absolute;font-size: 15px;color: #b0b0b0;"></i>
                                        <input class="locationPlace" id="search_location" onkeyup="search_country_keyword()" type="text" placeholder="Add Location" style="-webkit-appearance: none;background: #FAFAFA;padding: 10px 0 10px 32px;font-size: 14px;font-weight: 400;border: solid 1px #eee;border-radius: 3px;" autocomplete="false" >
                                    </div>
                                    <div class="sujjestions" style="width: 33px;text-align: center;float: right;margin: -35px 5px 0 0;">
                                        <div class="spiner seachspiner">
                                            <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px; display: none"></i>
                                        </div>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                                <div class="search_result_sujjested">

                                </div>

                                <p class="audParagraph az_audParagraph">
                                    We suggest adding a broad range of location to cover the largest surroundings area.
                                    Countries, Regions, Cities.
                                </p>

                                <div class="searchLocRes appendSearchResult">

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    </form>


</div>
