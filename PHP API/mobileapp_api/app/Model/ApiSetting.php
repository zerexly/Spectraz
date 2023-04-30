<?php



class ApiSetting extends AppModel
{

    public $useTable = 'api_setting';


    public function getImages()
    {
        return $this->find('all');


    }


    public function getDetails($id)
    {
        return $this->find('first', array(


            // 'contain' => array('OrderMenuItem', 'Restaurant', 'OrderMenuItem.OrderMenuExtraItem', 'PaymentMethod', 'Address','UserInfo','RiderOrder.Rider'),

            'conditions' => array(



                'ApiSetting.id' => $id


            ),
        ));


    }

    public function getAll()
    {
        return $this->find('all');


    }

    public function getAppSlidersCount()
    {
        return $this->find('count');
    }

    public function deleteAppSlider($id)
    {
        return $this->deleteAll(
            [
                'ApiSetting.id' => $id

            ],
            false # <- single delete statement please
        );
    }
}

?>