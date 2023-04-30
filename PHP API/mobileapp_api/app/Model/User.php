<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('Security', 'Utility');



class User extends AppModel
{
    public $useTable = 'user';


  

    public $hasMany = array(
        'Video' => array(
            'className' => 'Video',
            'foreignKey' => 'user_id',
            'dependent' =>true


        ),

        'Notification' => array(
            'className' => 'Notification',
            'foreignKey' => 'receiver_id',
            'dependent' =>true


        ),

        'VideoLike' => array(
            'className' => 'VideoLike',
            'foreignKey' => 'user_id',
            'dependent' =>true




        ),

      
        'VideoComment' => array(
            'className' => 'VideoComment',
            'foreignKey' => 'user_id',
            'dependent' =>true




        ),

        'VideoCommentLike' => array(
            'className' => 'VideoCommentLike',
            'foreignKey' => 'user_id',
            'dependent' =>true




        ),

        'VideoCommentReply' => array(
            'className' => 'VideoCommentReply',
            'foreignKey' => 'user_id',
            'dependent' =>true




        ),

        'VideoCommentReplyLike' => array(
            'className' => 'VideoCommentReplyLike',
            'foreignKey' => 'user_id',
            'dependent' =>true




        ),

        'VideoFavourite' => array(
            'className' => 'VideoFavourite',
            'foreignKey' => 'user_id',
            'dependent' =>true




        ),

        'Follower' => array(
            'className' => 'Follower',
            'foreignKey' => 'receiver_id',
            'dependent' =>true




        ),

        'Playlist' => array(
            'className' => 'Playlist',
            'foreignKey' => 'user_id',
            'dependent' =>true


        ),




    );

    public $hasOne = array(
        'PushNotification' => array(
            'className' => 'PushNotification',
            'foreignKey' => 'id',
            'dependent' =>true


        ),

        'PrivacySetting' => array(
            'className' => 'PrivacySetting',
            'foreignKey' => 'id',
            'dependent' =>true


        ),

    );




   

    public function isEmailAlreadyExist($email){ 

        return $this->find('count', array(
            'conditions' => array(
                'User.email' => $email)
        ));

    }

    public function getUsersWhoHasProfilePic($starting_point){

        return $this->find('all', array(
            'conditions' => array(
                'User.profile_pic !=' => "",
                'User.id ' => 3,


            ),

            'limit'=>5,
            'recursive'=>-1
            //'offset' => $starting_point*ADMIN_RECORDS_PER_PAGE,
        ));

    }

    public function isfbAlreadyExist($fb_id){ 

        return $this->find('count', array(
            'conditions' => array('fb_id' => $fb_id)
        ));

    }

    public function getDetailsAgainstFBID($fb_id){ 

        return $this->find('first', array(
            'conditions' => array('fb_id' => $fb_id)
        ));

    }

    public function getAllFacebookUsers($fb_ids,$user_id){ 

        return $this->find('all', array(
            'conditions' => array(
                'User.social_id IN' => $fb_ids,
                'User.social' => "facebook",
                'User.id !='=>$user_id
                
                )
        ));

    }

    public function isSocialIDAlreadyExist($social_id){ 

        return $this->find('first', array(
            'conditions' => array(
                'User.social_id' => $social_id,

            )
        ));

    }

    public function verifyToken($code,$email){

        return $this->find('count', array(
            'conditions' => array(

                'email' => $email,
                'token'=>$code

            )
        ));

    }
    public function getUserDetailsAgainstEmail($email){

        return $this->find('first', array(
            'conditions' => array('email' => $email)
        ));

    }

    public function getUserDetailsAgainstUsername($username){

        return $this->find('first', array(
            'conditions' => array('username' => $username)
        ));

    }

    public function isUsernameAlreadyExist($username){ 

        return $this->find('count', array(
            'conditions' => array('username' => $username)
        ));

    }
    public function getRecommendedRandomUsers(){

        return $this->find('all', array(
            'conditions' => array(
                'User.first_name !='=>"",
                'User.last_name !='=>"",
                'User.last_name !='=>"",
                'User.profile_pic !='=>"",



            ),
            'order' => 'rand()',
            'limit' => 10,
        ));

    }

    public function getRecommendedUsers($user_id,$followers,$starting_point){

        return $this->find('all', array(
            'conditions' => array(

                'User.id !='=>$user_id,
                'User.first_name !='=>"",
                'User.last_name !='=>"",
                'User.profile_pic !='=>"",
                "NOT" => array( "User.id" => $followers )



            ),
            'order' => 'rand()',
            'limit' => 10,
            'offset' => $starting_point*10,
        ));

    }

    public function isphoneNoAlreadyExist($phone){ 

        return $this->find('first', array(
            'conditions' => array('phone' => $phone)
        ));

    }



    public function editIsEmailAlreadyExist($email,$user_id){ 

        return $this->find('count', array(
            'conditions' => array(
                'User.email' => $email,
                'User.id !='=>$user_id
            )
        ));

    }



    public function editIsUsernameAlreadyExist($username,$user_id){ 

        return $this->find('count', array(
            'conditions' => array(
                'User.username' => $username,
                'User.id !='=>$user_id



                )
        ));

    }

    public function editIsphoneNoAlreadyExist($phone,$user_id){ 

        return $this->find('count', array(
            'conditions' => array(
                'User.phone' => $phone,
                'User.id !='=>$user_id



            )
        ));

    }


    public function iSUserExist($id){

        return $this->find('count', array(
            'conditions' => array('id' => $id)
        ));

    }


    public function getMultipleUsersData($users){





        return $this->find('all', array(
            'conditions' => array('User.id IN' => $users),
            'recursive'=> -1
        ));



    }

    public function getUsersCount($role){

        return $this->find('count', array(
            'conditions' => array(

                'User.role' => $role)
        ));

    }

    public function getTotalUsersCount(){

        return $this->find('count');

    }

    public function getUserDetailsFromID($user_id){
        $this->Behaviors->attach('Containable');
        return $this->find('first', array(
            'conditions' => array(
                'User.id' => $user_id,
                'User.active' => 1,

            ),
            'contain' => array('PushNotification','PrivacySetting','Playlist.PlaylistVideo.Video'),
            'recursive' => 0


        ));

    }


    public function getUserDetailsFromIDContain($user_id){
        $this->Behaviors->attach('Containable');
        return $this->find('first', array(
            'conditions' => array(
                'User.id' => $user_id
            ),
            'contain' => array('PushNotification','PrivacySetting','Video','Notification','Playlist.PlaylistVideo.Video','VideoLike.Video.Sound','VideoLike.Video.User'),
            'recursive' => 0


        ));

    }
    public function getOnlyUserDetailsFromID($user_id){
       
        return $this->find('first', array(
            'conditions' => array(
                'User.id' => $user_id,
                'User.active' => 1,

            ),
            //'contain' => array('PushNotification','PrivacySetting','Playlist.PlaylistVideo.Video'),
            'recursive' => -1


        ));

    }
    public function getUserDetailsFromUsername($username){

        return $this->find('first', array(
            'conditions' => array(
                'User.username' => $username
            ),

            'recursive' => 0


        ));

    }

    public function getUserDetailsFromIDAndRole($user_id,$role){

        return $this->find('first', array(
            'conditions' => array(
                'User.id' => $user_id,
                'User.role' => $role
            ),

            'recursive' => 0


        ));

    }

    public function getDriverDetails($user_id,$role){

        $this->Behaviors->attach('Containable');
        return $this->find('first', array(
            'conditions' => array(
                'User.id' => $user_id,
                'User.role' => $role
            ),
            'contain'=>array('Vehicle.RideType','DriverDocument'),

            'recursive' => 0


        ));

    }

    public function getSearchResults($keyword,$starting_point,$user_id){



        return $this->find('all', array(

            'conditions' => array(


                'OR' => array(
                    array('User.username Like' => "$keyword%"),
                    array('User.first_name Like' => "$keyword%"),
                    array('User.last_name Like' => "$keyword%"),
                ),

                'User.id !=' => $user_id,
                'User.id >=' => $starting_point,

            ),

            'limit'=>10,
            'offset' => $starting_point*10,






            'recursive' => 0


        ));

    }

    public function verifyPassword($email,$old_password){


        $userData = $this->findByEmail($email, array(
            'id',
            'password',



        ));



        $passwordHash = Security::hash($old_password, 'blowfish', $userData['User']['password']);
       // $salt = Security::hash($old_password, 'sha256', true);

        if ($passwordHash == $userData['User']['password']) {


            return true;

        }else{
            return false;


        }



    }



    function updatepassword($password)
    {
        $passwordBlowfishHasher = new BlowfishPasswordHasher();
        $user['password'] = $passwordBlowfishHasher->hash($password);

        return $user;
    }


    public function getEmailBasedOnUserID($user_id){

        return $this->find('all', array(
            'conditions' => array(
                'User.id' => $user_id

            )
        ));


    }

    public function getAllUsers($starting_point){

        return $this->find('all', array(
            'conditions' => array(
                'User.role !=' => "admin",


            ),
            'limit'=>20,
            'offset' => $starting_point*20,
            'order' => 'User.id DESC',
        ));


    }



    public function getAllUsersNotification(){

        return $this->find('all', array(

            'order' => 'User.id DESC',
            'recusive'=>-1
        ));


    }

    public function getAllUsersAgainstUserIDs($user_ids){

        return $this->find('all', array(
            'conditions' => array(
                'User.id' => $user_ids

            )
        ));


    }


    public function getDistinctCountries(){

        return $this->find('all', array(

            'conditions' => array('User.country !=' => ""),
            'fields' => array( 'DISTINCT User.country'),

            'group' => array('User.country'),
            'recursive'=>-1
        ));


    }

    public function searchLocation($keyword){



        return $this->query("SELECT DISTINCT User.country,User.city,User.region  
          FROM user as User 
        WHERE User.country Like '$keyword%'  OR User.city Like '$keyword%' OR User.region Like '$keyword%'");
    }
    public function searchLocation2($keyword){

        return $this->find('all', array(

            'conditions' => array(

                'OR' => array(
                    array('User.country Like' => "$keyword%"),
                    array('User.city Like' => "$keyword%"),
                    array('User.region Like' => "$keyword%"),
                ),


                'User.country !=' => ""


            ),
            'fields' => array( 'DISTINCT User.country', 'DISTINCT User.city'),

            //'group' => array('User.country'),
            'recursive'=>-1
        ));


    }

    /*
     *
     *   public function totalAudienceAgainstGenderAndCountry($min_age,$max_age,$gender,$country_id){

        return $this->query("SELECT count(*) as total_audience
FROM user as User
WHERE gender = '$gender' AND
 (User.country_id IN($location_name) OR User.city IN($location_name) OR User.region IN($location_name))
 AND TIMESTAMPDIFF(YEAR,`dob`,NOW()) BETWEEN  $min_age AND $max_age" );



    }*/
    public function totalAudienceAgainstGenderAndCountry($min_age,$max_age,$gender,$country_id){

        return $this->query("SELECT count(*) as total_audience
FROM user as User
WHERE gender = '$gender' AND country_id =  $country_id
 AND TIMESTAMPDIFF(YEAR,`dob`,NOW()) BETWEEN  $min_age AND $max_age" );



    }

    public function totalAudienceAgainstGenderAndCity($min_age,$max_age,$gender,$city_id){

        return $this->query("SELECT count(*) as total_audience
FROM user as User
WHERE gender = '$gender' AND User.city_id =  $city_id
 AND TIMESTAMPDIFF(YEAR,`dob`,NOW()) BETWEEN  $min_age AND $max_age" );



    }

    public function totalAudienceAgainstGenderAndState($min_age,$max_age,$gender,$state_id){

        return $this->query("SELECT count(*) as total_audience
FROM user as User
WHERE gender = '$gender' AND User.city_id =  $state_id
 AND TIMESTAMPDIFF(YEAR,`dob`,NOW()) BETWEEN  $min_age AND $max_age" );



    }

    public function totalAudienceWithoutGenderAndCountry($min_age,$max_age,$country_id){

        return $this->query("SELECT count(*) as total_audience
FROM user as User
WHERE country_id =  $country_id
 AND TIMESTAMPDIFF(YEAR,`dob`,NOW()) BETWEEN  $min_age AND $max_age" );



    }

    public function totalAudienceWithoutGenderAndCity($min_age,$max_age,$city_id){

        return $this->query("SELECT count(*) as total_audience
FROM user as User
 WHERE User.city_id =  $city_id
 AND TIMESTAMPDIFF(YEAR,`dob`,NOW()) BETWEEN  $min_age AND $max_age" );



    }

    public function totalAudienceWithoutGenderAndState($min_age,$max_age,$state_id){

        return $this->query("SELECT count(*) as total_audience
FROM user as User
WHERE User.city_id =  $state_id
 AND TIMESTAMPDIFF(YEAR,`dob`,NOW()) BETWEEN  $min_age AND $max_age" );



    }


    public function totalAudienceAgainstCountryID($country_id){

        return $this->find('count', array(

            'conditions' => array('User.country_id' => $country_id),




        ));

    }

    public function totalAudienceAgainstCityID($city_id){

        return $this->find('count', array(

            'conditions' => array('User.city_id' => $city_id),




        ));

    }

    public function totalAudienceAgainstStateID($state_id){

        return $this->find('count', array(

            'conditions' => array('User.state_id' => $state_id),




        ));

    }

    public function getAdminDetails(){

        return $this->find('all', array(
            'conditions' => array(
                'User.role' => "admin"

            ),

        ));


    }

    public function verifyCode($email,$code){

        return $this->find('count', array(
            'conditions' => array(
                'User.email' => $email,
                'User.token'=>$code

            ),

        ));


    }
    public function verify($email,$user_password,$role)
    {

        if ($email != "") {
            $userData = $this->find('all', array(
                'conditions' => array(

                    'OR' => array(
                        array('User.email' => $email),
                        array('User.username' => $email),
                    ),


                    'User.active' => 1,


                )
            ));


            /*$userData = $this->findByEmail($email, array(
            'user_id',
           'email',
            'password',
            'salt'
           ));*/
            if (empty($userData)) {


                return false;

            }
        }
        $passwordHash = Security::hash($user_password, 'blowfish', $userData[0]['User']['password']);
        $salt = Security::hash($user_password, 'sha256', true);

        if ($passwordHash == $userData[0]['User']['password'] ) {
            return $userData;
        } else {

            return false;


        }



    }

    public function verifyWithUsername($email,$user_password,$role)
    {

        if ($email != "") {
            $userData = $this->find('all', array(
                'conditions' => array(
                    'User.username' => $email,

                    'User.active' => 1,

                )
            ));


            /*$userData = $this->findByEmail($email, array(
            'user_id',
           'email',
            'password',
            'salt'
           ));*/
            if (empty($userData)) {


                return false;

            }
        }
        $passwordHash = Security::hash($user_password, 'blowfish', $userData[0]['User']['password']);
        $salt = Security::hash($user_password, 'sha256', true);

        if ($passwordHash == $userData[0]['User']['password'] ) {
            return $userData;
        } else {

            return false;


        }



    }


    public function verifyPhoneNoAndPassword($phone_no,$user_password)
    {


            $userData = $this->find('all', array(
                'conditions' => array(
                    'User.phone_no' => $phone_no

                )
            ));


            /*$userData = $this->findByEmail($email, array(
            'user_id',
           'email',
            'password',
            'salt'
           ));*/
            if (empty($userData)) {


                return false;

            }

        $passwordHash = Security::hash($user_password, 'blowfish', $userData[0]['User']['password']);
        $salt = Security::hash($user_password, 'sha256', true);

        if ($passwordHash == $userData[0]['User']['password'] ) {
            return $userData;
        } else {

            return false;


        }



    }



    public function getUsers($starting_point){


            return $this->find('all', array(


                 'limit'=>ADMIN_RECORDS_PER_PAGE,
                 'offset' => $starting_point*ADMIN_RECORDS_PER_PAGE,

                'order' => array('User.id DESC'),
            ));

    }


    public function total_count_getUsers($role){

        return $this->find('count', array(

            'conditions' => array(

                'User.role' => $role

            ),

        ));

    }


    public function getUserDetailsFromEmail($email){

        return $this->find('first', array(
            'conditions' => array(

                'User.email' => $email

            ),

        ));


    }





    public function beforeSave($options = array())
    {
        $passwordBlowfishHasher = new BlowfishPasswordHasher();


        if (isset($this->data[$this->alias]['password'])) {
            $password = $this->data[$this->alias]['password'];

            $salt = $password;

            $this->data['User']['password'] = $passwordBlowfishHasher->hash($password);
           
        }
        return true;
    }


}?>