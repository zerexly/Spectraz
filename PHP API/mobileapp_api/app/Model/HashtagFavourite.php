<?php


class HashtagFavourite extends AppModel
{

    public $useTable = 'hashtag_favourite';

    public $belongsTo = array(
        'Hashtag' => array(
            'className' => 'Hashtag',
            'foreignKey' => 'hashtag_id',



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



                'HashtagFavourite.id'=> $id,




            )
        ));
    }



    public function getUserFavouriteHashtags($user_id,$starting_point)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'contain' => array('Hashtag','User'),
            'conditions' => array(




                'HashtagFavourite.user_id'=> $user_id,




            ),
            'limit' => 10,
            'offset' => $starting_point*10,

        ));
    }

    public function ifExist($data)
    {
        return $this->find('first', array(
            'conditions' => array(



                'HashtagFavourite.hashtag_id'=> $data['hashtag_id'],
                'HashtagFavourite.user_id'=> $data['user_id'],




            )
        ));
    }

    public function getAll()
    {
        return $this->find('all');
    }






}
?>