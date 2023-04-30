<?php



class ProfileVisit extends AppModel
{
    public $useTable = 'profile_visit';

    public $belongsTo = array(

        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',


        ),

        'Visitor' => array(
            'className' => 'User',
            'foreignKey' => 'visitor_id',


        ),



    );

    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'ProfileVisit.id' => $id





            )
        ));
    }

    public function getProfileViewsBetweenDates($user_id,$start_datetime,$end_datetime)
    {
        return $this->find('count', array(
            'conditions' => array(



                'ProfileVisit.user_id'=> $user_id,
                'DATE(ProfileVisit.created) >='=> $start_datetime,
                'DATE(ProfileVisit.created) <='=> $end_datetime,




            )
        ));
    }
    public function getProfileVisitors($user_id,$date,$starting_point)
    {
        return $this->find('all', array(
            'conditions' => array(

                'ProfileVisit.user_id' => $user_id,
                'DATE(ProfileVisit.created) >' => $date,
                'ProfileVisit.visitor_id !=' => $user_id,


            ),
            'group'=>'ProfileVisit.visitor_id',
            'limit' => 10,
            'offset' => $starting_point*10,

        ));
    }

    public function getProfileVisitorsUnreadCount($user_id)
    {
        return $this->find('count', array(
            'conditions' => array(

                'ProfileVisit.user_id' => $user_id,
                'ProfileVisit.read' => 0,



            ),

            'group'=>'ProfileVisit.visitor_id'



        ));
    }

    public function updateReadCount($user_id){


        $this->updateAll(
            array('ProfileVisit.read' => 1),
            array('ProfileVisit.user_id' => $user_id)
        );
    }





}