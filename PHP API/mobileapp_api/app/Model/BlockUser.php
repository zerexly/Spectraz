<?php


class BlockUser extends AppModel
{

    public $useTable = 'block_user';

    public $belongsTo = array(

        'BlockedUser' => array(
            'className' => 'User',
            'foreignKey' => 'block_user_id',


        ),
    );

    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(



                'BlockUser.id'=> $id,




            )
        ));
    }

    public function getBlockUsers($user_id)
    {
        return $this->find('all', array(
            'conditions' => array(



                'BlockUser.user_id'=> $user_id,




            )
        ));
    }

    public function ifAlreadyBlocked($data)
    {
        return $this->find('first', array(
            'conditions' => array(



                'BlockUser.user_id'=> $data['user_id'],
                'BlockUser.block_user_id'=> $data['block_user_id'],




            )
        ));
    }

    public function ifBlocked($user_id,$block_user_id)
    {
        return $this->find('first', array(
            'conditions' => array(



                'BlockUser.user_id'=> $user_id,
                'BlockUser.block_user_id'=> $block_user_id,




            )
        ));
    }







}
?>