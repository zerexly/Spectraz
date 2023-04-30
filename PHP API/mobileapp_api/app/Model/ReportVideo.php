<?php



class ReportVideo extends AppModel
{
    public $useTable = 'report_video';

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

                'ReportVideo.id' => $id





            )
        ));
    }


    public function getReportsAgainstVideo($video_id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'ReportVideo.video_id' => $video_id





            )
        ));

    }


    public function getAll()
    {
        return $this->find('all', array(
            'order' => 'ReportVideo.id DESC',
        ));

    }







}