<?php


class Video extends AppModel
{

    public $useTable = 'video';

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',



        ),

        'Sound' => array(
            'className' => 'Sound',
            'foreignKey' => 'sound_id',



        ),

        'PinComment' => array(
            'className' => 'VideoComment',
            'foreignKey' => 'pin_comment_id',



        ),


    );

    public $hasMany = array(
        'VideoComment' => array(
            'className' => 'VideoComment',
            'foreignKey' => 'video_id',
            'dependent' =>true



        ),

        'VideoFavourite' => array(
            'className' => 'VideoFavourite',
            'foreignKey' => 'video_id',
            'dependent' =>true



        ),

        'VideoLike' => array(
            'className' => 'VideoLike',
            'foreignKey' => 'video_id',
            'dependent' =>true



        ),

        'VideoWatch' => array(
            'className' => 'VideoWatch',
            'foreignKey' => 'video_id',
            'dependent' =>true



        ),


    );



    public function getDetails($id)
    {

        $this->Behaviors->attach('Containable');
        return $this->find('first', array(
            'conditions' => array(



                'Video.id'=> $id,




            ),

            'contain' => array('User.PrivacySetting','User.PushNotification','Sound','VideoComment.User'),
        ));
    }


    public function getUserStory($user_id,$date)
    {

        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(



                'Video.user_id'=> $user_id,
                'Video.created >='=> $date,
                'Video.story'=> 1,




            ),

            'contain' => array('Sound'),
        ));
    }


    public function getUserVideosIDs($user_id)
    {


        return $this->find('all', array(
            'conditions' => array(



                'Video.user_id'=> $user_id,
                'Video.repost_user_id'=> 0,




            ),
            'fields'=>array('Video.id'),

            'recursive'=>-1
        ));
    }

    public function getDetailsAgainstOldVideoID($old_video_id)
    {


        return $this->find('first', array(
            'conditions' => array(



                'Video.old_video_id'=> $old_video_id,




            ),

            'recursive'=>-1
        ));
    }
    public function ifUserRepostedVideo($user_id,$video_id)
    {



        //$this->Behaviors->attach('Containable');
        return $this->find('first', array(
            'conditions' => array(



                'Video.repost_user_id'=> $user_id,
                'Video.repost_video_id'=> $video_id,




            ),

            'recursive' => -1
        ));
    }
    public function getOnlyVideoDetails($video_id)
    {

        $this->Behaviors->attach('Containable');
        return $this->find('first', array(
            'conditions' => array(



                'Video.id'=> $video_id,





            ),
            'contain' => array('User'),
            'recursive'=>-1
        ));
    }

    public function getSearchResults($keyword,$starting_point,$user_id){


        $this->Behaviors->attach('Containable');
        return $this->find('all', array(

            'conditions' => array(

                'Video.description Like' => "$keyword%",
                'Video.user_id !=' => $user_id,
                'Video.repost_user_id'=> 0,


            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),

            'limit'=>10,
            'offset' => $starting_point*10,





            'recursive' => 0


        ));

    }

    public function checkDuplicate($data){


        $this->Behaviors->attach('Containable');
        return $this->find('all', array(

            'conditions' => array(

                'Video.description' => $data['description'],
                'Video.user_id=' => $data['user_id'],
                'Video.video' => $data['video'],
                'Video.thum' => $data['thum'],
                'Video.gif' => $data['gif'],
                'Video.repost_user_id'=> 0,



            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),

            'limit'=>10,






            'recursive' => 0


        ));

    }

    public function getUserRecentVideos($user_id,$start_datetime,$end_datetime)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(



                'Video.user_id'=> $user_id,
                'Video.privacy_type'=> "public",
                'Video.repost_user_id'=> 0,
                'Video.story'=> 0,
                'Video.created >='=> $start_datetime,
                'Video.created <='=> $end_datetime,





            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),
            'limit' => 7,

            'order' => 'Video.id DESC'


        ));
    }

    public function getUserTrendingVideos($user_id,$start_datetime,$end_datetime)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(



                'Video.user_id'=> $user_id,
                'Video.privacy_type'=> "public",
                'Video.repost_user_id'=> 0,
                'Video.story'=> 0,
                'Video.created >='=> $start_datetime,
                'Video.created <='=> $end_datetime,





            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),
            'limit' => 9,

            'order' => 'Video.view DESC'


        ));
    }
    public function getUserPublicVideos($user_id,$starting_point)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(



                'Video.user_id'=> $user_id,
                'Video.privacy_type'=> "public",
                'Video.repost_user_id'=> 0,
                'Video.story'=> 0,





            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),
            'limit' => APP_RECORDS_PER_PAGE,
            'offset' => $starting_point*APP_RECORDS_PER_PAGE,
            'order' => 'Video.id DESC'


        ));
    }

    public function getUserPublicVideosAdmin($user_id)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(



                'Video.user_id'=> $user_id,
                'Video.privacy_type'=> array("public","Public"),
                'Video.repost_user_id'=> 0,
                'Video.story'=> 0,




            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),
            'order' => 'Video.id DESC'


        ));
    }

    public function getUserPrivateVideosAdmin($user_id)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(



                'Video.user_id'=> $user_id,
                'Video.privacy_type'=> "private",
                'Video.repost_user_id'=> 0,




            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),


            'order' => 'Video.id DESC'


        ));
    }

    public function getUserVideos($user_id)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(



                'Video.user_id'=> $user_id,
                'Video.repost_user_id'=> 0,




            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),
            'order' => 'Video.id DESC'


        ));
    }



    public function getAllVideos($starting_point)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(


            'order' => 'Video.id DESC',
            'contain' => array('User','Sound'),
            'limit'=>ADMIN_RECORDS_PER_PAGE,
            'offset' => $starting_point*ADMIN_RECORDS_PER_PAGE,

        ));
    }

    public function getAllUserVideos($user_id)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(



                'Video.user_id'=> $user_id,
            ),

            'order' => 'Video.id DESC',

            'recursive'=>-1


        ));
    }

    public function getUserPrivateVideos($user_id,$starting_point)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(



                'Video.user_id'=> $user_id,
                'Video.privacy_type'=> "private",
                'Video.repost_user_id'=> 0,




            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),
            'limit' => APP_RECORDS_PER_PAGE,
            'offset' => $starting_point*APP_RECORDS_PER_PAGE,
            'order' => 'Video.id DESC'


        ));
    }

    public function getUserVideosCount($user_id)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('count', array(
            'conditions' => array(



                'Video.user_id'=> $user_id,
                'Video.repost_user_id'=> 0,




            ),






        ));
    }


    public function getVideosCountAgainstSound($sound_id)
    {

        return $this->find('count', array(
            'conditions' => array(



                'Video.sound_id'=> $sound_id,





            ),






        ));
    }


    public function getFrequentlyUsedSounds()
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(

            'conditions' => array(

                'Video.privacy_type'=> 'public',
                'Video.repost_user_id'=> 0,
            ),
            'fields' => array( 'DISTINCT Video.sound_id','COUNT(*) count'),

            'group' => array('Video.sound_id'),
            'order' => 'COUNT(*) DESC',




        ));
    }

    public function getVideosAgainstSoundID($user_id,$device_id,$starting_id,$sound_id)
    {
        $this->Behaviors->attach('Containable');



        return $this->find('all', array(
            // 'fields' => array('id'),
            'conditions' => array(

                'Video.sound_id'=> $sound_id,
                'Video.repost_user_id'=> 0,
                'Video.privacy_type'=> 'public'
            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),
            'limit' => APP_RECORDS_PER_PAGE,
            'offset' => $starting_id*APP_RECORDS_PER_PAGE,
            'order' => 'Video.view DESC'
        ));

    }


    public function getVideosAgainstSoundIDWeb($user_id,$device_id,$starting_id,$sound_id)
    {
        $this->Behaviors->attach('Containable');



        return $this->find('all', array(
            // 'fields' => array('id'),
            'conditions' => array(

                'Video.sound_id'=> $sound_id,
                'Video.repost_user_id'=> 0,
                'Video.privacy_type'=> 'public'
            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),

            'order' => 'Video.view DESC'
        ));

    }

    public function getPromotedVideo()
    {
        $this->Behaviors->attach('Containable');



        return $this->find('first', array(
            // 'fields' => array('id'),
            'conditions' => array(

                'Video.promote'=> 1,
                'Video.repost_user_id'=> 0,

            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),

            'order' => 'rand()'
        ));

    }


    public function getRelatedVideosNotWatched($user_id,$device_id,$starting_id)
    {
        $this->Behaviors->attach('Containable');



        return $this->find('all', array(
            // 'fields' => array('id'),
            'conditions' => array('not exists '.
                '(SELECT id FROM video_watch as VideoWatch WHERE Video.id = VideoWatch.video_id AND VideoWatch.device_id ='.$device_id.'',
                '(SELECT id FROM block_user as BlockUser WHERE Video.user_id = BlockUser.block_user_id AND BlockUser.user_id ='.$user_id.' limit 1))',

                //'Video.user_id !='=> $user_id,
                'Video.block'=> 0,
                'Video.repost_user_id'=> 0,
                'Video.story'=> 0,
                'Video.privacy_type'=> 'public'
            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound','PinComment'),
            'limit' => 10,
            'offset' => $starting_id*10,
            'order' => 'rand()'
            //'order' => 'Video.view DESC'
        ));

    }

    public function getRelatedVideosDemo($user_id,$device_id,$starting_id)
    {
        $this->Behaviors->attach('Containable');



        return $this->find('all', array(
            // 'fields' => array('id'),
            'conditions' => array(
                //'Video.user_id !='=> $user_id,
                'Video.block'=> 0,
                'Video.repost_user_id'=> 0,
                'Video.story'=> 0,
                //'Video.user_id'=> 1,
                'Video.privacy_type'=> 'public'
            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound','PinComment'),
            'limit' => 10,
            'offset' => $starting_id*10,
            'order' => 'Video.viral DESC'
            //'order' => 'Video.view DESC'
        ));

    }

    public function getRelatedVideosNotWatchedDemo($user_id,$device_id,$starting_id)
    {
        $this->Behaviors->attach('Containable');



        return $this->find('all', array(
            // 'fields' => array('id'),
            'conditions' => array(
                'Video.user_id !='=> $user_id,
                'Video.repost_user_id'=> 0,
                'Video.story'=> 0,
                'Video.block'=> 0,
                'Video.privacy_type'=> 'public'
            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),
            'limit' => 5,


            //'order' => 'Video.view DESC'
        ));

    }




    public function getRelatedVideosWatched($user_id,$device_id,$starting_id)
    {
        $this->Behaviors->attach('Containable');



        return $this->find('all', array(
            // 'fields' => array('id'),
            'conditions' => array(
                // 'Video.user_id !='=> $user_id,
                'Video.block'=> 0,
                'Video.repost_user_id'=> 0,
                'Video.story'=> 0,
                'Video.privacy_type'=> 'public'
            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),
            'limit' => 10,
            'offset' => $starting_id*10,

            'order' => 'rand()'
            //'order' => 'Video.view DESC'
        ));

    }

    public function getFollowingVideosNotWatched($user_id,$device_id,$starting_id,$ids)
    {
        $this->Behaviors->attach('Containable');



        return $this->find('all', array(
            // 'fields' => array('id'),
            'conditions' => array(
                // '(SELECT id FROM follower as Follower WHERE Video.user_id = Follower.receiver_id AND Follower.sender_id ='.$user_id.' LIMIT 1)',
                //'(SELECT id FROM video_watch as VideoWatch WHERE Video.id = VideoWatch.video_id AND VideoWatch.device_id ='.$device_id.' LIMIT 1)',


                'Video.privacy_type'=> 'public',
                'Video.repost_user_id'=> 0,
                'Video.story'=> 0,
                'Video.block'=> 0,
                'Video.user_id IN'=> $ids
            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),
            'limit' => 10,
            'offset' => $starting_id*10,

            'order' => 'rand()'
            //'order' => 'Video.view DESC'
        ));

    }


    public function getFollowingVideosWatched($user_id,$device_id,$starting_id,$ids)
    {
        $this->Behaviors->attach('Containable');



        return $this->find('all', array(
            // 'fields' => array('id'),
            'conditions' => array('exists '.
                '(SELECT id FROM follower as Follower WHERE Video.user_id = Follower.receiver_id AND Follower.sender_id ='.$user_id.')',


                'Video.block'=> 0,
                'Video.story'=> 0,
                'Video.repost_user_id'=> 0,
                'Video.user_id IN'=> $ids,

                'Video.privacy_type'=> 'public'
            ),
            'contain' => array('User.PrivacySetting','User.PushNotification','Sound'),
            'limit' => 10,
            'offset' => $starting_id*10,

            'order' => 'rand()'
            //'order' => 'Video.view DESC'
        ));

    }

    public function getAllVideosAgainstSoundID($sound_id)
    {




        return $this->find('all', array(

            'conditions' => array(


                'Video.sound_id'=> $sound_id,
                'Video.repost_user_id'=> 0,
                'Video.story'=> 0,

            ),
            'recursive' => -1,


        ));

    }

    public function updateSoundIDs($ids){


        $this->updateAll(
            array('sound_id' => 0),
            array('Video.sound_id IN' => $ids)
        );
    }







}
?>