<?php



class LiveStreamingWatch extends AppModel
{
    public $useTable = 'live_streaming_watch';


    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            //'fields' => array('User.id','User.email','User.username','User.image','User.device_token')

        ),

        'LiveStreaming' => array(
            'className' => 'LiveStreaming',
            'foreignKey' => 'live_streaming_id',
            //'fields' => array('User.id','User.email','User.username','User.image','User.device_token')

        ),
    );

    public function getDetails($id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'LiveStreamingWatch.id' => $id





            )
        ));
    }



    public function checkDuplicate($user_id,$live_streaming_id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'LiveStreamingWatch.user_id' => $user_id,
                'LiveStreamingWatch.live_streaming_id' => $live_streaming_id,





            )
        ));
    }

    public function checkIfExist($user_id,$live_streaming_id)
    {
        return $this->find('first', array(
            'conditions' => array(

                'LiveStreamingWatch.user_id' => $user_id,
                'LiveStreamingWatch.live_streaming_id' => $live_streaming_id,
                'LiveStreamingWatch.ended_at' => "0000-00-00 00:00:00",





            )
        ));
    }

    public function getLiveStreamViewers($live_streaming_id)
    {
        return $this->find('all', array(
            'conditions' => array(


                'LiveStreamingWatch.live_streaming_id' => $live_streaming_id,
                'LiveStreamingWatch.duration' => 0,





            ),
            'group' => 'LiveStreamingWatch.user_id'
            //'offset' => $starting_point*10,
        ));
    }


    public function getTotalDurationUserWatchedInAMonth($user_id,$month)
    {
        return $this->find('first', array(
            'conditions' => array(


                'LiveStreamingWatch.user_id' => $user_id,
                'DAY(LiveStreamingWatch.created)'=> $month,





            ),
            'fields' => array('SUM(LiveStreamingWatch.duration) as total_duration','*','LiveStreamingWatch.*'),
        ));
    }


    public function checkDuplicateAll($user_id,$live_streaming_id)
    {
        return $this->find('all', array(
            'conditions' => array(

                'LiveStreamingWatch.user_id' => $user_id,
                'LiveStreamingWatch.live_streaming_id' => $live_streaming_id,





            )
        ));
    }


    public function getTopViewersInAMonth($month)
    {
        $this->Behaviors->attach('Containable');

        return $this->find('all', array(
            'conditions' => array(



                'MONTH(LiveStreamingWatch.created)'=> $month,




            ),
            'fields' => array('SUM(LiveStreamingWatch.duration) as total_duration','*','User.*'),
            'group' => 'LiveStreamingWatch.user_id',
            'order' => 'total_duration DESC',
            'limit'=>10
        ));
    }





}