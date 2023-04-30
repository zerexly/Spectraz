<?php


class HashtagVideo extends AppModel
{

    public $useTable = 'hashtag_video';

    public $belongsTo = array(
        'Hashtag' => array(
            'className' => 'Hashtag',
            'foreignKey' => 'hashtag_id',



        ),'Video' => array(
            'className' => 'Video',
            'foreignKey' => 'video_id',



        ),

    );



    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(



                'HashtagVideo.id'=> $id,




            )
        ));
    }

    public function getHashtagVideos($hashtag_id)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'contain' => array('Video.Sound','Video.User.PrivacySetting','Video.User.PushNotification','Video','Hashtag'),
            'conditions' => array(



                'HashtagVideo.hashtag_id'=> $hashtag_id,
                'Video.privacy_type'=> "public",




            ),
            'order' => 'Video.view DESC',
        ));
    }

    public function getHashtagVideosLimit($hashtag_id)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'contain' => array('Video.Sound','Video.User.PrivacySetting','Video.User.PushNotification','Video','Hashtag',


                'Video.VideoComment' => array(
                    'limit'=> 3,
                ),

                'Video.VideoLike' => array(
                    'limit'=> 3,
                ),'Video.VideoComment.User','Video.VideoLike.User'


            ),


            'conditions' => array(



                'HashtagVideo.hashtag_id'=> $hashtag_id,
                'Video.privacy_type'=> "public",




            ),
            'limit'=>5,
            'order' => 'Video.view DESC',
        ));
    }

    public function getHashtagVideosWithLimit($hashtag_id,$starting_point)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'contain' => array('Video.Sound','Video.User.PrivacySetting','Video.User.PushNotification','Hashtag',

                'Video.VideoComment' => array(
                    'limit'=> 3,
                ),

                'Video.VideoLike' => array(
                    'limit'=> 3,
                ),'Video.VideoComment.User','Video.VideoLike.User'


            ),
            'conditions' => array(



                'HashtagVideo.hashtag_id'=> $hashtag_id,
                'Video.privacy_type'=> "public",




            ),
            'limit' => APP_RECORDS_PER_PAGE,
            'offset' => $starting_point * APP_RECORDS_PER_PAGE,

            'order' => 'Video.view DESC',
        ));
    }

    public function countHashtagViews($hashtag_id)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('first', array(
            'contain' => array('Video.Sound','Video.User'),
            'conditions' => array(



                'HashtagVideo.hashtag_id'=> $hashtag_id,
                'Video.privacy_type'=> "public",




            ),
            'fields' => array( 'sum(Video.view) as total_sum'),
            'order' => 'Video.view DESC',
        ));
    }
    public function countHashtagVideos($hashtag_id)
    {

        return $this->find('count', array(
            //'contain' => array('Video'),
            'conditions' => array(



                'HashtagVideo.hashtag_id'=> $hashtag_id,
                'Video.privacy_type'=> "public",





            ),



        ));
    }
    public function getHastagsWhichHasGreaterNoOfVideos($starting_point)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(

            'fields' => array( 'DISTINCT HashtagVideo.hashtag_id','Hashtag.*','sum(Video.view) as total_views'),

            'group' => array('HashtagVideo.hashtag_id'),
            'order' => 'total_views DESC',
            'limit'=>10,
            'offset' => $starting_point*10


        ));
    }

    public function getHastagsWhichHasGreaterNoOfVideosAdmin()
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(

            'fields' => array( 'DISTINCT HashtagVideo.hashtag_id','Hashtag.*','sum(Video.view) as total_views'),

            'group' => array('HashtagVideo.hashtag_id'),
            'order' => 'total_views DESC',


        ));
    }

    public function ifExist($data)
    {
        return $this->find('first', array(
            'conditions' => array(



                'HashtagVideo.hashtag_id'=> $data['hashtag_id'],
                'HashtagVideo.video_id'=> $data['video_id'],




            )
        ));
    }







}
?>