<?php

include("config.php"); 

if(isset($_SESSION[PRE_FIX.'id']))
{
    
    if(isset($_GET['action'])){
            
        if($_GET['action']=="deleteVideo") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $video_id = htmlspecialchars($_GET['video_id'], ENT_QUOTES);
            $url=$baseurl . 'deleteVideo';
            
            $data = array(
                "video_id" => $video_id
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=videos&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=videos&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="changePromotionsStatus") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
            $status = htmlspecialchars($_POST['status'], ENT_QUOTES);
            
            $url=$baseurl . 'approvePromotion';
            
            $data = array(
                "promotion_id" => $id,
                "active" => $status
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=promotion&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=promotion&action=success'</script>";
           }

        }
        else
        if($_GET['action']=="deletePromotions") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
            
            $url=$baseurl . 'deletePromotion';
            
            $data = array(
                "id" => $id
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=promotion&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=promotion&action=success'</script>";
           }

        }
        else
        if($_GET['action']=="deleteSticke") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $sticker_id = htmlspecialchars($_GET['sticker_id'], ENT_QUOTES);
            $url=$baseurl . 'deleteSticker';
            
            $data = array(
                "id" => $sticker_id
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=stickers&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=stickers&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="promoteVideo") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $video_id = htmlspecialchars($_GET['video_id'], ENT_QUOTES);
            $promote = htmlspecialchars($_GET['promote'], ENT_QUOTES);
            $url=$baseurl . 'promoteVideo';
            
            $data = array(
                "video_id" => $video_id,
                "promote" => $promote
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=videos&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=videos&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="deleteUser") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $user_id = htmlspecialchars($_GET['user_id'], ENT_QUOTES);
            
            $url=$baseurl . 'deleteUser';
            
            $data = array(
                "user_id" => $user_id
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=users&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=users&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="blockUser") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $user_id = htmlspecialchars($_GET['user_id'], ENT_QUOTES);
            $active = htmlspecialchars($_GET['active'], ENT_QUOTES);
            
            $url=$baseurl . 'blockUser';
            
            $data = array(
                "user_id" => $user_id,
                "active" => $active
              );
            
            $json_data=@curl_request($data,$url);
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=users&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=users&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="deleteSound") 
        {
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $sound_id = htmlspecialchars($_GET['sound_id'], ENT_QUOTES);
            
            $url=$baseurl . 'deleteSound';
            
            $data = array(
                "sound_id" => $sound_id
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=sounds&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=sounds&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="changeSoundStatus") 
        {
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $sound_id = htmlspecialchars($_GET['sound_id'], ENT_QUOTES);
            $status = htmlspecialchars($_GET['status'], ENT_QUOTES);
            
            $url=$baseurl . 'publishSound';
            
            $data = array(
                "sound_id" => $sound_id,
                "publish"=> $status
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=unpublishSound&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=unpublishSound&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="addSection") 
        {
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
            
            $url=$baseurl . 'addSoundSection';
            
            $data = array(
                "name" => $name
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=soundSection&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=soundSection&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="assignSoundSection") 
        {
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $sound_id = htmlspecialchars($_POST['sound_id'], ENT_QUOTES);
            $sound_section_id = htmlspecialchars($_POST['sound_section_id'], ENT_QUOTES);
            
            $url=$baseurl . 'addSoundInSection';
            
            $data = array(
                "sound_id" => $sound_id,
                "sound_section_id" => $sound_section_id
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=sounds&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=sounds&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="deleteSoundSection") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
            
            $url=$baseurl . 'deleteSoundSection';
            
            $data = array(
                "id" => $id
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=soundSection&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=soundSection&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="blockVideo") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $video_id = htmlspecialchars($_GET['video_id'], ENT_QUOTES);
            $status = htmlspecialchars($_GET['status'], ENT_QUOTES);
            
            $url=$baseurl . 'blockVideo';
            
            $data = array(
                "video_id" => $video_id,
                "block" => $status
              );
            
            $json_data=@curl_request($data,$url);
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=videos&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=videos&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="addSound") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
            $description = htmlspecialchars($_POST['description'], ENT_QUOTES);
            $audio_base = file_get_contents($_FILES['audio']['tmp_name']);
            $audio = base64_encode($audio_base);
            
            $thum_base = file_get_contents($_FILES['thum']['tmp_name']);
            $thum = base64_encode($thum_base);
            
            $url=$baseurl . 'addSound';
            
            $data = array(
                "name" => $name,
                "description" => $description,
                "audio" => $audio,
                "thum" => $thum
              );
            
            $json_data=@curl_request($data,$url);
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=sounds&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=sounds&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="addSticker") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
            $image_base = file_get_contents($_FILES['image']['tmp_name']);
            $image = base64_encode($image_base);
            
            $url=$baseurl . 'addSticker';
            
            $data = 
                array(
                    "title" => $name, 
                    "image" => array("file_data" => $image)
                );
           
            $json_data=@curl_request($data,$url);
          
           if($json_data['code'] !== 200)
           {
                echo "<script>window.location='dashboard.php?p=stickers&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=stickers&action=success'</script>";
           }

        }
        else
        if($_GET['action']=="changeVerificationStatus") 
        {

            $verification_request_id = htmlspecialchars($_GET['id'], ENT_QUOTES);
            $verified = htmlspecialchars($_GET['status'], ENT_QUOTES);
            
            $url=$baseurl . 'updateVerificationRequest';
            
            $data = array(
                "verification_request_id" => $verification_request_id,
                "verified" => $verified
              );
            
            $json_data=@curl_request($data,$url);
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=verificationRequest&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=verificationRequest&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="deleteSlider") 
        {

            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
            
            $url=$baseurl . 'deleteAppSlider';
            
            $data = 
                array(
                    "id" => $id
                );
            
            $json_data=@curl_request($data,$url);
           
           if($json_data['code'] !== 200)
           {
                echo "<script>window.location='dashboard.php?p=appSliders&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=appSliders&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="changePassword") 
        {
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $user_id = htmlspecialchars($_POST['user_id'], ENT_QUOTES);
            $new_password = htmlspecialchars($_POST['new_password'], ENT_QUOTES);
            $old_password = htmlspecialchars($_POST['password_previous'], ENT_QUOTES);
            
            $url=$baseurl . 'currentAdminChangePassword';
            
            $data = array(
                "user_id" => $user_id,
      		    "old_password" => $old_password,
      		    "new_password" => $new_password
            );
            
            $json_data=@curl_request($data,$url);
            
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=changePassword&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=changePassword&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="changeAdminUserPassword") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $user_id = htmlspecialchars($_POST['user_id'], ENT_QUOTES);
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
            
            $url=$baseurl . 'changeAdminPassword';
            
            $data = array(
                "user_id" => $user_id,
      		    "password" => $password
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=adminUsers&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=adminUsers&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="deleteComment") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $comment_id = htmlspecialchars($_GET['comment_id'], ENT_QUOTES);
            $url=$baseurl . 'deleteVideoComment';
            
            $data = array(
                "comment_id" => $comment_id
            );
            
            $json_data=@curl_request($data,$url);
            echo "200";
           
            
        }
        else
        if($_GET['action']=="pushNotification") 
        {
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $text = htmlspecialchars($_POST['text'], ENT_QUOTES);
           
            $url=$baseurl . 'sendPushNotificationToAllUsers';
            
            $data = array(
                "text" => $text
              );
            
            $json_data=@curl_request($data,$url);
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=pushNotification&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=pushNotification&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="addReportReason") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $title = htmlspecialchars($_POST['name'], ENT_QUOTES);
            
            $url=$baseurl . 'addReportReason';
            
            $data = array(
                "title" => $title
    		);
            
            $json_data=@curl_request($data,$url);
           
            
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=reportReasons&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=reportReasons&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="deleteReportReason") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
            
            $url=$baseurl . 'deleteReportReason';
            
            $data = array(
                "id" => $id
    		);
            
            $json_data=@curl_request($data,$url);
           
            
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=reportReasons&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=reportReasons&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="deleteReportedVideo") 
        {

            $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
            
            $url=$baseurl . 'deleteReportedVideo';
            
            $data = array(
                "id" => $id
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=reportedVideo&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=reportedVideo&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="deleteReportedUser") 
        {

            $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
            
            $url=$baseurl . 'deleteReportedUser';
            
            $data = array(
                "id" => $id
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=reportedUsers&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=reportedUsers&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="editReportReason") 
        {
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            
            $title = htmlspecialchars($_POST['name'], ENT_QUOTES);
            $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
            
            $url=$baseurl . 'addReportReason';
            
            $data = array(
                "title" => $title,
                "id" => $id
    		);
            
            $json_data=@curl_request($data,$url);
           
            
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=reportReasons&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=reportReasons&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="updatePage") 
        {
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $page = htmlspecialchars($_GET['page'], ENT_QUOTES);
            $data_from = htmlspecialchars($_POST['data_from'], ENT_QUOTES);
            
            $url=$baseurl . 'addHtmlPage';
            
            $data = array(
                "name" => $page,
                "text" => $data_from
    		);
            
            $json_data=@curl_request($data,$url);
           
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=$page&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=$page&action=success'</script>";
            }
    
            
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        ////old functions
        // if($_GET['action']=="addRider") 
        // {

        //     $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
        //     $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
        //     $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
        //     $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
        //     $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES);
        //     $city = htmlspecialchars($_POST['city'], ENT_QUOTES);
        //     $country = htmlspecialchars($_POST['country'], ENT_QUOTES);
        //     $rider_comission = htmlspecialchars($_POST['rider_comission'], ENT_QUOTES);
            
        //     $device_token = "";
        //     $role = "rider";
                        
        //     $url=$baseurl . 'registerRider';
            
        //     $data = 
        //         array(
        //             "email" => $email, 
        //             "password" => $password, 
        //             "first_name" => $first_name, 
        //             "last_name" => $last_name,
        //             "phone" => $phone,
        //             "device_token" => $device_token,
        //             "role" => $role,
        //             "city" => $city,
        //             "country_id" => $country,
        //             "rider_comission" => $rider_comission,
        //         );
            
        //     $json_data=@curl_request($data,$url);
           
            
         
        //   if($json_data['code'] !== 200)
        //   {
        //       $_SESSION[PRE_FIX.'error']=$json_data['msg'];
        //       echo "<script>window.location='dashboard.php?p=rider&action=error'</script>";
        //   }
        //   else
        //   {
        //         echo "<script>window.location='dashboard.php?p=rider&action=success'</script>";
        //   }

            
        // }
        
        if($_GET['action']=="addAdminUser") 
        {
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
            $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
            $email= htmlspecialchars($_POST['email'], ENT_QUOTES);
            $password=htmlspecialchars($_POST['password'], ENT_QUOTES);
    		$role='admin';
    		
            $url=$baseurl . 'addAdminUser';
            $data = array(
                "first_name" => $first_name, 
                "last_name" => $last_name, 
                "email" => $email,
    			"password"=> $password,
    			"role" => $role,
            );
            
            
            
            $json_data=@curl_request($data,$url);
          
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=adminUsers&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=adminUsers&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="addUser") 
        {
    
            $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
            $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
            $email= htmlspecialchars($_POST['email'], ENT_QUOTES);
            $password=htmlspecialchars($_POST['password'], ENT_QUOTES);
            $phone=htmlspecialchars($_POST['phone'], ENT_QUOTES);
            $country_id=htmlspecialchars($_POST['country_id'], ENT_QUOTES);
    		$role="user";
    		
            
            $url=$baseurl . 'addUser';
            
            $data = array(
                "first_name" => $first_name, 
                "last_name" => $last_name, 
                "email" => $email,
    			"password"=> $password,
    			"phone"=> $phone,
                "role" => $role,
                "rider_fee_per_order"=>"0",
                "admin_per_order_commission" => "0",
                "country_id"=>$country_id
    		);
            
            $json_data=@curl_request($data,$url);
           
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=users&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=users&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="deleteUserAdmin") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $user_id = htmlspecialchars($_GET['user_id'], ENT_QUOTES);
            
            $url=$baseurl . 'deleteAdmin';
            
            $data = array(
				"user_id" => $user_id
			);
            
            $json_data=@curl_request($data,$url);
            
            
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=adminUsers&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=adminUsers&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="editAdminUser") 
        {
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $user_id = htmlspecialchars($_POST['user_id'], ENT_QUOTES);
            $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
            $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
            
            $url=$baseurl . 'editAdminUser';
            
            $data = array(
                "id" => $user_id,
                "first_name" => $first_name, 
                "last_name" => $last_name, 
                "email" => $email,
                "role" => "admin"
              );
            
            $json_data=@curl_request($data,$url);
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=adminUsers&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=adminUsers&action=success'</script>";
           }
        }
        else
        if($_GET['action']=="editUser") 
        {

            $user_id = htmlspecialchars($_POST['user_id'], ENT_QUOTES);
            $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
            $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
            $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES);
            
            $url=$baseurl . 'editUser';
            
            $data = array(
                "user_id" => $user_id,
                "first_name" => $first_name, 
                "last_name" => $last_name, 
                "email" => $email,
                "phone" => $phone,
                "role" => "user",
                "rider_fee_per_order"=>"0",
                "admin_per_order_commission"=>"0"
              );
            
            $json_data=@curl_request($data,$url);
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=users&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=users&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="editRider") 
        {

            $user_id = htmlspecialchars($_POST['user_id'], ENT_QUOTES);
            $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
            $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
            $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES);
            $rider_fee_per_order = htmlspecialchars($_POST['rider_fee_per_order'], ENT_QUOTES);
            
            $url=$baseurl . 'editUser';
            
            $data = array(
                "user_id" => $user_id,
                "first_name" => $first_name, 
                "last_name" => $last_name, 
                "email" => $email,
                "phone" => $phone,
                "role" => "rider",
                "rider_fee_per_order"=>$rider_fee_per_order,
                "admin_per_order_commission"=>"0"
              );
            
            $json_data=@curl_request($data,$url);
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=riders&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=riders&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="acceptOrder") 
        {

            $id = htmlspecialchars($_GET['orderID'], ENT_QUOTES);
            $status = htmlspecialchars($_POST['status'], ENT_QUOTES);
            
            $url=$baseurl . 'adminResponseAgainstOrder';
            
            $data = array(
                "order_id" => $id,
                "status" => $status
              );
            
            $json_data=@curl_request($data,$url);
           
           if($json_data['code'] !== 200)
           {
                echo "<script>window.location='dashboard.php?p=manageOrders&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=manageOrders&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="AssignToRider") 
        {

            $orderID = htmlspecialchars($_GET['orderID'], ENT_QUOTES);
            $rider_id = htmlspecialchars($_GET['rider_id'], ENT_QUOTES);
            
            $url=$baseurl . 'assignOrderToRider';
            
            $data = array(
                "order_id" => $orderID,
                "rider_user_id" => $rider_id
              );
            
            $json_data=@curl_request($data,$url);
           
           if($json_data['code'] !== 200)
           {
                echo "<script>window.location='dashboard.php?p=manageOrders&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=manageOrders&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="addStore") 
        {
    
            $user_id= htmlspecialchars($_POST['user_id'], ENT_QUOTES);
            $name  =htmlspecialchars($_POST['name'], ENT_QUOTES);
    		$about=htmlspecialchars($_POST['about'], ENT_QUOTES);
    		
    		$shipping_base_fee=htmlspecialchars($_POST['shipping_base_fee'], ENT_QUOTES);
    		$shipping_fee_per_distance=htmlspecialchars($_POST['shipping_fee_per_distance'], ENT_QUOTES);
    		$distance_unit=htmlspecialchars($_POST['distance_unit'], ENT_QUOTES);
            
            $image_base = file_get_contents($_FILES['upload_image']['tmp_name']);
            $image = base64_encode($image_base);
            
            $image_base_cover = file_get_contents($_FILES['Cover_upload_image']['tmp_name']);
            $image_cover = base64_encode($image_base);
            
            
            $lat=htmlspecialchars($_POST['lat'], ENT_QUOTES);
    		$long=htmlspecialchars($_POST['long'], ENT_QUOTES);
    		$city=htmlspecialchars($_POST['city'], ENT_QUOTES);
    		$country_id=htmlspecialchars($_POST['country_id'], ENT_QUOTES);
    		$zip_code=htmlspecialchars($_POST['zip_code'], ENT_QUOTES);
    		$state=htmlspecialchars($_POST['state'], ENT_QUOTES);
            
            
            $url=$baseurl . 'addStore';
            
            $data = array(
                "user_id" => $user_id, 
                "name" => $name, 
                "logo" => array("file_data" => $image),
                "cover" => array("file_data" => $image_cover),
    			"about" => $about,
    			"shipping_base_fee" => $shipping_base_fee,
    			"shipping_fee_per_distance" => $shipping_fee_per_distance,
    			"distance_unit" => $distance_unit,
    			"city" => $city,
    			"state" => $state,
    			"country_id" => $country_id,
    			"zip_code" => $zip_code,
    			"lat" => $lat,
    			"long" => $long
    		);
                
           
            $json_data=@curl_request($data,$url);
           
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=store&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=store&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="editStore") 
        {
            $store_id= htmlspecialchars($_POST['store_id'], ENT_QUOTES);
            $user_id= htmlspecialchars($_POST['user_id'], ENT_QUOTES);
            $name  =htmlspecialchars($_POST['name'], ENT_QUOTES);
    		$about=htmlspecialchars($_POST['about'], ENT_QUOTES);
    		
    		$shipping_base_fee=htmlspecialchars($_POST['shipping_base_fee'], ENT_QUOTES);
    		$shipping_fee_per_distance=htmlspecialchars($_POST['shipping_fee_per_distance'], ENT_QUOTES);
    		$distance_unit=htmlspecialchars($_POST['distance_unit'], ENT_QUOTES);
            
            $lat=htmlspecialchars($_POST['lat'], ENT_QUOTES);
    		$long=htmlspecialchars($_POST['long'], ENT_QUOTES);
    		$city=htmlspecialchars($_POST['city'], ENT_QUOTES);
    		$country_id=htmlspecialchars($_POST['country_id'], ENT_QUOTES);
    		$zip_code=htmlspecialchars($_POST['zip_code'], ENT_QUOTES);
    		$state=htmlspecialchars($_POST['state'], ENT_QUOTES);
            
            
            if(!empty($_FILES['upload_image']['name']) && !empty($_FILES['Cover_upload_image']['name']))
            {
                $image_base = file_get_contents($_FILES['upload_image']['tmp_name']);
                $image = base64_encode($image_base);
                
                $image_base_cover = file_get_contents($_FILES['Cover_upload_image']['tmp_name']);
                $image_cover = base64_encode($image_base_cover);
                
                $data = array(
                    "id" => $store_id, 
                    "user_id" => $user_id, 
                    "name" => $name, 
                    "about" => $about,
        			"shipping_base_fee" => $shipping_base_fee,
        			"shipping_fee_per_distance" => $shipping_fee_per_distance,
        			"distance_unit" => $distance_unit,
        			"city" => $city,
        			"state" => $state,
        			"country_id" => $country_id,
        			"zip_code" => $zip_code,
        			"lat" => $lat,
        			"long" => $long,
        			"logo" => array("file_data" => $image),
                    "cover" => array("file_data" => $image_cover),
                );
               
                
            }
            else
            if(!empty($_FILES['upload_image']['name']))
            {
                $image_base = file_get_contents($_FILES['upload_image']['tmp_name']);
                $image = base64_encode($image_base);
                
                $data = array(
                    "id" => $store_id, 
                    "user_id" => $user_id, 
                    "name" => $name, 
                    "about" => $about,
        			"shipping_base_fee" => $shipping_base_fee,
        			"shipping_fee_per_distance" => $shipping_fee_per_distance,
        			"distance_unit" => $distance_unit,
        			"city" => $city,
        			"state" => $state,
        			"country_id" => $country_id,
        			"zip_code" => $zip_code,
        			"lat" => $lat,
        			"long" => $long,
        			"logo" => array("file_data" => $image),
                );
            } 
            else
            if(!empty($_FILES['Cover_upload_image']['name']))
            {
                $image_base_cover = file_get_contents($_FILES['Cover_upload_image']['tmp_name']);
                $image_cover = base64_encode($image_base_cover);
                
                $data = array(
                    "id" => $store_id, 
                    "user_id" => $user_id, 
                    "name" => $name, 
                    "about" => $about,
        			"shipping_base_fee" => $shipping_base_fee,
        			"shipping_fee_per_distance" => $shipping_fee_per_distance,
        			"distance_unit" => $distance_unit,
        			"city" => $city,
        			"state" => $state,
        			"country_id" => $country_id,
        			"zip_code" => $zip_code,
        			"lat" => $lat,
        			"long" => $long,
        			"cover" => array("file_data" => $image_cover),
                );
            } 
            else
            {
                $data = array(
                    "id" => $store_id, 
                    "user_id" => $user_id, 
                    "name" => $name, 
                    "about" => $about,
        			"shipping_base_fee" => $shipping_base_fee,
        			"shipping_fee_per_distance" => $shipping_fee_per_distance,
        			"distance_unit" => $distance_unit,
        			"city" => $city,
        			"state" => $state,
        			"country_id" => $country_id,
        			"zip_code" => $zip_code,
        			"lat" => $lat,
        			"long" => $long
                );
            }
            
            
            
            $url=$baseurl . 'addStore';
            
            $json_data=@curl_request($data,$url);
            
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=store&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=store&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="deleteProduct") 
        {

            $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
            $store_id = htmlspecialchars($_GET['store_id'], ENT_QUOTES);
            
            $url=$baseurl . 'deleteProduct';
            
            $data = array(
				"product_id" => $id
			);
            
            $json_data=@curl_request($data,$url);
            
            
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=manageProducts&store_id=".$store_id."&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=manageProducts&store_id=".$store_id."&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="addProduct") 
        {

            $store_id = htmlspecialchars($_POST['store_id'], ENT_QUOTES);
            $category_id = htmlspecialchars($_POST['category_id'], ENT_QUOTES);
            $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
            $description = htmlspecialchars($_POST['description'], ENT_QUOTES);
            $price = htmlspecialchars($_POST['price'], ENT_QUOTES);
            $sale_price = htmlspecialchars($_POST['sale_price'], ENT_QUOTES);
            
            // Count total files
             $countfiles = count($_POST['productImage']);
            
             // Looping all files
             $array_out = array();
             for($i=0;$i<$countfiles;$i++){
                $filename = str_replace("data:image/jpeg;base64,","",$_POST['productImage'][$i]);
                
                $array_out[] = 
    			array(
    			        "image" => array("file_data" => $filename)
    			    );
             
             }
             
            $url=$baseurl . 'addProduct';
            
            $data = array(
				"store_id" => $store_id,
				"category_id" => $category_id,
				"title" => $title,
				"description" => $description,
				"price" => $price,
				"sale_price" => $sale_price,
				"images" => $array_out
			);
            
          
            $json_data=@curl_request($data,$url);
            
            
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=manageProducts&store_id=".$store_id."&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=manageProducts&store_id=".$store_id."&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="editProduct") 
        {

            $store_id = htmlspecialchars($_POST['store_id'], ENT_QUOTES);
            $category_id = htmlspecialchars($_POST['category_id'], ENT_QUOTES);
            $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
            $description = htmlspecialchars($_POST['description'], ENT_QUOTES);
            $price = htmlspecialchars($_POST['price'], ENT_QUOTES);
            $sale_price = htmlspecialchars($_POST['sale_price'], ENT_QUOTES);
            $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
             
            $url=$baseurl . 'addProduct';
            
            $data = array(
				"id"=>$id,
				"store_id" => $store_id,
				"category_id" => $category_id,
				"title" => $title,
				"description" => $description,
				"price" => $price,
				"sale_price" => $sale_price
			);
            
          
            $json_data=@curl_request($data,$url);
            
            
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=manageProducts&store_id=".$store_id."&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=manageProducts&store_id=".$store_id."&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="updateStatus") 
        {

            $store_id = htmlspecialchars($_GET['store_id'], ENT_QUOTES);
            $active = htmlspecialchars($_GET['active'], ENT_QUOTES);
            
            $url=$baseurl . 'updateStoreActiveStatus';
            
            $data = array(
                "store_id" => $store_id,
                "active" => $active
              );
            
            $json_data=@curl_request($data,$url);
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=store&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=store&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="orderStatus") 
        {

            $order_id = htmlspecialchars($_GET['order_id'], ENT_QUOTES);
            $status = htmlspecialchars($_GET['status'], ENT_QUOTES);
            
            $url=$baseurl . 'updateOrderStatus';
            
            $data = array(
                "order_id" => $order_id,
                "status" => $status
              );
            
            $json_data=@curl_request($data,$url);
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=manageOrders&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=manageOrders&action=success'</script>";
           }

            
        }
        else
        if($_GET['action']=="addRider") 
        {
    
            $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
            $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
            $email= htmlspecialchars($_POST['email'], ENT_QUOTES);
            $password=htmlspecialchars($_POST['password'], ENT_QUOTES);
            $phone=htmlspecialchars($_POST['phone'], ENT_QUOTES);
            $rider_fee_per_order=htmlspecialchars($_POST['rider_fee_per_order'], ENT_QUOTES);
            $country_id=htmlspecialchars($_POST['country_id'], ENT_QUOTES);
    		$role="rider";
    		
            
            $url=$baseurl . 'addUser';
            
            $data = array(
                "first_name" => $first_name, 
                "last_name" => $last_name, 
                "email" => $email,
                "phone" => $phone,
    			"password"=> $password,
                "role" => $role,
                "rider_fee_per_order"=>$rider_fee_per_order,
                "admin_per_order_commission" => "0",
                "country_id"=>$country_id
    		);
            
            $json_data=@curl_request($data,$url);
           
            
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=riders&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=riders&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="addStoreStore") 
        {
    
            $first_name = htmlspecialchars($_POST['first_name'], ENT_QUOTES);
            $last_name = htmlspecialchars($_POST['last_name'], ENT_QUOTES);
            $email= htmlspecialchars($_POST['email'], ENT_QUOTES);
            $password=htmlspecialchars($_POST['password'], ENT_QUOTES);
            $phone=htmlspecialchars($_POST['phone'], ENT_QUOTES);
            $country_id=htmlspecialchars($_POST['country_id'], ENT_QUOTES);
    		$role="store";
    		
            
            $url=$baseurl . 'addUser';
            
            $data = array(
                "first_name" => $first_name, 
                "last_name" => $last_name, 
                "email" => $email,
                "phone" => $phone,
    			"password"=> $password,
                "role" => $role,
                "rider_fee_per_order"=>"",
                "admin_per_order_commission" => "0",
                "country_id"=>$country_id
    		);
            
            $json_data=@curl_request($data,$url);
           
            
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=store&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=store&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="favCategory") 
        {
    
            $category_id = htmlspecialchars($_GET['category_id'], ENT_QUOTES);
            $featured = htmlspecialchars($_GET['featured'], ENT_QUOTES);
            
            $url=$baseurl . 'featuredCategory';
            
            $data = array(
                "category_id" => $category_id, 
                "featured" => $featured
    		);
            
            $json_data=@curl_request($data,$url);
           
            
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=manageCategory&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=manageCategory&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="editVideoViews") 
        {
    
            $video_id = htmlspecialchars($_POST['video_id'], ENT_QUOTES);
            $view = htmlspecialchars($_POST['view'], ENT_QUOTES);
            
            $url=$baseurl . 'editVideoViews';
            
            $data = array(
                "video_id" => $video_id, 
                "view" => $view
    		);
            
            $json_data=@curl_request($data,$url);
           
            
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=videos&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=videos&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="editSlider") 
        {
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
            $slider_Url = htmlspecialchars($_POST['url'], ENT_QUOTES);
            
            
            if(isset($_FILES['image']))
            {
                $image_base = file_get_contents($_FILES['image']['tmp_name']);
                $image = base64_encode($image_base);
                
                $data = 
                    array(
                        "id" =>$id,
                        "url" => $slider_Url, 
                        "image" => array("file_data" => $image)
                    );
            }
            else
            {
                $data = 
                    array(
                        "id" =>$id,
                        "url" => $slider_Url
                    );   
            }
            
            $url=$baseurl . 'addAppSlider';
            
            $json_data=@curl_request($data,$url);
           
            
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=appSliders&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=appSliders&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="importData") 
        {
    
            // $image_base = file_get_contents($_FILES['import_file']['tmp_name']);
            // $image = base64_encode($image_base);
            
            $json_file =$_FILES['import_file'];
            
            print_r($_FILES);
            
            $data = 
            array(
                "json" => $json_file
            );
            
            $url=$baseurl.'importJsonFile';
            
            $json_data=@curl_request($data,$url);
            
            print_r($json_data);
            die();
           
            if($json_data['code'] == 200)
            {
                echo "<script>window.location='dashboard.php?p=importData&action=success'</script>";
            }
            else
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=importData&action=error'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="deleteImportJsonFile") 
        {
    
            $filePath = $_GET['filePath'];
            
            $data = 
            array(
                "file_path" => $filePath
            );
            
            $url=$baseurl . 'deleteJsonFile';
            
            $json_data=@curl_request($data,$url);
           
            if($json_data['code'] == 200)
            {
                echo "<script>window.location='dashboard.php?p=importData&action=success'</script>";
            }
            else
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=importData&action=error'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="addAppSliderImage") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $image_base = file_get_contents($_FILES['image']['tmp_name']);
            $image = base64_encode($image_base);
            
            $url=$baseurl . 'addAppSlider';
            
            $data = 
                array(
                    "url" => "", 
                    "image" => array("file_data" => $image)
                );
           
            $json_data=@curl_request($data,$url);
          
           if($json_data['code'] !== 200)
           {
                echo "<script>window.location='dashboard.php?p=appSliders&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=appSliders&action=success'</script>";
           }

        }
        else
        if($_GET['action']=="addGifts") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
            $coin = htmlspecialchars($_POST['coin'], ENT_QUOTES);
            $image_base = file_get_contents($_FILES['giftImage']['tmp_name']);
            $image = base64_encode($image_base);
            
            $data = 
            array(
                "title" => $title,
                "image" => $image,
                "coin" => $coin
            );
            
            $url=$baseurl . 'addGift';
            $json_data=@curl_request($data,$url);
          
           if($json_data['code'] !== 200)
           {
                echo "<script>window.location='dashboard.php?p=gifts&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=gifts&action=success'</script>";
           }

        }
        else
        if($_GET['action']=="editGift") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
            $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
            $coin = htmlspecialchars($_POST['coin'], ENT_QUOTES);
            
            if($_FILES['giftImage']['size']!=0)
            {
                $image_base = file_get_contents($_FILES['giftImage']['tmp_name']);
                $image = base64_encode($image_base);
                
                $data = 
                array(
                    "id" => $id,
                    "title" => $title,
                    "image" => $image,
                    "coin" => $coin
                );   
            }
            else
            {
                 $data = 
                    array(
                        "id" => $id,
                        "title" => $title,
                        "coin" => $coin
                    );
            }
            
            
            $url=$baseurl . 'addGift';
            $json_data=@curl_request($data,$url);
          
           if($json_data['code'] !== 200)
           {
                echo "<script>window.location='dashboard.php?p=gifts&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=gifts&action=success'</script>";
           }

        }
        else
        if($_GET['action']=="editCoinWorth") 
        {
            
            // if(status=="demo")
            // {
            //     echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
            //     die();
            // }
            
            $coinPrice = htmlspecialchars($_POST['coinPrice'], ENT_QUOTES);
            
            $data = 
            array(
                "price" => $coinPrice
            );
            
            $url=$baseurl . 'addCoinWorth';
            $json_data=@curl_request($data,$url);
          
           if($json_data['code'] !== 200)
           {
                echo "<script>window.location='dashboard.php?p=giftsSetting&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=giftsSetting&action=success'</script>";
           }

        }
        else
        if($_GET['action']=="deleteGift") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
            
            $data = 
            array(
                "id" => $id
            );
            
            $url=$baseurl . 'deleteGift';
            $json_data=@curl_request($data,$url);
          
           if($json_data['code'] !== 200)
           {
                echo "<script>window.location='dashboard.php?p=gifts&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=gifts&action=success'</script>";
           }

        }
        else
        if($_GET['action']=="changeWithdrawRequestStatus") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $id = htmlspecialchars($_GET['id'], ENT_QUOTES);
            $status = htmlspecialchars($_GET['status'], ENT_QUOTES);
            
            
            $data = 
            array(
                "id" => $id,
                "status" => $status
            );
            
            $url=$baseurl . 'withdrawRequestApproval';
            $json_data=@curl_request($data,$url);
          
           if($json_data['code'] !== 200)
           {
                echo "<script>window.location='dashboard.php?p=withdrawRequest&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=withdrawRequest&action=success'</script>";
           }

        }
        else
        if($_GET['action']=="sendVideoPushNotificationToAllUsers") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $video_id = htmlspecialchars($_POST['id'], ENT_QUOTES);
            $text = htmlspecialchars($_POST['text'], ENT_QUOTES);
            $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
            
            
            $data = 
            array(
                "video_id" =>$video_id,
                "text" => $text,
                "title" => $title
            ); 
            
            $url=$baseurl . 'sendVideoPushNotificationToAllUsers';
            
            $json_data=@curl_request($data,$url);
           
           
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=videos&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=videos&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="sendUserAccountNotificationToAllUsers") 
        {
            
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $user_id = htmlspecialchars($_POST['id'], ENT_QUOTES);
            $text = htmlspecialchars($_POST['text'], ENT_QUOTES);
            $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
            
            
            $data = 
            array(
                "user_id" =>$user_id,
                "text" => $text,
                "title" => $title
            ); 
            
            $url=$baseurl . 'sendUserAccountNotificationToAllUsers';
            
            $json_data=@curl_request($data,$url);
           
           
            if($json_data['code'] !== 200)
            {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=users&action=error'</script>";
            }
            else
            {
                echo "<script>window.location='dashboard.php?p=users&action=success'</script>";
            }
    
            
        }
        else
        if($_GET['action']=="updateSection") 
        {
            if(status=="demo")
            {
                echo "<script>window.location='dashboard.php?p=users&action=notAllowDemo'</script>";
                die();
            }
            
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
            $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
            
            $url=$baseurl . 'addSoundSection';
            
            $data = array(
                "name" => $name,
                "id" => $id
            );
            
            $json_data=@curl_request($data,$url);
            
           
           if($json_data['code'] !== 200)
           {
                $_SESSION[PRE_FIX.'error']=$json_data['msg'];
                echo "<script>window.location='dashboard.php?p=soundSection&action=error'</script>";
           }
           else
           {
                echo "<script>window.location='dashboard.php?p=soundSection&action=success'</script>";
           }

            
        }
        
        
    }
     
    
}



?>