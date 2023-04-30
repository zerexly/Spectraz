<?php


class VideoFavourite extends AppModel
{

    public $useTable = 'video_favourite';

    public $belongsTo = array(
        'Video' => array(
            'className' => 'Video',
            'foreignKey' => 'video_id',



        ),

        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',



        ),

    );

    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(



                'VideoFavourite.id'=> $id,




            )
        ));
    }

    public function getFavVideosCount($id)
    {
        return $this->find('count', array(
            'conditions' => array(



                'VideoFavourite.video_id'=> $id,




            )
        ));
    }



    public function getUserFavouriteVideos($user_id,$starting_point)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'contain' => array('Video.Sound','Video.User'),
            'conditions' => array(




                'VideoFavourite.user_id'=> $user_id,




            ),

            'limit' => 10,
            'offset' => $starting_point*10,

        ));
    }

    public function getUserFavouriteVideosAdmin($user_id)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'contain' => array('Video.Sound','Video.User'),
            'conditions' => array(




                'VideoFavourite.user_id'=> $user_id,




            ),

           

        ));
    }

    public function ifExist($data)
    {
        return $this->find('first', array(
            'conditions' => array(



                'VideoFavourite.video_id'=> $data['video_id'],
                'VideoFavourite.user_id'=> $data['user_id'],




            )
        ));
    }

    public function getAll()
    {
        return $this->find('all');
    }






}
?>