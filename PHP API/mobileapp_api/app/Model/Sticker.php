<?php



class Sticker extends AppModel
{
    public $useTable = 'sticker';

   
    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'Sticker.id' => $id





            )
        ));
    }

    public function getAll($type,$starting_point)
    {
        return $this->find('all', array(
           
            //'group'=>'ProfileVisit.visitor_id',
            'limit' => 40,
            'offset' => $starting_point*40,

        ));
    }

    public function getAllAdmin()
    {
        return $this->find('all');
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