<?php
include("config.php");

if (isset($_GET['action'])) 
{
    
    if ($_GET['action'] == "showLocation") 
    {
        $search = $_POST['search'];

        $data = [
            "keyword" => $search,
        ];
        $endpoint = $baseurl."showLocations";
        $json_data = curl_request($data, $endpoint);

        if($json_data['code']=="200")
        {
            $json_data = $json_data['msg'];
        
            foreach ($json_data as $singleRow)
            {
                ?>
                    <div class='locationmain' onclick=addLocation('<?php echo str_replace(' ',',',$singleRow['name']); ?>','<?php echo $singleRow['country_id']; ?>','<?php echo $singleRow['state_id']; ?>','<?php echo $singleRow['city_id']; ?>') style="padding: 7px 7px;">
                        <p><?php echo $singleRow['name']; ?></p>
                        <input type='hidden' class='valueoflocation' value='<?php echo $singleRow['country_id']; ?>'>
                        <input type='hidden' class='valueoflocation' value='<?php echo $singleRow['state_id']; ?>'>
                        <input type='hidden' class='valueoflocation' value='<?php echo $singleRow['city_id']; ?>'>
                    </div>
                <?php
            }
            
        }
        else
        {
            echo "201";
        }

        
        
        // $loctions = [];
        // foreach ($json_data as $singel) {
        //     $loctions[]['location'] = $singel['User']['country'];
        // }

        // echo json_encode($loctions);
        exit();
    }
    
    if ($_GET['action'] == "search_user_keyword") 
    {
        $search = $_POST['search'];
        $user_id = $_POST['user_id'];

        $data = [
            "keyword" => $search,
            "user_id" => $user_id
        ];
        $endpoint = $baseurl."searchInfluencers";
        $json_data = curl_request($data, $endpoint);
    
        if($json_data['code']=="200")
        {
            $json_data = $json_data['msg'];
        
            foreach ($json_data as $singleRow)
            {
                ?>
                    <div class='locationmain' onclick=addInfluencer('<?php echo str_replace(' ',',',$singleRow['User']['first_name']." ".$singleRow['User']['last_name']); ?>','<?php echo $singleRow['User']['id']; ?>') style="padding: 14px 7px;">
                        <p style="background:url('<?php echo $image_baseurl.$singleRow['User']['profile_pic']; ?>'); height:30px; width:30px;background-size: cover;border-radius: 100%;position: absolute;margin-top: -6px;"></p>
                        <p style="margin-left: 38px;"><?php echo $singleRow['User']['first_name']." ".$singleRow['User']['last_name']; ?></p>
                        <input type='hidden' class='valueoflocation' value='<?php echo $singleRow['User']['id']; ?>'>
                    </div>
                <?php
            }
            
        }
        else
        {
            echo "201";
        }

        
        
        // $loctions = [];
        // foreach ($json_data as $singel) {
        //     $loctions[]['location'] = $singel['User']['country'];
        // }

        // echo json_encode($loctions);
        exit();
    }
    
    if($_GET['action'] == "add_Audience") 
    {
        if($_GET['male']=="male" && $_GET['female']=="female")
        {
            $gender="all";
        }
        else
        if($_GET['male']=="male" && $_GET['female']=="")
        {
            $gender="male";
        }
        else
        if($_GET['male']=="" && $_GET['female']=="female")
        {
            $gender="female";
        }
        
        $range = explode(",", $_GET['age_range']);
        
        $location_string=rtrim($_GET['countries'], ',');
        $location_string=explode(",",$location_string);
        
        $locationarray ="";
        foreach($location_string as $key=>$single) 
        {
            $locationarray[$key]['name']= $single;
        }
        
        $location_Array=json_decode($_GET["countries"]);
        
        //print_r($location_Array);
        
        $data = [
            "user_id" => $_GET['user_id'],
            "name" => $_GET['audience_name'],
            "gender" => $gender,
            "min_age" => $range[0],
            "max_age" => $range[1],
            "locations" => $location_Array,
        ];
        
        //echo json_encode($data,true);
        
        $endpoint = $baseurl."addAudience";
        $json_data = curl_request($data, $endpoint);
        echo $json_data['code'];
        
        
        
    }
    
    if($_GET['action'] == "create_promotion") 
    {
        
        $data_audience_id=$_GET['data_audience_id'];
        $budget=$_GET['budget'];
        $days=$_GET['days'];
        $video_id=$_GET['video_id'];
        $user_id=$_GET['user_id'];
        $data_website_url=$_GET['data_website_url'];
        $data_influencer=$_GET['data_influencer'];
        
        $current_today_date = date("Y-m-d H:i:s");
        $calculate_dates = date("Y-m-d H:i:s", strtotime("+$days days"));
        
        if($data_website_url=="My_Profile")
        {
            $destination="profile";
            $website_url="";
        }
        else
        {
            $destination="website";
            $website_url=$data_website_url;
        }
       
       
        $influencer_array=$data_influencer;
        
        $influencer_array = rtrim($influencer_array, ',');
        $influencer_array = json_decode("[".$influencer_array."]");
        
        
        $data = [
            "video_id" => $video_id,
            "user_id" => $user_id,
            "destination" => $destination,
            "website_url" => $website_url,
            "start_datetime" => $current_today_date,
            "end_datetime" => $calculate_dates,
            "audience_id" => $data_audience_id,
            "users" =>$influencer_array,
            "price" => $budget
        ];
        
        $session_string=json_encode($data,true);
        
        // echo $session_string;
        // die();
        
        $endpoint = $baseurl."addOrderSession";
        
        $data = [
            "string" =>$session_string,
            "user_id" => $user_id
        ];
        json_encode($data,true);
        // $endpoint = $baseurl."addOrderSession";
        
        $json_data = curl_request($data, $endpoint);
        
        if($json_data['code']=="200")
        {
            echo $json_data['msg']['OrderSession']['id'];
        }
        else
        {
            echo "error";
        }
        
        
        
    }
    
    
    if($_GET['action'] == "deleteAudience") 
    {
        
        $id=$_GET['id'];
        
        $data = [
            "id" => $id
        ];
        json_encode($data,true);
        $endpoint = $baseurl."deleteAudience";
        
        $json_data = curl_request($data, $endpoint);
        //print_r($json_data);
        if($json_data['code']=="200")
        {
            echo $json_data['code'];
        }
        else
        {
           echo $json_data['msg'];
        }
        
        
        
    }
    
    if($_GET['action'] == "calculate_countries_reach") 
    {
        
        $countries_array=$_GET['countries_array'];
        
        // print_r($countries_array);
        $countries_array = rtrim($countries_array, ',');
        $countries_array = json_decode("[".$countries_array."]");
        //print_r($countries_array);
        
        $data = [
            "locations" => $countries_array
        ];
        
        $endpoint = $baseurl."showAudiencesReach";
        $json_data = curl_request($data, $endpoint);
        
        if($json_data['code']=="200")
        {
            echo $json_data['msg'];
        }
        else
        {
            //echo $json_data['msg'];
            echo "0";
        }
        
    }
    
    if($_GET['action'] == "calculate_influencer_user_reach") 
    {
        
        $influencer_user_array=$_GET['influencer_user_array'];
        
        // print_r($countries_array);
        $influencer_user_array = rtrim($influencer_user_array, ',');
        $influencer_user_array = json_decode("[".$influencer_user_array."]");
        //print_r($countries_array);
        
        $data = [
            "users" => $influencer_user_array
        ];
        
        $endpoint = $baseurl."showInfluencersReach";
        $json_data = curl_request($data, $endpoint);
        
        if($json_data['code']=="200")
        {
            echo $json_data['msg'];
        }
        else
        {
            //echo $json_data['msg'];
            echo "0";
        }
        
    }
    
    if($_GET['action'] == "calculate_create_audience_reach") 
    {
        
        $countries_array=$_GET['countries_array'];
        $male=$_GET['male'];
        $female=$_GET['female'];
        $age_range=$_GET['age_range'];
        
        if($male=="male" && $female=="female")
        {
            $gender="all";
        }
        else
        if($male=="male" && $female=="")
        {
            $gender="male";
        }
        else
        if($male=="" && $female=="female")
        {
            $gender="female";
        }
        
        $age_range=explode(",",$age_range);
        $min_age=$age_range[0];
        $max_age=$age_range[1];
        
        //print_r($countries_array);
        $countries_array = rtrim($countries_array, ',');
        $countries_array = json_decode($countries_array);
        
        //print_r($countries_array);
        
        $data = [
            "locations" => $countries_array,
            "gender" => $gender,
            "min_age" => $min_age,
            "max_age" => $max_age,
        ];
        
        $endpoint = $baseurl."showAudiencesReach";
        $json_data = curl_request($data, $endpoint);
        
        //echo json_encode($data,true);
        if($json_data['code']=="200")
        {
            echo $json_data['msg'];
        }
        else
        {
            //echo $json_data['msg'];
            echo "0";
        }
        
    }
    
    
    
}

?>