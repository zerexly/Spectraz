<?php
include("config.php");

if(isset($_GET['action'])) 
{
    
    if ($_GET['action'] == "addAudience") 
    {
        $array_data = $_POST;
        $range = explode(",", $array_data['rangs']);
        $locationarray = [];
        foreach ($array_data['location'] as $single) 
        {
            $locationarray[]['name'] = $single;
        }
        $data = [
            "user_id" => 3,
            "name" => $array_data['audience_name'],
            "gender" => $array_data['gender'],
            "min_age" => $range[0],
            "max_age" => $range[1],
            "locations" => $locationarray,
        ];
        $endpoint = "addAudience";
        $json_data = curl_request($data, $endpoint, $baseurl);


        if ($json_data['code'] !== 200) 
        {
            echo "<script>window.location=iindex2.php</script>";
        } 
        else 
        {
            echo "<script>window.location='showAudience.php?action=success'</script>";
        }

    }
    
    
    if ($_GET['action'] == "showDestinationajax") {
        $audienceid = $_POST['audience'][0];
        if (!empty($_POST['destination'])) {
            $destiantion = $_POST['destination'];
            $websiteurl = "";
        } else {
            $destiantion = "website";
            $websiteurl = $_POST['website_url'];
        }
        $arraypost = [
            "audience" => $audienceid,
            "destiantion" => $destiantion,
            "websiteurl" => $websiteurl,
        ];
      $jsonposted = base64_encode(json_encode($arraypost));

      echo "<script>window.location='showbudget.php?iddata=$jsonposted'</script>";

    }
    if ($_GET['action'] == "addPromoajax") {
        $converted = $_POST;
        $startdate = $converted['startdate'];
        $enddate = $converted['enddate'];

        $startdate = replacedateformate($startdate);
        $enddate = replacedateformate($enddate);


        $data = [
            "user_id" => 3,
            "video_id" => $converted['video_id'],
            "destination" => $converted['profile'],
            "website_url" => $converted['profile'],
            "start_datetime" => $startdate,
            "end_datetime" => $enddate,
            "audience_id" => $converted['audienceid'],
        ];
        $endpoint = "addPromotion";
        $json_data = curl_request($data, $endpoint, $baseurl);
        if ($json_data['code'] !== 200) {
            echo "<script>window.location=index.php</scrindex2.php";
        } else {
            echo "<script>window.location='index.php?action=success'</script>";
        }


    }
}

?>