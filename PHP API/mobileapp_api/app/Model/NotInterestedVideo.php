<?php



class NotInterestedVideo extends AppModel
{
    public $useTable = 'not_interested_video';

    public $belongsTo = array(

        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',


        ),

        'Video' => array(
            'className' => 'Video',
            'foreignKey' => 'video_id',


        ),

    );

    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'NotInterestedVideo.id' => $id





            )
        ));
    }


    public function checkDuplicate($user_id,$video_id)
    {
        return $this->find('count', array(
            'conditions' => array(

                'NotInterestedVideo.video_id' => $video_id,
                'NotInterestedVideo.user_id' => $user_id





            )
        ));

    }







}