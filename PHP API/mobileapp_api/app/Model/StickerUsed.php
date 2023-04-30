<?php



class StickerUsed extends AppModel
{
    public $useTable = 'sticker_used';

    public $belongsTo = array(

        'Sticker' => array(
            'className' => 'Sticker',
            'foreignKey' => 'sticker_id',


        ),

        'User' => array(
            'className' => 'User',
            'foreignKey' => 'visitor_id',


        ),



    );

    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'StickerUsed.id' => $id





            )
        ));
    }

    public function getAll($type,$starting_point)
    {
        return $this->find('all', array(
            'conditions' => array(

                'Sticker.type' => $type,



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