<?php



class Follower extends AppModel
{
    public $useTable = 'follower';


    public $belongsTo = array(
        'FollowingList' => array(
            'className' => 'User',
            'foreignKey' => 'receiver_id',
            //'fields' => array('User.id','User.email','User.username','User.image','User.device_token')

        ),

        'FollowerList' => array(
            'className' => 'User',
            'foreignKey' => 'sender_id',
            //'fields' => array('User.id','User.email','User.username','User.image','User.device_token')

        ),


    );






    public function getAll()
    {

        return $this->find('all',array(


            'order'=>'Follower.id DESC',
            'recursive'=> -1

        ));

    }


    public function getDetails($id){

        return $this->find('first', array(
            'conditions' => array(
                'Follower.id' => $id
            ),

            'recursive' => 0


        ));

    }

    public function ifFollowing($sender_id,$receiver_id){

        return $this->find('first', array(
            'conditions' => array(
                'Follower.sender_id' => $sender_id,
                'Follower.receiver_id' => $receiver_id,
            ),

            'recursive' => 0


        ));

    }
    public function isFollowerOrFollowed($user_id){
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(

                "OR" => array (
                    "Follower.sender_id" => $user_id,
                    "Follower.receiver_id" => $user_id,

                ),




            ),



            'order'=>'Follower.id DESC',

        ));

    }


    public function countFollowers($user_id){

        return $this->find('count', array(
            'conditions' => array(
                'Follower.receiver_id' => $user_id
            ),

            'recursive' => 0


        ));

    }

    public function countFollowersBetweenDatetime($user_id,$start_datetime,$end_datetime){

        return $this->find('count', array(
            'conditions' => array(
                'Follower.receiver_id' => $user_id,
                'DATE(Follower.created) >='=> $start_datetime,
                'DATE(Follower.created) <='=> $end_datetime,

            ),

            'recursive' => 0


        ));

    }
    public function countFollowersByDate($user_id,$start_datetime,$end_datetime)
    {


        return $this->find('all', array(
            'fields' => array(
                'DATE(Follower.created) AS date',
                'COUNT(*) AS count'
            ),
            'conditions' => array(
                'DATE(Follower.created) >='=> $start_datetime,
                'DATE(Follower.created) <='=> $end_datetime,
                'Follower.receiver_id'=> $user_id,
            ),
            'group' => 'DATE(Follower.created)',
            'order' => 'DATE(Follower.created) ASC'
        ));
    }


    public function countFollowersByCountry($user_id,$start_datetime,$end_datetime)
    {


        return $this->find('all', array(
            'fields' => array(
                'FollowingList.country AS country',
                'COUNT(*) AS count',


            ),
            'conditions' => array(
                'DATE(Follower.created) >='=> $start_datetime,
                'DATE(Follower.created) <='=> $end_datetime,
                'Follower.receiver_id'=> $user_id,
                'FollowingList.country !=' => '',
                'FollowingList.country IS NOT NULL'
            ),
            'group' => 'FollowingList.country',

            'order' => 'count DESC'
        ));
    }

    public function countFollowersByCity($user_id,$start_datetime,$end_datetime)
    {


        return $this->find('all', array(
            'fields' => array(
                'FollowingList.city AS city',
                'COUNT(*) AS count',


            ),
            'conditions' => array(
                'DATE(Follower.created) >='=> $start_datetime,
                'DATE(Follower.created) <='=> $end_datetime,
                'Follower.receiver_id'=> $user_id,
                'FollowingList.city !=' => '',
                'FollowingList.city IS NOT NULL'
            ),
            'group' => 'FollowingList.city',

            'order' => 'count DESC'
        ));
    }

   
    public function getFollowersByAge($user_id,$start_datetime,$end_datetime){


       return $this->query("SELECT 
  CASE
    WHEN TIMESTAMPDIFF(YEAR, User.dob, CURDATE()) BETWEEN 18 AND 24 THEN '18-24'
    WHEN TIMESTAMPDIFF(YEAR, User.dob, CURDATE()) BETWEEN 25 AND 34 THEN '25-34'
    WHEN TIMESTAMPDIFF(YEAR, User.dob, CURDATE()) BETWEEN 35 AND 44 THEN '35-44'
    WHEN TIMESTAMPDIFF(YEAR, User.dob, CURDATE()) BETWEEN 45 AND 54 THEN '45-54'
    ELSE '55+'
  END AS age_range,
  COUNT(*) AS count
FROM follower as Follower
JOIN user as User ON Follower.receiver_id = User.id
WHERE TIMESTAMPDIFF(YEAR, User.dob, CURDATE()) >= 18 AND Follower.receiver_id = $user_id AND DATE(Follower.created) >= '$start_datetime' AND DATE(Follower.created) <= '$end_datetime'
GROUP BY age_range");
    }
    public function countFollowersByGender($user_id,$start_datetime,$end_datetime,$gender){

        return $this->find('count', array(
            'conditions' => array(
                'Follower.receiver_id' => $user_id,
                'FollowerList.gender' =>$gender,
                'DATE(Follower.created) >='=> $start_datetime,
                'DATE(Follower.created) <='=> $end_datetime,

            ),

            'recursive' => 0


        ));

    }


    public function countFollowing($user_id){

        return $this->find('count', array(
            'conditions' => array(
                'Follower.sender_id' => $user_id
            ),

            'recursive' => 0


        ));

    }

    public function deleteFollowerAgainstUserID($user_id){


        $conditions = array(
            'OR' => array(
                'Follower.sender_id' => $user_id,
                'Follower.receiver_id' => $user_id,
            )
        );

        $this->deleteAll($conditions);
    }

    public function getUserFollowersAgainstPromotionID($user_id,$promotion_id){

        return $this->find('count', array(
            'conditions' => array(

                "Follower.receiver_id" => $user_id,
                "Follower.promotion_id" => $promotion_id,


            ),

            'fields'=>array('FollowerList.*'),





        ));

    }

    public function getUserFriends($user_id){
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(

                "OR" => array (
                    "Friend.user_id" => $user_id,
                    "Friend.friend_id" => $user_id,

                ),

                "AND" => array (
                    "Friend.block_id" => 0


                )


            ),



            'order'=>'Friend.id DESC',

        ));

    }

    public function searchFollowerOrFollowingNew($keyword,$starting_point,$user_id){

        return $this->find('all', array(
            'conditions' => array(
                'AND' =>
                    array(
                        array('OR' => array(
                            array('FollowerList.first_name Like' => "%$keyword%"),
                            array('FollowerList.last_name Like' => "%$keyword%"),
                            array('FollowerList.username Like' => "%$keyword%"),
                            array('FollowingList.first_name Like' => "%$keyword%"),
                            array('FollowingList.last_name Like' => "%$keyword%"),
                            array('FollowingList.username Like' => "%$keyword%")
                        )),
                        array('OR' => array(
                            array('Follower.receiver_id' => $user_id),
                            array('Follower.sender_id' => $user_id),
                           
                        )),
                    )),
            'fields'=>array('FollowerList.*','FollowingList.*'),


            'limit'=>10,
            'offset' => $starting_point*10,



        ));

    }
    public function searchFollower($keyword,$starting_point,$user_id){


        $this->Behaviors->attach('Containable');
        return $this->find('all', array(

            'conditions' => array(
                'OR' => array(
                    'FollowerList.first_name Like' => "%$keyword%",
                    'FollowerList.last_name Like' => "%$keyword%",
                    'FollowerList.username Like' => "%$keyword%",
                    'FollowingList.first_name Like' => "%$keyword%",
                    'FollowingList.last_name Like' => "%$keyword%",
                    'FollowingList.username Like' => "%$keyword%"

                ),
                "Follower.receiver_id" => $user_id,


            ),
            'fields'=>array('FollowerList.*','FollowingList.*'),


            'limit'=>10,
            'offset' => $starting_point*10,





            'recursive' => 0


        ));

    }

    public function searchFollowing($keyword,$starting_point,$user_id){


        $this->Behaviors->attach('Containable');
        return $this->find('all', array(

            'conditions' => array(
                'OR' => array(
                    'FollowingList.first_name Like' => "%$keyword%",
                    'FollowingList.last_name Like' => "%$keyword%",
                    'FollowingList.username Like' => "%$keyword%",


                ),
                "Follower.sender_id" => $user_id,
            ),
            'fields'=>array('FollowingList.*'),


            'limit'=>10,
            'offset' => $starting_point*10,





            'recursive' => 0


        ));

    }

    public function searchFollowerOrFollowing($keyword,$starting_point,$user_id){


        $this->Behaviors->attach('Containable');
        return $this->find('all', array(

            'conditions' => array(
                'OR' => array(
                    'FollowerList.first_name Like' => "%$keyword%",
                    'FollowerList.last_name Like' => "%$keyword%",
                    'FollowerList.username Like' => "%$keyword%"

                ),
                "OR" => array (
                    "Follower.receiver_id" => $user_id,
                    "Follower.sender_id" => $user_id,


                ),



            ),
            'fields'=>array('FollowerList.*'),


            'limit'=>10,
            'offset' => $starting_point*10,





            'recursive' => 0


        ));

    }

    public function getUserFollowers($user_id,$starting_point){
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(

                "Follower.receiver_id" => $user_id,


            ),

            'fields'=>array('FollowerList.*'),
            'limit' => 10,
            'offset' => $starting_point*10,


            'order'=>'Follower.id DESC',

        ));

    }

    public function getUserFollowersAdmin($user_id){
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(

                "Follower.receiver_id" => $user_id,


            ),

            'fields'=>array('FollowerList.*'),



            'order'=>'Follower.id DESC',

        ));

    }

    public function getUserFollowersWithoutLimit($user_id){
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(

                "Follower.receiver_id" => $user_id,
                "Follower.notification" => 1,


            ),

            'fields'=>array('FollowerList.*'),



            'order'=>'Follower.id DESC',

        ));

    }
    public function getUserFollowing($user_id,$starting_point){
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(

                "Follower.sender_id" => $user_id,



            ),

            'fields'=>array('FollowingList.*'),

            'limit' => 10,
            'offset' => $starting_point*10,

            'order'=>'Follower.id DESC',

        ));

    }

    public function getUserFollowingAdmin($user_id){
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(

                "Follower.sender_id" => $user_id,



            ),

            'fields'=>array('FollowingList.*'),



            'order'=>'Follower.id DESC',

        ));

    }




    public function getUserFollowingWithoutLimit($user_id){
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(

                "Follower.sender_id" => $user_id,



            ),

            'fields'=>array('FollowingList.*'),

            'order'=>'Follower.id DESC',

        ));

    }

    public function getALLUserNotFriends($user_id){
        $this->Behaviors->attach('Containable');
        return $this->find('all', array(
            'conditions' => array(

                "AND" => array (
                    "Friend.user_id" => $user_id,
                    "Friend.friend_id" => $user_id,

                ),

                "AND" => array (
                    "Friend.block_id" => 0


                )


            ),



            'order'=>'Friend.id DESC',

        ));

    }

    public function isFriend($user_id,$friend_id){

        return $this->find('first', array(
            'conditions' => array(
                'OR' =>
                    array(
                        array('AND' => array(
                            array('Friend.user_id' => $user_id),
                            array('Friend.friend_id' => $friend_id),
                            array('Friend.block_id' => 0)
                        )),
                        array('AND' => array(
                            array('Friend.user_id' => $friend_id),
                            array('Friend.friend_id' => $user_id),
                            array('Friend.block_id' => 0)
                        )),
                    )),
            'recursive'=> -1


        ));

    }

    public function ifBlocked($user_id,$friend_id){

        return $this->find('count', array(
            'conditions' => array(
                'OR' =>
                    array(
                        array('AND' => array(
                            array('Friend.user_id' => $user_id),
                            array('Friend.friend_id' => $friend_id),
                            array('Friend.block_id !=' => 0)
                        )),
                        array('AND' => array(
                            array('Friend.user_id' => $friend_id),
                            array('Friend.friend_id' => $user_id),
                            array('Friend.block_id !=' => 0)
                        )),
                    )),

            'recursive'=> -1


        ));

    }










}

?>