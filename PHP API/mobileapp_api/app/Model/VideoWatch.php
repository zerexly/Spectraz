<?php


class VideoWatch extends AppModel
{

    public $useTable = 'video_watch';

    public $belongsTo = array(
        'Device' => array(
            'className' => 'Device',
            'foreignKey' => 'device_id',



        ),'Video' => array(
            'className' => 'Video',
            'foreignKey' => 'video_id',



        ),



    );

    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(



                'VideoWatch.id'=> $id,




            )
        ));
    }

    public function countWatchVideosTotal($video_id)
    {
        return $this->find('count', array(
            'conditions' => array(



                'VideoWatch.video_id'=> $video_id,





            )
        ));
    }

    public function countWatchVideos($video_ids,$start_datetime,$end_datetime)
    {
        
        return $this->find('count', array(
            'conditions' => array(



                'VideoWatch.video_id IN'=> $video_ids,
                'DATE(VideoWatch.created) >='=> $start_datetime,
                'DATE(VideoWatch.created) <='=> $end_datetime,




            )
        ));
    }

    public function countWatchVideosByDate($video_ids,$start_datetime,$end_datetime)
    {

        return $this->find('all', array(
            'fields' => array(
                'DATE(VideoWatch.created) AS date',
                'COUNT(*) AS count'
            ),
            'conditions' => array(
                'DATE(VideoWatch.created) >='=> $start_datetime,
                'DATE(VideoWatch.created) <='=> $end_datetime,
                'VideoWatch.video_id IN'=> $video_ids,
            ),
            'group' => 'DATE(VideoWatch.created)',
            'order' => 'DATE(VideoWatch.created) ASC'
        ));
    }


    public function ifExist($data)
    {
        return $this->find('first', array(
            'conditions' => array(



                'VideoWatch.video_id'=> $data['video_id'],
                'VideoWatch.device_id'=> $data['device_id'],




            )
        ));
    }

    public function getAll()
    {
        return $this->find('all');
    }






}
?>