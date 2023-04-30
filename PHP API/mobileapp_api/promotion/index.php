<?php include('header.php') ?>


    <div class="wrapper" id="contentReceived">
        <?php 
            if(@$_GET['video_id']!="")
            {
                include('destination.php'); 
            }
            else
            if(@$_GET['payment']=="paypal")
            {
                include('config.php'); 
            }
            else
            if(isset($_GET['paymentId']))
            {
                include('config.php'); 
                // payment is verifed now you have to place order
                //echo "payment is verifed now you have to place order";
                
                //print_r($_GET['session_id']);
                $data = [
                    "id" =>@$_GET['session_id']
                ];
                
                $endpoint = $baseurl."showOrderSession";
                
                $json_data = curl_request($data, $endpoint);
                
                $addPromotion_json_data=$json_data['msg']['OrderSession']['string'];
                $addPromotion_json_data=json_decode($addPromotion_json_data,true);
                
                //print_r($addPromotion_json_data);
                
                $data =$addPromotion_json_data;
                $endpoint = $baseurl."addPromotion";
                $json_data = curl_request($data, $endpoint);
                if($json_data['code']=="200")
	            {
	                ?>
	                    <div class="wrapper">
                                <div class="tab-content" id="myTabContent">
                                    <div class="mainHeader">
                                        <div class="mainHeaderTop">
                                            <a class="btnPrevious fleft" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;">
                                                &nbsp;
                                            </a>
                                            <a href="index.php?action=closePopup" class="btnNext fright" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;">
                                                Done
                                            </a>
                                            <h3 class="tabsMainHeading">Completed</h3>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    
                                    <br><br><br><br><br><br>
            		                <div class="container">
                    		            <div class="restaurantInfo" style="text-align: center;">
                        			        <img src="assets/images/done.png" style="width: 80px;">
                        			        <h2 style="margin: 10px 0px;font-weight: 600;font-size: 18px; color:#363B3F;">Thank You</h2>
                        			        <p>Your Payment is Successfully Done</p>
                        			        <br>
                        			        <p>
                        			            Your ad is pending in review. 
                        			            <br>
                        			            Estimated review time, 5-60 minutes 
                        			            <br>
                        			            You will get a notification upon approval
                        			        </p>
                        			    </div>
                        	        </div>
                        	        
                        	        
                                </div>
                        </div>
                        
		           <?php
	            }
	            else
	            {
	                ?>
		               <div class="wrapper">
                                <div class="tab-content" id="myTabContent">
                                    <div class="mainHeader">
                                        <div class="mainHeaderTop">
                                            <a class="btnPrevious fleft" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;">
                                                &nbsp;
                                            </a>
                                            <a class="btnNext fright" style="font-size: 17px;color: black;z-index: 9999;position: relative;font-weight: 400;">
                                                Done
                                            </a>
                                            <h3 class="tabsMainHeading">Completed</h3>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                    
                                    <br><br><br><br><br><br>
            		                <div class="container">
                    		            <div class="restaurantInfo" style="text-align: center;">
                        			        <img src="assets/images/error.png" style="width: 80px;">
                        			        <h2 style="margin: 10px 0px;font-weight: 600;font-size: 18px; color:#363B3F;">Error</h2>
                        			        <p>Something went wrong in placing the order. Please contact the administrator</p>
                        			    </div>
                        	        </div>
                        	        
                        	        
                                </div>
                        </div>
                        
		           <?php
	            }
                
            }
            else
            {
                echo "Please contact administrator";
            }
            
        ?>
    </div>
    
    
    <div id="age_and_gender_data">
        <input type="hidden" id="age_range" placeholder="age_range" value="18,60">
        <input type="hidden" id="male" placeholder="male" value="male">
        <input type="hidden" id="female" placeholder="female" value="female">
        <input type="hidden" id="countries" placeholder="countries">
        <input type="hidden" id="data_website_url" placeholder="data_website_url">
        <input type="hidden" id="data_my_profile" placeholder="data_my_profile">
        <input type="hidden" id="data_audience_id" placeholder="data_audience_id">
        <input type="hidden" id="data_influencer" placeholder="data_influencer">
        
        <input type="hidden" id="budget" placeholder="budget">
        <input type="hidden" id="days" placeholder="days">
        <input type="hidden" id="video_id" value="<?php echo @$_GET['video_id']; ?>" placeholder="video_id">
        
        <input type="hidden" id="raw_data_destination" placeholder="raw data destination">
        <input type="hidden" id="raw_audience_name" placeholder="Audience Name">
    </div>

<?php include('footer.php') ?>