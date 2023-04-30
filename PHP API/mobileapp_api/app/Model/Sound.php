<?php


class Sound extends AppModel
{

    public $useTable = 'sound';

    public $belongsTo = array(

        'SoundSection' => array(
            'className' => 'SoundSection',
            'foreignKey' => 'sound_section_id',


        )
    );
    public $hasMany = array(
        'Video' => array(
            'className' => 'Video',
            'foreignKey' => 'sound_id',
            'dependent' =>true



        ),

        'SoundFavourite' => array(
            'className' => 'SoundFavourite',
            'foreignKey' => 'sound_id',
            'dependent' =>true



        ),




    );

    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(



                'Sound.id'=> $id,




            )
        ));
    }

    public function getSoundsAgainstSection($sound_section_id,$starting_point)
    {




        return $this->find('all', array(
            // 'fields' => array('id'),

            'conditions' => array(

                'Sound.sound_section_id'=> $sound_section_id,



            ),

            'limit'=>10,
            'offset' => $starting_point*10,

            'order' => 'Sound.id DESC',
            'recursive'=>-1
        ));

    }

    public function getSearchSoundsAgainstSection($keyword, $sound_section_id,$starting_point)
    {




        return $this->find('all', array(
            // 'fields' => array('id'),

            'conditions' => array(

                'Sound.sound_section_id'=> $sound_section_id,
                'Sound.publish'=> 1,

                'OR' => array(
                    array('Sound.name Like' => "%$keyword%"),
                    array('Sound.description Like' => "%$keyword%"),

                ),


            ),

            'limit'=>10,
            'offset' => $starting_point*10,

            'order' => 'Sound.id DESC',
            'recursive'=>-1
        ));

    }

    public function checkDuplicate($audio,$created)
    {
        return $this->find('count', array(
            'conditions' => array(



                'Sound.audio'=>$audio,
                'Sound.created'=> $created




            )
        ));
    }

    public function getSoundsCount($section_id)
    {
        return $this->find('count', array(
            'conditions' => array(



                'Sound.sound_section_id'=>$section_id,





            )
        ));
    }


    public function getSoundDetailsAgainstAudio($audio)
    {
        return $this->find('first', array(
            'conditions' => array(



                'Sound.audio'=>$audio,





            )
        ));
    }

    public function getFreqSounds($starting_id,$freq_sounds)
    {




        return $this->find('all', array(
            // 'fields' => array('id'),
            'conditions' => array(


                'Sound.id IN'=> $freq_sounds,
                'Sound.publish'=> 1
            ),
            'limit' => 10,
            'offset' => $starting_id*10,

            'order' => 'Sound.name ASC',
            'recursive'=>-1
        ));

    }

    public function getSounds()
    {


        $this->Behaviors->attach('Containable');

        return $this->find('all', array(
            // 'fields' => array('id'),



            'order' => 'Sound.id DESC',
            'recursive'=>-1
        ));

    }

    public function getSearchResults($keyword,$starting_point){



        return $this->find('all', array(

            'conditions' => array(


                'OR' => array(
                    array('Sound.name Like' => "%$keyword%"),
                    array('Sound.description Like' => "%$keyword%"),

                ),
                'Sound.publish'=> 1



            ),

            'limit'=>10,
            'offset' => $starting_point*10,






            'recursive' => 0


        ));

    }

    public function getSoundsAccordingToStatus($publish){

        $this->Behaviors->attach('Containable');

        return $this->find('all', array(

            'conditions' => array(



                'Sound.publish'=> $publish



            ),







            'recursive' => 0


        ));

    }

    public function getGlobalSounds($starting_id)
    {




        return $this->find('all', array(

            'conditions' => array(


                'Sound.publish'=> 1
            ),
            'limit' => 10,
            'offset' => $starting_id*10,


            'order' => 'Sound.name ASC',
            'recursive'=>-1
        ));

    }






}
?>