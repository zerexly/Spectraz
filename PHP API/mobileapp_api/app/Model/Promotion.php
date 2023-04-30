<?php


//App::uses('VideoWatch', 'Model');

class Promotion extends AppModel
{
    public $useTable = 'promotion';
    public $virtualFields = array(
        'video_id' => 'Promotion.video_id'
    );
    public $belongsTo = array(

        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',


        ),

        'Video' => array(
            'className' => 'Video',
            'foreignKey' => 'video_id',


        ),


        'Audience' => array(
            'className' => 'Audience',
            'foreignKey' => 'audience_id',


        ),



    );

    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'Promotion.id' => $id





            )
        ));
    }



    public function getUserPromotions($user_id,$start_datetime,$end_datetime,$starting_point)
    {
        return $this->find('all', array(
            'conditions' => array(

                'Promotion.user_id' => $user_id,
                'DATE(Promotion.created) >='=> $start_datetime,
                'DATE(Promotion.created) <='=> $end_datetime,





            ),
            'limit'=>10,
            'offset' => $starting_point*10,

            'order' => 'Promotion.id DESC'
        ));
    }

    public function getAll()
    {
        return $this->find('all', array(


            'order' => 'Promotion.id DESC'
        ));
    }

    public function getUserActivePromotions($user_id,$datetime)
    {
        return $this->find('all', array(
            'conditions' => array(

                'Promotion.user_id' => $user_id,
                'Promotion.end_datetime >=' => $datetime,
                'Promotion.active'=>1





            )
        ));
    }

    public function getActivePromotionAudience($id,$datetime)
    {
        return $this->find('first', array(
            'conditions' => array(

                'Promotion.audience_id' => $id,
                'Promotion.end_datetime >=' => $datetime





            )
        ));
    }

    public function getUserCompletedPromotions($user_id,$datetime)
    {
        return $this->find('all', array(
            'conditions' => array(

                'Promotion.user_id' => $user_id,
                'Promotion.end_datetime <=' => $datetime,
                'Promotion.active'=>1





            )
        ));
    }
    public function getNonActivePromotions($user_id)
    {
        return $this->find('all', array(
            'conditions' => array(

                'Promotion.user_id' => $user_id,
                'Promotion.active' => array(0, 2)





            )
        ));
    }

    public function getVideoPromotions($video_id)
    {
        return $this->find('all', array(
            'conditions' => array(

                'Promotion.video_id' => $video_id





            )
        ));
    }

    public function getVideoPromotionDetail($video_id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'Promotion.video_id' => $video_id,
                'Promotion.reach < Promotion.price',






            )
        ));
    }

    public function getActivePromotionAgainstPromotionID($promotion_id,$datetime)
    {
        return $this->find('first', array(
            'conditions' => array(

                'Promotion.id' => $promotion_id,
                'Promotion.start_datetime >=' => $datetime,
                'Promotion.end_datetime <=' => $datetime,
                'Promotion.active' => 1




            )
        ));
    }

    public function getActivePromotionAgainstVideoID($video_id,$datetime)
    {
        return $this->find('first', array(
            'conditions' => array(

                'Promotion.video_id' => $video_id,
                'Promotion.start_datetime >=' => $datetime,
                'Promotion.end_datetime <=' => $datetime,
                'Promotion.active' => 1





            )
        ));
    }

    public function getPromotionalVideo($user_id,$dob,$gender){
        $this->Behaviors->attach('Containable');
        $min_age = date_diff(date_create($dob), date_create('now'))->y;
        $max_age = $min_age + 10;

        $join_condition = array(
            array(
                'table' => 'video_watch',
                'alias' => 'VideoWatch',
                'type' => 'LEFT',
                'conditions' => array(
                    'VideoWatch.video_id = Promotion.video_id',
                    'VideoWatch.user_id = ' . $user_id
                )
            )
        );
       $conditions = array(
          'Promotion.start_datetime <=' => date('Y-m-d H:i:s'),
          'Promotion.end_datetime >=' => date('Y-m-d H:i:s'),
          'Audience.min_age <= ' => $max_age,
          'Audience.max_age >= ' => $min_age,
           'Promotion.user_id !='=> $user_id,

           'Promotion.reach < Promotion.total_reach',
           //'VideoWatch.user_id IS NULL'

      );

        $gender_conditions = array(
            'OR' => array(
                array('Audience.gender' => $gender),
                array('Audience.gender' => 'all')
            )
        );

        $conditions = array_merge($conditions, $gender_conditions);

        return $this->find('first', array(
            'joins' => $join_condition,
            'conditions' => $conditions,
            'contain' => array('Video.User.PrivacySetting','Audience','Video.User.PushNotification','Video.Sound','Video.PinComment','Video.VideoComment.User'),

            'order' => 'rand()'

        ));
    }



    public function getPromotedVideo($user_id,$datetime)
    {
        $this->Behaviors->attach('Containable');




        return $this->find('first', array(
            // 'fields' => array('id'),
            'conditions' => array(

                'Promotion.user_id !='=> $user_id,

                'Promotion.reach < Promotion.total_reach',

                'Promotion.start_datetime <=' => $datetime,
                'Promotion.end_datetime >=' => $datetime


            ),
            'contain' => array('Video.User.PrivacySetting','Video.User.PushNotification','Video.Sound','Video.VideoComment.User'),



        ));

    }


    public function countPromotionCoin($user_id,$datetime)
    {
        return $this->find('first', array(
            'conditions' => array(



                'Promotion.user_id'=> $user_id,
                'Promotion.created >'=> $datetime,




            ),

            'fields'=>array('SUM(Promotion.coin) as total_amount' )
        ));
    }


    public function getPromotionsBasedOnStatus($date,$active)
    {
        return $this->find('all', array(
            'conditions' => array(

                'Promotion.active' => $active,
                'Promotion.end_datetime >=' => $date





            ),
            'order' => 'Promotion.id ASC'
        ));
    }









}