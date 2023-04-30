<?php


class Device extends AppModel
{

    public $useTable = 'device';



    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(



                'Device.id'=> $id,




            )
        ));
    }

    public function ifExist($name)
    {
        return $this->find('first', array(
            'conditions' => array(



                'Device.key'=> $name,




            )
        ));
    }







}
?>