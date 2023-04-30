<?php


class ReportReason extends AppModel
{

    public $useTable = 'report_reason';



    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(



                'ReportReason.id'=> $id,




            )
        ));
    }

    public function getAll()
    {
        return $this->find('all');
    }

    public function checkDuplicate($title)
    {
        return $this->find('count', array(
            'conditions' => array(



                'ReportReason.title'=>$title,





            )
        ));
    }






}
?>