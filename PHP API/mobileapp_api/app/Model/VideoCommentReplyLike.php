<?php


class VideoCommentReplyLike extends AppModel
{

    public $useTable = 'video_comment_reply_like';

    public $belongsTo = array(
        'VideoCommentReply' => array(
            'className' => 'VideoCommentReply',
            'foreignKey' => 'comment_reply_id',



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



                'VideoCommentReplyLike.id'=> $id,




            )
        ));
    }



    public function getUserFavouriteComments($user_id)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'contain' => array('Video.Sound','Video.User'),
            'conditions' => array(




                'VideoCommentLike.user_id'=> $user_id,




            ),

        ));
    }

    public function ifExist($data)
    {
        return $this->find('first', array(
            'conditions' => array(



                'VideoCommentReplyLike.comment_reply_id'=> $data['comment_reply_id'],
                'VideoCommentReplyLike.user_id'=> $data['user_id'],




            )
        ));
    }

    public function countLikes($comment_id)
    {
        return $this->find('count', array(
            'conditions' => array(


                'VideoCommentReplyLike.comment_reply_id' => $comment_id,


            )
        ));
    }
    public function getAll()
    {
        return $this->find('all');
    }






}
?>