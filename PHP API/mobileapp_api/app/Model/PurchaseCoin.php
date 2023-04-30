<?php


class PurchaseCoin extends AppModel
{

    public $useTable = 'purchase_coin';

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



                'PurchaseCoin.id'=> $id,




            )
        ));
    }




    public function getAll()
    {
        return $this->find('all');
    }


    public function totalAmountPurchase($user_id)
    {

        return $this->find('first', array(
            'conditions' => array(

                'PurchaseCoin.user_id' => $user_id,


            ),
            'fields'=>array('SUM(PurchaseCoin.coin) as total_amount'),
        ));

    }




}
?>