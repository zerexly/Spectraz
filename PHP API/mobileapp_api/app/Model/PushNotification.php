<?php



class PushNotification extends AppModel
{
    public $useTable = 'push_notification';

    public $belongsTo = array(

        'User' => array(
            'className' => 'User',
            'foreignKey' => 'id',


        ),



    );

    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'PushNotification.id' => $id





            )
        ));
    }










}