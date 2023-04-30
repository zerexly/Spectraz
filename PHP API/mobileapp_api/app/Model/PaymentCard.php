<?php



class PaymentCard extends AppModel
{
    public $useTable = 'payment_card';



    public function isUserStripeCustIDExist($user_id){

        return $this->find('count', array(
            'conditions' => array(
                'PaymentCard.user_id' => $user_id,
                'not'=>array( 'PaymentCard.stripe' => "",
                )),
        ));

    }

    public function getUserCards($user_id)
    {
        return $this->find('all', array(
            'conditions' => array(

                'PaymentCard.user_id' => $user_id,




            ),
            'fields'=>array('stripe','id'),
        ));


    }

}