<?php


class City extends AppModel
{
    public $useTable = 'cities';

    public $belongsTo = array(
        'State' => array(
            'State' => 'State',
            'foreignKey' => 'state_id',

        ),

        'Country' => array(
            'State' => 'Country',
            'foreignKey' => 'country_id',

        ),
    );

    public function getDetails($id)
    {

        return $this->find('first', array(
            'conditions' => array('City.id' => $id)
        ));

    }


    public function getCities()
    {

        return $this->find('all',  array(
            'conditions' => array('City.active' => 1),


            'order'=>'City.name ASC',

        ));

    }

    public function getCityAgainstName($name,$state_id,$country_id)
    {

        return $this->find('first', array(
            'conditions' => array(
                'City.name' => $name,
                'OR' => array(
                    array('City.country_id' => $country_id),
                    array('City.state_id' => $state_id),
                )

            )
        ));

    }
    public function getCitiesAgainstKeywordAndStateID($keyword,$state_id)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all',  array(
            'conditions' => array(
                'City.active' => 1,
                'City.name Like' => "$keyword%",
                'City.state_id' => $state_id
            ),
            'contain' => array('State.Country'),
            'limit' => 5,
            'order'=>'City.name ASC',

        ));

    }

    public function getCitiesAgainstKeyword($keyword)
    {
        $this->Behaviors->attach('Containable');
        return $this->find('all',  array(
            'conditions' => array(
                'City.active' => 1,
                'City.name Like' => "$keyword%",

            ),
            'limit' => 5,
            'contain' => array('State.Country'),
            'order'=>'City.name ASC',

        ));

    }

    public function getCitiesAgainstState($state_id)
    {

        return $this->find('all',  array(
            'conditions' => array('City.state_id' => $state_id),


            'order'=>'City.name ASC',

        ));

    }





}

?>