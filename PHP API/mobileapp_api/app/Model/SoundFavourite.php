<?php


class SoundFavourite extends AppModel
{

    public $useTable = 'sound_favourite';

    public $belongsTo = array(
        'Sound' => array(
            'className' => 'Sound',
            'foreignKey' => 'sound_id',



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



                'SoundFavourite.id'=> $id,




            )
        ));
    }



    public function getUserFavouriteSounds($user_id,$starting_point)
    {
        return $this->find('all', array(
            'conditions' => array(




                'SoundFavourite.user_id'=> $user_id,




            ),

            'limit' => 10,
            'offset' => $starting_point*10,

        ));
    }

    public function ifExist($data)
    {
        return $this->find('first', array(
            'conditions' => array(



                'SoundFavourite.sound_id'=> $data['sound_id'],
                'SoundFavourite.user_id'=> $data['user_id'],




            )
        ));
    }
    public function searchFavouriteSound($keyword,$starting_point,$user_id)
    {
        return $this->find('all', array(
            'conditions' => array(




                'OR' => array(
                    array('Sound.name Like' => "%$keyword%"),
                    array('Sound.description Like' => "%$keyword%"),

                ),
                'Sound.publish'=> 1,
                'SoundFavourite.user_id'=> $user_id,




            ),
            'limit'=>10,
            'offset' => $starting_point*10,
        ));
    }
    public function getAll()
    {
        return $this->find('all');
    }






}
?>