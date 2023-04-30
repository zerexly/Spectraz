<?php



class ReportUser extends AppModel
{
    public $useTable = 'report_user';

    public $belongsTo = array(

        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',


        ),

        'Report' => array(
            'className' => 'User',
            'foreignKey' => 'report_user_id',


        ),

        'ReportReason' => array(
            'className' => 'ReportReason',
            'foreignKey' => 'report_reason_id',


        ),

    );

    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'ReportUser.id' => $id





            )
        ));
    }


    public function getReportsAgainstUser($user_id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'ReportUser.report_user_id' => $user_id





            )
        ));

    }

    public function getAll()
    {
        return $this->find('all', array(
            'order' => 'ReportUser.id DESC',
        ));

    }






}