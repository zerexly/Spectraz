<?php



class AudienceLocation extends AppModel
{
    public $useTable = 'audience_location';

    public $belongsTo = array(

        'Audience' => array(
            'className' => 'Audience',
            'foreignKey' => 'audience_id',


        ),



        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country_id',


        ),
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state_id',


        ),
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'city_id',


        ),

    );

    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'AudienceLocation.id' => $id





            )
        ));
    }


    public function getCountriesAgainstAudience($audience_id)
    {
        return $this->find('all', array(
            'conditions' => array(

                'AudienceLocation.audience_id' => $audience_id





            )
        ));
    }










}