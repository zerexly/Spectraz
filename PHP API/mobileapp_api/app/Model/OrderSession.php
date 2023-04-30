<?php



class OrderSession extends AppModel
{
    public $useTable = 'order_session';

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

                'OrderSession.id' => $id





            )
        ));
    }

    public function getAll()
    {
        return $this->find('all');





    }



    public function getOrderSessionAgainstUserID($user_id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'OrderSession.user_id' => $user_id





            )
        ));

    }








}