<?php


class WithdrawRequest extends AppModel
{

    public $useTable = 'withdraw_request';

    public $belongsTo = array(

        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',


        ),
    );


    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(



                'WithdrawRequest.id'=> $id,




            )
        ));
    }

    public function getUserPendingWithdrawRequest($user_id)
    {
        return $this->find('all', array(
            'conditions' => array(



                'WithdrawRequest.user_id'=> $user_id,
                'WithdrawRequest.status'=> 0,




            )
        ));
    }

    public function getUserLastWithdrawRequest($user_id)
    {
        return $this->find('first', array(
            'conditions' => array(



                'WithdrawRequest.user_id'=> $user_id,
                'WithdrawRequest.status'=> 1,




            ),
            'order' => 'WithdrawRequest.id DESC',
        ));
    }


    public function getAllPendingRequests($status)
    {
        return $this->find('all', array(
            'conditions' => array(




                'WithdrawRequest.status'=> array($status,1,2),




            )
        ));
    }




    public function getAll()
    {
        return $this->find('all');
    }







}
?>