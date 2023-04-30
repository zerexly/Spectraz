<?php

require_once 'vendor/autoload.php';


$facebook = new \Facebook\Facebook([
  'app_id'      => '500123903658910',
  'app_secret'     => '11235e0c99fa733fe67b2b25b9988b6c',
  'default_graph_version'  => 'v2.10'
]);
$access_token = "EAAHHnWt5954BAOVvITzVRVuI9xM3aN8vbldMkQGzNWpz4fLI6lV1r6SZBIeqmZCRaey07foIhXSW9JZBxaMb3zuQYXuwoQMvWF1XJ2wHASZBZAfGysnSZBbK1M6vOCFkN9DbVwJGiTaExrf4mCDlD6imVO0olooCYWPqNQbz5rwxq4pq4UnRTDNUkVYn0Cz1JUJZA3VC9Kf9VTJeN22rt3D5itBWvMHeZCMZD";
 $graph_response = $facebook->get("/me?fields=name,email", $access_token);
$facebook_user_info = $graph_response->getGraphUser();
 if(!empty($facebook_user_info['id']))
 {
  echo 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
 }
print_r($facebook_user_info)
?>