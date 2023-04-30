<?php



class Playlist extends AppModel
{

    public $useTable = 'playlist';



    public $hasMany = array(

        'PlaylistVideo' => array(
            'className' => 'PlaylistVideo',
            'foreignKey' => 'playlist_id',
            'dependent'=>true



        ),
    );


    public function getImages()
    {
        return $this->find('all');


    }


    public function getDetails($id)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('first', array(


            // 'contain' => array('OrderMenuItem', 'Restaurant', 'OrderMenuItem.OrderMenuExtraItem', 'PaymentMethod', 'Address','UserInfo','RiderOrder.Rider'),

            'conditions' => array(



                'Playlist.id' => $id


            ),
            'contain'=>array('PlaylistVideo.Video.User.PushNotification','PlaylistVideo.Video.User.PrivacySetting','PlaylistVideo.Video.Sound'),
        ));


    }


    public function getUserPlaylist($user_id)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(


            // 'contain' => array('OrderMenuItem', 'Restaurant', 'OrderMenuItem.OrderMenuExtraItem', 'PaymentMethod', 'Address','UserInfo','RiderOrder.Rider'),

            'conditions' => array(



                'Playlist.user_id' => $user_id


            ),
            'contain'=>array('PlaylistVideo.Video.User.PushNotification','PlaylistVideo.Video.User.PrivacySetting','PlaylistVideo.Video.Sound'),
        ));


    }

    public function ifExist($name)
    {
        return $this->find('first', array(


            // 'contain' => array('OrderMenuItem', 'Restaurant', 'OrderMenuItem.OrderMenuExtraItem', 'PaymentMethod', 'Address','UserInfo','RiderOrder.Rider'),

            'conditions' => array(



                'Playlist.name' => $name


            ),
        ));


    }

    public function getAll()
    {
        return $this->find('all');


    }

    public function getAppSlidersCount()
    {
        return $this->find('count');
    }

    public function deletePlaylist($id)
    {
        return $this->deleteAll(
            [
                'Playlist.id' => $id

            ],
            false # <- single delete statement please
        );
    }
}

?>