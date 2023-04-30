<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Wooapp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="../app/webroot/promotions/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../app/webroot/promotions/css/style.css?time=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../app/webroot/promotionsa/css/responsive.css?time=<?php echo time(); ?>">
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
    <?php
      if(count($data) > 0){
        
        
         $created = $data['Promotion']['created'];
        $profile_visit_count = $data['Promotion']['profile_visit_count'];
          $user_id = $data['Promotion']['user_id'];
        $website_tap_count = $data['Promotion']['website_tap_count'];
        $price = $data['Promotion']['price'];
          $video_thumb = $data['Video']['thum'];
        $follower_count = $data['Promotion']['follower_count'];
        $up_vote_count = $data['Promotion']['up_vote_count'];
        $down_vote_count = $data['Promotion']['down_vote_count'];
        $promotion_click = $data['Promotion']['clicks'];
       
       $created = date('Y-m-d h:i A', strtotime($created));
    }
    
    ?>
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
                    <a href="/mobileapp_api/api/pastPromotions?id=<?php echo $user_id ?>" class="btnPrevious fleft" >
                        <img src="../app/webroot/promotions/images/left-grey.png" class="imglefthover" width="47px">
                        <img src="../app/webroot/promotions/images/left-black.png" class="imglefthovered" style="display: none;"
                                width="47px">
                    </a>
                    <h3 class="fleft tabsMainHeading">Promotion Insights</h3>
                 
                    <div class="clear"></div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="destination" role="tabpanel">
                <div class="PromotionsInsightsContent" style="background:#ffff;">
                    <div class="PromotionsInsightsHeader azPromotionsInsightsHeader">
                        <img src="<?php echo $video_thumb?>" height = "119px">
                    </div>
                    <p class="text-center PromotionsInsightsTime azPromotionsInsightsTime">Posted on <?php echo $created ?></p>
                    <div class="PromotionsInsightsResponse az_PromotionsInsightsResponse">
                        <div class="likeDislike az_likeDislike az_thumbsup">
                            <i class="fa fa-thumbs-up"></i>
                           <?php echo $up_vote_count; ?>
                        </div>
                        <div class="likeDislike az_likeDislike az_thumbsup">
                            <i class="fa fa-thumbs-down"></i>
                          <?php echo $down_vote_count; ?>
                        </div>
                       
                    </div>
                    <div class="interaction az_interaction">
                        <p class="interactionp az_interactionp">Interaction</p>
                        <div class="interactionquantity az_interactionquantity text-center pb-0">
                            <p class="interactionCount az_interactionCount"><?php echo $promotion_click?></p>
                            <p class="interactionClick az_interactionClick m-0">Promotion CLick</p>
                        </div>

                    </div>
                    <div class="interaction az_interaction">
                        <p class="interactionp azInteractionp fleft">Visit Profile</p>
                        <p class="interactionp azInteractionp fright"><?php echo $profile_visit_count ?></p>
                        <div class="clear"></div>
                    </div>
                    <div class="interaction az_interaction">
                        <p class="interactionp azInteractionp fleft">Visit Websites</p>
                        <p class="interactionp azInteractionp fright"><?php echo $website_tap_count ?></p>
                        <div class="clear"></div>
                    </div>
                    <div class="interaction az_interaction">
                        <p class="interactionp azInteractionp fleft">Follows</p>
                        <p class="interactionp azInteractionp fright"><?php echo $follower_count?></p>
                        <div class="clear"></div>
                    </div>
                    <div class="interaction  az_interaction az_spend">
                        <div>
                            <p class="interactionp azInteractionp fleft">Spend</p>
                            <p class="interactionp azInteractionp fright">$<?php echo $price ?></p>
                        </div>
                        <div class="clear"></div>
                        <!--<p class="finalBudget az_finalBudget">100<span>% of you $ </span>100 <span>budget</span></p>-->
                    </div>
                </div>
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