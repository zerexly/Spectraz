<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Wooapp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="../app/webroot/promotions/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../app/webroot/promotions/css/style.css?time=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../app/webroot/promotions/css/responsive.css?time=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
</head>
<style>

    .azfleft{
        font-size: 24px;
    }
    .azpastPromotionsConHeader p{
        font-size: 24px;
        margin-top: -3px;
    }
    .newpastPromotionsContent{
        width: 100%;
        overflow: hidden;
    }
    .newpromotion-img{
        float: left;
        width: 30%;
    }
    .azmainPromotionImgDet{
        width: 70%;
        float: right;
        padding-left: 0px;
        overflow: hidden;
        padding-top: 10px;
    }
    .azmainPromotionImgDet p{
        font-size: 20px;
    }
    .azmainPromotion{
        width: 100%;
        margin-bottom: 35px !important;
        float: left;
    }
    .azmainPromotion1{
        width: 100%;
        margin-bottom: 35px !important;
        float: left;
    }
    .azmainPromotion2{
        width: 100%;
        margin-bottom: 23px !important;
        float: left;
    }
    .azmainPromotionImgDet div{
        height: unset !important;
    }
    .azpastPromotionsConFooter{
        overflow: hidden;
    }
    .azpastPromotionsConFooter h3{
        font-size: 24px;
        float: left;
    }
    .azpastPromotionsConFooter i{
        font-size: 30px;
        float: right;
    }.azpastPromotionsCon{
         padding: 30px 20px;
     }
     /* insights promotion css */
     .azPromotionsInsightsHeader{
    text-align: center;
    height: unset !important;
    display: block;
    padding: 50px 0px 44px;
    }
    .azPromotionsInsightsTime{
        color: #999999 !important;
        margin-bottom: 0px;
    }
    .az_likeDislike{
        font-size: 20px;
    }
    .az_likeDislike i{
        font-size: 30px;
        margin-right: 8px;
    }

    .az_PromotionsInsightsResponse{
        display: flex;
        align-items: center;
        padding: 20px 20px;
    }
    .az_thumbsup{
        margin-right: 60px;
    }
    .az_promotioncomments{
        margin-right: 60px;
        margin-left: 0px !important;
    }
    .az_promotionBadge{
        margin-left: 0px !important;
    }
    .az_interaction{
        padding: 10px 20px;
    }
    .az_interactionp{
        font-size: 24px;
        font-weight: bold;
    }
    .az_interactionquantity{
        padding: 8px 0;
    }
    .az_interactionCount{
        font-size: 24px;
    }
    .az_interactionClick{
        font-size: 24px;
        color: #999999 !important;
    }
    .azInteractionp{
        font-size: 24px;
    }
    .az_finalBudget{
        font-size: 24px;
        margin-left: -15px;
        margin-bottom: 30px;
    }
    .az_finalBudget span{
        font-size: 24px !important;
        color: #999999 !important;
    }
    /* insights promotion css end*/

    /* location css strat */
    .az_tabSection{
        padding: 50px 60px 21px 60px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }
    .az_tabsIn{
        font-size: 37px;
    }
    .az_audParagraph{
        font-size: 20px;
        color: #999999 !important;
    }
    .unavail h2{
        font-size: 20px;
        font-weight: bold;
        margin-top: 10px;
        margin-bottom: 0px;
    }
    .az_RLtabs{
        padding: 0px  0px;
        font-size: 24px;
        margin-bottom: 30px !important;
    }
    .az_RLtabs li a{
        padding: 20px 0px;
    }
    .az_RLtabs a.active{
        color: #393939;
    }
    .az_audbarHead{
        padding: 0px 20px;
    }
    .az_searchBar{
        padding: 0px 0px 30px 0px;
    }
    .az_searchBar .searchIcon{
        color: #999999 !important;
        margin-right: 30px;
    }
    .az_searchBar .locationPlace{
        font-size: 24px;
    }
    .az_locationParagraph{
        font-size: 21px;
        color: #999999 !important;
        padding-right: 10px;
    }
    .az_audience{
        border: none;
    }
    .az_searchBarUS i{
        font-size: 30px;
        color: #1390e2;
    }
    .az_searchBarUS h2{
        font-size: 24px;
    }
    .az_searchBarUS{
        padding: 0px 0px 25px 0px;
    }
    .az_searchLocRes{
        margin-top: 25px;
    }
    .az_spend{
        margin-bottom: 20px;
    }

    .broad h2{
        font-size: 20px;
        font-weight: bold;
        margin-top: 10px;
        margin-bottom: 0px;
        text-align: right;
        padding-right: 10px;    
    }
    .au_AudbarHead{
        padding: 20px 20px;
    }
    .az_audName{
        font-size: 24px !important;
        color: #999999 !important;
    }
    .az_allYear{
        font-size: 24px !important;
        padding-top: 5px; 
    }
    .az_audBarLast{
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }
    .az_audienceName{
        text-decoration: underline;
    }
    .au_Checkcircle i{
        font-size: 30px;
        color: #66b83a;
    }
    .az_locationsAud{
        padding-top: 20px;
    }
    .az_AuangleRight{
        font-size: 30px !important;
        color: #999999 !important;
    }
    .az_AuSearch{
        margin-top: 20px;
    }
    .az_audbarHeadSearch{
        padding-bottom: 30px;
    }
    /* location css end  */
    .az_previewPromotionMain{
        padding: 20px 20px;
    }
    .az_previewtitle {
        font-size: 24px;
        font-weight: 400;
        letter-spacing: 0px;
        padding-top: 10px;
    }
    .az_destination{
        padding: 0px 20px;
    }
    .az_desSearch{
        margin-top: 10px;
        text-align: left;
    }
    .az_audNameDes{
        text-align: left;
    }
    .az_desAudience{
        margin-top: 20px;
        word-break: break-all;
    }
    .az_payBorder{
        border-bottom: 1px solid rgba(0, 0, 0, .1);
        padding-bottom: 18px;
    }
    .az_previewtitlePayment1pay p{
        font-size: 20px;
        margin-top: 17px;
        text-align: left;
        color: #999999 !important;
        font-weight: 400;
    }
    .az_createPromotions button{
        padding: 18px 0;
        font-size: 25px;
        font-weight: 400;
    }
    .az_reviewBtn p{
        font-size: 23px;
        margin-top: 20px;
        color: #999999 !important;
        padding: 0px 10px;
        font-weight: 400;
    }

</style>
<body>
    
    
    
   
<div class="loading">
    <div class="col-md-12" style="margin: 0px;padding: 0px;">
        <div class="loader" id="loader-1"></div>
    </div>
</div>
<div class="wrapper">
    <section class="tabsMain">
        <div class="tab-content" id="myTabContent">
            <div class="mainHeader">
                <div class="mainHeaderTop">
                   
                    <h3 class="fleft tabsMainHeading"> Promotions</h3>
                    
                    <div class="clear"></div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="destination" role="tabpanel">
                
                 <?php
   
    if(count($past_promotions['active']) > 0){
        
        
  foreach($past_promotions['active'] as $active){
      
      
     $profile_visits  = $active['Promotion']['profile_visit_count'];
     $id  = $active['Promotion']['id'];
      $price  = $active['Promotion']['price'];
      $video_url  = $active['Video']['thum'];
      $audience  = $active['Promotion']['audience_id'];
      if($audience > 0){
          
          $audience = "customized";
      }else{
          
          $audience = "followers";
          
      }
      
  
    
    ?>
                <div class="pastPromotionsContent" style="background:#ffff ;">
                    <div class="clear"></div>
                    <div class="pastPromotionsCon azpastPromotionsCon">
                        <div class="pastPromotionsConHeader azpastPromotionsConHeader">
                            <h3 class="fleft azfleft">Active</h3>
                         
                        </div>
                        <div class="clear"></div>
                        <div class="pastPromotionsContent newpastPromotionsContent mb-4">
                            <div class="promotion-img newpromotion-img">
                                <img src="<?php echo $video_url?>" width="110px" height="120px">
                            </div>
                            <div class="mainPromotionImgDet  azmainPromotionImgDet">
                                <div class="azmainPromotion">
                                    <p class="fleft black">Profile Visites</p>
                                    <p class="fright grey"><?php echo $profile_visits;?></p>
                                </div>
                                <div class="azmainPromotion1">
                                    <p class="fleft black">Spend</p>
                                    <p class="fright grey"><?php echo $price ?></p>
                                </div>
                                <div class="azmainPromotion2">
                                    <p class="fleft black">Audience</p>
                                    <p class="fright grey"><?php echo $audience; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="pastPromotionsConFooter azpastPromotionsConFooter mt-3">
                            <a href="/mobileapp_api/api/viewInsights?id=<?php echo $id ?>">
                                <h3 class="fleft grey">View Insights</h3>
                                <p class="fright pr-3">
                                    <i class="fa fa-angle-right cutstomfont" aria-hidden="true"></i>
                                </p>
                                <div class="clear"></div>
                            </a>
                        </div>
                    </div>
                </div>
                
                  <?php } } ?>

                <?php

                if(count($past_promotions['non_active']) > 0){


                    foreach($past_promotions['non_active'] as $non_active){


                        $profile_visits  = $non_active['Promotion']['non_active_profile_visit_count'];
                        $price  = $non_active['Promotion']['price'];
                        $audience  = $non_active['Promotion']['audience_id'];
                        $video_url  = $non_active['Video']['thum'];
                        if($audience > 0){

                            $audience = "customized";
                        }else{

                            $audience = "followers";

                        }



                        ?>
                        <div class="pastPromotionsContent" style="background:#ffff ;">
                            <div class="clear"></div>
                            <div class="pastPromotionsCon azpastPromotionsCon">
                                <div class="pastPromotionsConHeader azpastPromotionsConHeader">
                                    <h3 class="fleft azfleft">Not Active</h3>

                                </div>
                                <div class="clear"></div>
                                <div class="pastPromotionsContent newpastPromotionsContent mb-4">
                                    <div class="promotion-img newpromotion-img">
                                        <img src="<?php echo $video_url?>" width="110px" height="120px">
                                    </div>
                                    <div class="mainPromotionImgDet  azmainPromotionImgDet">
                                        <div class="azmainPromotion">
                                            <p class="fleft black">Profile Visites</p>
                                            <p class="fright grey"><?php echo $profile_visits;?></p>
                                        </div>
                                        <div class="azmainPromotion1">
                                            <p class="fleft black">Spend</p>
                                            <p class="fright grey"><?php echo $price ?></p>
                                        </div>
                                        <div class="azmainPromotion2">
                                            <p class="fleft black">Audience</p>
                                            <p class="fright grey"><?php echo $audience; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                                <div class="pastPromotionsConFooter azpastPromotionsConFooter mt-3">
                                    <a href="promotionInsights.php">
                                        <h3 class="fleft grey">View Insights</h3>
                                        <p class="fright pr-3">
                                            <i class="fa fa-angle-right cutstomfont" aria-hidden="true"></i>
                                        </p>
                                        <div class="clear"></div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php } } ?>
                 
                 <?php
   
    if(count($past_promotions['completed']) > 0){
        
        
  foreach($past_promotions['completed'] as $completed){
      
      
     $profile_visits  = $completed['Promotion']['profile_visit_count'];
      $price  = $completed['Promotion']['price'];
      $audience  = $completed['Promotion']['audience_id'];
      $video_url  = $completed['Video']['thum'];
      if($audience > 0){
          
          $audience = "customized";
      }else{
          
          $audience = "followers";
          
      }
      
  
    
    ?>
                <div class="pastPromotionsContent" style="background:#ffff ;">
                    <div class="clear"></div>
                    <div class="pastPromotionsCon azpastPromotionsCon">
                        <div class="pastPromotionsConHeader azpastPromotionsConHeader">
                            <h3 class="fleft azfleft">Finished</h3>
                         
                        </div>
                        <div class="clear"></div>
                        <div class="pastPromotionsContent newpastPromotionsContent mb-4">
                            <div class="promotion-img newpromotion-img">
                                <img src="<?php echo $video_url?>" width="110px" height="120px">
                            </div>
                            <div class="mainPromotionImgDet  azmainPromotionImgDet">
                                <div class="azmainPromotion">
                                    <p class="fleft black">Profile Visites</p>
                                    <p class="fright grey"><?php echo $profile_visits;?></p>
                                </div>
                                <div class="azmainPromotion1">
                                    <p class="fleft black">Spend</p>
                                    <p class="fright grey"><?php echo $price ?></p>
                                </div>
                                <div class="azmainPromotion2">
                                    <p class="fleft black">Audience</p>
                                    <p class="fright grey"><?php echo $audience; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="pastPromotionsConFooter azpastPromotionsConFooter mt-3">
                            <a href="promotionInsights.php">
                                <h3 class="fleft grey">View Insights</h3>
                                <p class="fright pr-3">
                                    <i class="fa fa-angle-right cutstomfont" aria-hidden="true"></i>
                                </p>
                                <div class="clear"></div>
                            </a>
                        </div>
                    </div>
                </div>
                
                  <?php } } ?>




            </div>
        </div>
    </section>
</div>


<footer>
    <script type="text/javascript" src="../app/webroot/promotions/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="../app/webroot/promotions/js/jquery.ui.min.js"></script>
    <script type="text/javascript" src="../app/webroot/promotions/js/custom.js?time=<?php echo time(); ?>"></script>
    <script type="text/javascript" src="../app/webroot/promotions/js/bootstrap.min.js"></script>
</footer>
</body>
</html>