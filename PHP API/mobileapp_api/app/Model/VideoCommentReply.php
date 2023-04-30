<?php


class VideoCommentReply extends AppModel
{

    public $useTable = 'video_comment_reply';

    public $belongsTo = array(
        'VideoComment' => array(
            'className' => 'VideoComment',
            'foreignKey' => 'comment_id',



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



                'VideoCommentReply.id'=> $id,




            )
        ));
    }
    public function countComments($video_id)
    {
        return $this->find('count', array(
            'conditions' => array(



                'VideoCommentReply.video_id'=> $video_id,




            )
        ));
    }

    public function countCommentsBetweenDates($video_ids,$start_datetime,$end_datetime)
    {
        return $this->find('count', array(
            'conditions' => array(



                'VideoCommentReply.video_id IN'=> $video_ids,
                'DATE(VideoCommentReply.created) >='=> $start_datetime,
                'DATE(VideoCommentReply.created) <='=> $end_datetime,




            )
        ));
    }
   
    public function getAll()
    {
        return $this->find('all');
    }






}
?>