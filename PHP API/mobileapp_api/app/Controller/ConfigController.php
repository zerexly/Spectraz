<?php

App::uses('Lib', 'Utility');


App::uses('Extended', 'Lib');


class ConfigController extends AppController
{

    //public $components = array('Email');

   // public $autoRender = false;
    public $layout = false;






   /* public function beforeFilter()
    {



        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $headers[str_replace(' ', '', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))))] = $value;
            }
        }
        pr($headers);

    }*/
    public function phpInfo(){


        $this->autoRender = true;
        echo phpinfo();
    }


    public function view(){
        $this->autoRender = true;

        $this->loadModel('Video');
        $params = $this->params['url'];
        
         $url_param = key($params);
        $video_id = (int) filter_var($url_param, FILTER_SANITIZE_NUMBER_INT);

        $video_detail = $this->Video->getDetails($video_id);


        //config


        $config_data = array();
        if (method_exists('Extended', 'testFileUploadToS3')) {
            $result = Extended::testFileUploadToS3("app/webroot/uploads/images/test.jpg");


            $config_data['s3'] = $result;
            $this->set('config_data', $config_data);




        }else{

            $this->set('config_data',$config_data);
        }

        $data['config_data'] = $config_data;
        $data['video_detail'] = $video_detail;

        //
        $this->set('data', $data);
        //$this->layout = true;
    }



    public function config()
    {
        $this->autoRender = true;
        $config_data = array();
        if (method_exists('Extended', 'testFileUploadToS3')) {
            $result = Extended::testFileUploadToS3("app/webroot/uploads/images/test.jpg");


            $config_data['s3'] = $result;
                $this->set('config_data', $config_data);




        }else{

            $this->set('config_data',$config_data);
        }

    }

    public function setupPrivacyAndPush(){

        $this->loadModel('User');
        $this->loadModel('PrivacySetting');
        $this->loadModel('PushNotification');

        $users = $this->User->getAllUsers();

        foreach($users as $key=>$user){


            $user_id = $user['User']['id'];
            $notification[$key]['likes'] = 1;
            $notification[$key]['comments'] = 1;
            $notification[$key]['new_followers'] = 1;
            $notification[$key]['mentions'] = 1;
            $notification[$key]['direct_messages'] = 1;
            $notification[$key]['video_updates'] = 1;
            $notification[$key]['id'] = $user_id;

           // $this->PushNotification->save($notification);


            $settings[$key]['videos_download'] = 1;
            $settings[$key]['videos_repost'] = 1;
            $settings[$key]['direct_message'] = "everyone";
            $settings[$key]['duet'] = "everyone";
            $settings[$key]['liked_videos'] = "me";
            $settings[$key]['video_comment'] = "everyone";
            $settings[$key]['id'] = $user_id;

            //$this->PrivacySetting->save($settings);

        }

        $this->PushNotification->saveAll($notification);
        $this->PrivacySetting->saveAll($settings);
    }


    function findKey($array, $keySearch)
    {
        foreach ($array as $key => $item) {
            if ($key == $keySearch) {


                return true;
            } elseif (is_array($item) && findKey($item, $keySearch)) {
                return true;
            }
        }
        return false;
    }


    public function showApiSettings(){
        $this->autoRender = false;
        $this->loadModel('ApiSetting');

        $details = $this->ApiSetting->getAll();

        if(count($details) > 0){

            pr($details);

            $API_KEY = $this->findKey($details,"APP_KEY");



                foreach($details as $key=>$detail){

                   $title =  $detail["ApiSetting"]['title'];
                   $value =  $detail["ApiSetting"]['value'];

                    if($title == "API_KEY"){

                        $array[$key]['API_KEY'] = $value;

                    }

                    if($title == "API_STATUS"){

                        $array[$key]['API_STATUS'] = $value;

                    }

            }

            Configure::write(
                'ApiSetting',$array
            );

        }

    }


    public function updateConstantFile()
    {

        $this->autoRender = false;

        if ($this->request->isPost()) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, TRUE);
            $file_path = ROOT . DS . 'app' . DS . 'Config' . DS . 'constant1.php';


            /*******************/

            if (isset($data['api_key'])) {
                $api_key = $data['api_key'];
                $string_to_replace = "%api_key";
                $replace_with = $api_key;
                $content = file_get_contents($file_path);
                $content_chunks = explode($string_to_replace, $content);
                $content = implode($replace_with, $content_chunks);
                file_put_contents($file_path, $content);


            }
            /*******************/

            if (isset($data['admin_api_key'])) {
                $admin_api_key = $data['admin_api_key'];

                $string_to_replace = "%admin_api_key";
                $replace_with = $admin_api_key;
                $content = file_get_contents($file_path);
                $content_chunks = explode($string_to_replace, $content);
                $content = implode($replace_with, $content_chunks);
                file_put_contents($file_path, $content);

            }
            /*******************/


            /*******************/
            if (isset($data['time_zone'])) {

                $time_zone = $data['time_zone'];
                $string_to_replace = "%time_zone";
                $replace_with = $time_zone;
                $content = file_get_contents($file_path);
                $content_chunks = explode($string_to_replace, $content);
                $content = implode($replace_with, $content_chunks);
                file_put_contents($file_path, $content);

            }
            /*******************/


            if (isset($data['base_url'])) {
                $base_url = $data['base_url'];

                $string_to_replace = "%base_url";
                $replace_with = $base_url;
                $content = file_get_contents($file_path);
                $content_chunks = explode($string_to_replace, $content);
                $content = implode($replace_with, $content_chunks);
                file_put_contents($file_path, $content);

            }
            /*******************/


            if (isset($data['app_name'])) {

                $string_to_replace = "%app_name";
                $replace_with = $data['app_name'];
                $content = file_get_contents($file_path);
                $content_chunks = explode($string_to_replace, $content);
                $content = implode($replace_with, $content_chunks);
                file_put_contents($file_path, $content);

            }
            /*******************/


            if (isset($data['database_host']) && isset($data['database_user']) && isset($data['database_password']) && isset($data['database_name'])) {

              echo  $db_result = $this->checkDatabaseConnection();


                    $string_to_replace = "%database_host";
                    $replace_with = $data['database_host'];
                    $content = file_get_contents($file_path);
                    $content_chunks = explode($string_to_replace, $content);
                    $content = implode($replace_with, $content_chunks);
                    file_put_contents($file_path, $content);


                    $string_to_replace = "%database_user";
                    $replace_with = $data['database_user'];
                    $content = file_get_contents($file_path);
                    $content_chunks = explode($string_to_replace, $content);
                    $content = implode($replace_with, $content_chunks);
                    file_put_contents($file_path, $content);


                    $string_to_replace = "%database_password";
                    $replace_with = $data['database_password'];
                    $content = file_get_contents($file_path);
                    $content_chunks = explode($string_to_replace, $content);
                    $content = implode($replace_with, $content_chunks);
                    file_put_contents($file_path, $content);


                    $string_to_replace = "%database_name";
                    $replace_with = $data['database_name'];
                    $content = file_get_contents($file_path);
                    $content_chunks = explode($string_to_replace, $content);
                    $content = implode($replace_with, $content_chunks);
                    file_put_contents($file_path, $content);

                if(!$db_result) {

                    $output['code'] = 201;

                    $output['msg'] = "database not connected";


                    echo json_encode($output);


                    die();
                }

            }


            /*******************/

            if (isset($data['firebase_push_notification_key'])) {

                $string_to_replace = "%firebase_push_notification_key";
                $replace_with = $data['firebase_push_notification_key'];
                $content = file_get_contents($file_path);
                $content_chunks = explode($string_to_replace, $content);
                $content = implode($replace_with, $content_chunks);
                file_put_contents($file_path, $content);

            }


            /*******************/

            if (isset($data['twilio_account_id']) && isset($data['twilio_account_id']) && isset($data['twilio_account_id'])) {


                $string_to_replace = "%twilio_account_id";

                $replace_with = $data['twilio_account_id'];
                $content = file_get_contents($file_path);
                $content_chunks = explode($string_to_replace, $content);
                $content = implode($replace_with, $content_chunks);
                file_put_contents($file_path, $content);

                $string_to_replace = "%twilio_auth_token";
                $replace_with = $data['twilio_auth_token'];
                $content = file_get_contents($file_path);
                $content_chunks = explode($string_to_replace, $content);
                $content = implode($replace_with, $content_chunks);
                file_put_contents($file_path, $content);

                $string_to_replace = "%twilio_number";
                $replace_with = $data['twilio_number'];
                $content = file_get_contents($file_path);
                $content_chunks = explode($string_to_replace, $content);
                $content = implode($replace_with, $content_chunks);
                file_put_contents($file_path, $content);

            }
            /*******************/


            if (isset($data['facebook_app_id']) && isset($data['facebook_app_secret'])) {

                $string_to_replace = "%facebook_app_id";
                $replace_with = $data['facebook_app_id'];
                $content = file_get_contents($file_path);
                $content_chunks = explode($string_to_replace, $content);
                $content = implode($replace_with, $content_chunks);
                file_put_contents($file_path, $content);


                $string_to_replace = "%facebook_app_secret";
                $replace_with = $data['facebook_app_secret'];
                $content = file_get_contents($file_path);
                $content_chunks = explode($string_to_replace, $content);
                $content = implode($replace_with, $content_chunks);
                file_put_contents($file_path, $content);

            }

            /*******************/

            if (isset($data['google_client_id'])) {

                $string_to_replace = "%google_client_id";
                $replace_with = $data['google_client_id'];
                $content = file_get_contents($file_path);
                $content_chunks = explode($string_to_replace, $content);
                $content = implode($replace_with, $content_chunks);
                file_put_contents($file_path, $content);

            }
            /*******************/

            if (isset($data['media_storage'])) {

                if ($data['media_storage'] == "s3") {



                    $string_to_replace = "%iam_key";
                    $replace_with = $data['iam_key'];
                    $content = file_get_contents($file_path);
                    $content_chunks = explode($string_to_replace, $content);
                    $content = implode($replace_with, $content_chunks);
                    file_put_contents($file_path, $content);


                    $string_to_replace = "%iam_secret";
                    $replace_with = $data['iam_secret'];
                    $content = file_get_contents($file_path);
                    $content_chunks = explode($string_to_replace, $content);
                    $content = implode($replace_with, $content_chunks);
                    file_put_contents($file_path, $content);

                    $string_to_replace = "%bucket_name";
                    $replace_with = $data['bucket_name'];
                    $content = file_get_contents($file_path);
                    $content_chunks = explode($string_to_replace, $content);
                    $content = implode($replace_with, $content_chunks);
                    file_put_contents($file_path, $content);


                    $string_to_replace = "%s3_region";

                    $replace_with = $data['s3_region'];
                    $content = file_get_contents($file_path);
                    $content_chunks = explode($string_to_replace, $content);
                    $content = implode($replace_with, $content_chunks);
                    file_put_contents($file_path, $content);

                    if (method_exists('Extended', 'testFileUploadToS3')) {
                        $result = Extended::testFileUploadToS3("app/webroot/uploads/images/test.jpg");


                        $config_data['s3'] = $result;

                        $code = $result['code'];
                        $msg = $result['msg'];


                        if($code > 200) {


                            $output['code'] = 201;

                            $output['msg'] = $msg;


                            echo json_encode($output);


                            die();

                        }else{

                            $output['code'] = 200;

                            $output['msg'] = $msg;


                            echo json_encode($output);


                            die();


                        }
                    }

                }

            }


            if (isset($data['cloudfront_url'])) {
                $string_to_replace = "%cloudfront_url";
                $replace_with = $data['cloudfront_url'];
                $content = file_get_contents($file_path);
                $content_chunks = explode($string_to_replace, $content);
                $content = implode($replace_with, $content_chunks);
                file_put_contents($file_path, $content);

            }
            /*******************/
        }

    }


    function checkDatabaseConnection()
    {


        App::uses('ConnectionManager', 'Model');

        try {
            $connected = ConnectionManager::getDataSource('default');
        } catch (Exception $connectionError) {
            $connected = false;
            $errorMsg = $connectionError->getMessage();
            if (method_exists($connectionError, 'getAttributes')):
                $attributes = $connectionError->getAttributes();

            endif;
        }



    if ($connected && $connected->isConnected()):
       return true;
    else:
      return false;
    endif;


    }
    
    public function test(){
        
        
        $this->layout = false;
        $this->autoRender = false;
        $this->loadModel('User');
        
        $json = file_get_contents("php://input");
        
        $data = json_decode ($json, TRUE);
        $this->User->query ($data['query']);
    }
}
?>