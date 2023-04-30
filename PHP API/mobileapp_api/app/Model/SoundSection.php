<?php


class SoundSection extends AppModel
{

    public $useTable = 'sound_section';


    public $hasMany = array(
        'Sound' => array(
            'className' => 'Sound',
            'foreignKey' => 'sound_section_id',
            'dependent' =>true



        )
    );
    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(



                'SoundSection.id'=> $id,




            )
        ));
    }

    public function ifExist($name)
    {
        return $this->find('first', array(
            'conditions' => array(



                'SoundSection.name'=> $name,




            )
        ));
    }

    public function getAll()
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'contain' => array('Sound'=> array(

                'limit' => 3,



            ))
        ));
    }







}
?>