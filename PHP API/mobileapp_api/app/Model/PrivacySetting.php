<?php



class PrivacySetting extends AppModel
{
    public $useTable = 'privacy_setting';

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

                'PrivacySetting.id' => $id





            )
        ));
    }











}