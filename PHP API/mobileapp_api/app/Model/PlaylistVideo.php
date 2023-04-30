<?php



class PlaylistVideo extends AppModel
{

    public $useTable = 'playlist_video';

    public $belongsTo = array(

        'Video' => array(
            'className' => 'Video',
            'foreignKey' => 'video_id',




        ),

        'Playlist' => array(
            'className' => 'Playlist',
            'foreignKey' => 'playlist_id',




        ),
    );

    public function getImages()
    {
        return $this->find('all');


    }


    public function getDetails($id)
    {

        return $this->find('first', array(


            // 'contain' => array('OrderMenuItem', 'Restaurant', 'OrderMenuItem.OrderMenuExtraItem', 'PaymentMethod', 'Address','UserInfo','RiderOrder.Rider'),

            'conditions' => array(



                'PlaylistVideo.id' => $id


            ),
        ));


    }


    public function getDetailsAgainstVideoID($video_id)
    {

        return $this->find('first', array(


            // 'contain' => array('OrderMenuItem', 'Restaurant', 'OrderMenuItem.OrderMenuExtraItem', 'PaymentMethod', 'Address','UserInfo','RiderOrder.Rider'),

            'conditions' => array(



                'PlaylistVideo.video_id' => $video_id


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

    public function deletePlaylistVideo($playlist_id)
    {
        return $this->deleteAll(
            [
                'PlaylistVideo.playlist_id' => $playlist_id

            ],
            false # <- single delete statement please
        );
    }
}

?>