<?php


class State extends AppModel
{
    public $useTable = 'states';

    public $belongsTo = array(
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country_id',

        ),


    );

    public function getDetails($id)
    {

        return $this->find('first', array(
            'conditions' => array('State.id' => $id)
        ));

    }


    public function getStates()
    {

        return $this->find('all',  array(
            'conditions' => array('State.active' => 1),


            'order'=>'State.name ASC',

        ));

    }

    public function getStateAgainstName($name,$country_id)
    {

        return $this->find('first', array(
            'conditions' => array(
                'State.name' => $name,
                'State.country_id' => $country_id,


            )
        ));

    }

    public function getStateAgainstShortName($name,$country_id)
    {

        return $this->find('first', array(
            'conditions' => array(
                'State.short_name' => $name,
                'State.country_id' => $country_id,


            )
        ));

    }

    public function getStatesAgainstKeywordAndCountry($keyword,$country_id)
    {

        return $this->find('all',  array(
            'conditions' => array(
                'State.active' => 1,
                'State.name Like' => "$keyword%",
                'State.country_id' => $country_id
            ),

            'limit' => 5,
            'order'=>'State.name ASC',

        ));

    }

    public function getStatesAgainstKeyword($keyword)
    {

        return $this->find('all',  array(
            'conditions' => array(
                'State.active' => 1,
                'State.name Like' => "$keyword%",

            ),

            'limit' => 5,
            'order'=>'State.name ASC',

        ));

    }

    public function getStatesAgainstCountry($country_id)
    {

        return $this->find('all',  array(
            'conditions' => array('State.country_id' => $country_id),


            'order'=>'State.name ASC',

        ));

    }





}

?>