<?php



class LiveStreaming extends AppModel
{
    public $useTable = 'live_streaming';


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
            'conditions' => array(

                'LiveStreaming.id' => $id





            )
        ));
    }


    public function getLastLiveStreaming($user_id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'LiveStreaming.user_id' => $user_id





            ),
            'order'=>'LiveStreaming.id DESC'
        ));
    }


    public function getAllPages()
    {
        return $this->find('all');


    }









}