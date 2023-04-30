<?php



class HtmlPage extends AppModel
{
    public $useTable = 'html_page';



    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'HtmlPage.id' => $id





            )
        ));
    }


    public function getAllPages()
    {
        return $this->find('all');


    }

    public function ifExist($name)
    {
        return $this->find('first', array(
            'conditions' => array(

                'HtmlPage.name' => $name





            )
        ));
    }








}