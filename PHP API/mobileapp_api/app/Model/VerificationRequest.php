<?php


class VerificationRequest extends AppModel
{
    public $useTable = 'verification_request';

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            //'fields' => array('User.id','User.email','User.username','User.image','User.device_token')

        ),


    );


    public function getDetails($id)
    {

        return $this->find('first', array(
            'conditions' => array('VerificationRequest.id' => $id)
        ));

    }

    public function getVerificationDetailsAgainstUserID($user_id)
    {

        return $this->find('first', array(
            'conditions' => array('VerificationRequest.user_id' => $user_id)
        ));

    }







    public function getAll()
    {

        return $this->find('all',array(


            'order' => 'VerificationRequest.id DESC'
        ));

    }





}

?>