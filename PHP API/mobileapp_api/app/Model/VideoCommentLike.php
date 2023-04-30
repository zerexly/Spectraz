<?php


class VideoCommentLike extends AppModel
{

    public $useTable = 'video_comment_like';

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
        $this->Behaviors->attach('Containable');
        return $this->find('first', array(
            'conditions' => array(



                'VideoCommentLike.id'=> $id,




            ),
            'contain'=>array('VideoComment.Video','User'),
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
        $this->Behaviors->attach('Containable');
        return $this->find('first', array(
            'conditions' => array(



                'VideoCommentLike.comment_id'=> $data['comment_id'],
                'VideoCommentLike.user_id'=> $data['user_id'],




            ),
            'contain'=>array('VideoComment.Video','User'),
        ));
    }

    public function countLikes($comment_id)
    {
        return $this->find('count', array(
            'conditions' => array(


                'VideoCommentLike.comment_id' => $comment_id,


            )
        ));
    }
    public function getAll()
    {
        return $this->find('all');
    }






}
?>