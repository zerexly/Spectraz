<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('Security', 'Utility');


class Admin extends AppModel
{
    public $useTable = 'admin';




    public function isEmailAlreadyExist($email){

        return $this->find('count', array(
            'conditions' => array('email' => $email)
        ));

    }

    public function getAdminCount()
    {
        return $this->find('count');
    }


    public function verifyPassword($email,$old_password){


        $userData = $this->findByEmail($email, array(
            'id',
            'password',
           


        ));

        if (empty($userData)) {


            return false;

        }

        $passwordHash = Security::hash($old_password, 'blowfish', $userData['Admin']['password']);
        $salt = Security::hash($old_password, 'sha256', true);

        if ($passwordHash == $userData['Admin']['password']) {


            return true;

        }else{
            return false;


        }



    }



    function updatepassword($password)
    {
        $passwordBlowfishHasher = new BlowfishPasswordHasher();
        $user['password'] = $passwordBlowfishHasher->hash($password);
        $user['salt'] = Security::hash($password, 'sha256', true);
        return $user;
    }


    public function getEmailBasedOnUserID($user_id){

        return $this->find('all', array(
            'conditions' => array(
                'Admin.id' => $user_id

            )
        ));


    }




    public function verify($email,$user_password)
    {

        if ($email != "") {
            $userData = $this->find('all', array(
                'conditions' => array(
                    'Admin.email' => $email

                )
            ));


            /*$userData = $this->findByEmail($email, array(
            'user_id',
           'email',
            'password',
            'salt'
           ));*/
            if (empty($userData)) {


                return false;

            }
        }
        $passwordHash = Security::hash($user_password, 'blowfish', $userData[0]['Admin']['password']);
        $salt = Security::hash($user_password, 'sha256', true);

        if ($passwordHash == $userData[0]['Admin']['password']) {
         return true;
        } else {

            return false;


        }



    }


    public function loginAllUsers($email,$user_password)
    {

        if ($email != "") {
            $userData = $this->find('all', array(
                'conditions' => array(
                    'Admin.email' => $email

                )
            ));


            /*$userData = $this->findByEmail($email, array(
            'user_id',
           'email',
            'password',
            'salt'
           ));*/
            if (empty($userData)) {


                return false;

            }
        }
        $passwordHash = Security::hash($user_password, 'blowfish', $userData[0]['Admin']['password']);
        $salt = Security::hash($user_password, 'sha256', true);

        if ($passwordHash == $userData[0]['Admin']['password']  && $userData[0]['Admin']['active'] == 1) {

            return $userData;

        } else {

            return false;


        }



    }

    public function getUserDetailsFromID($user_id){

        return $this->find('first', array(
            'conditions' => array(
                'Admin.id' => $user_id
            ),
            'recursive' => 0


        ));

    }

    public function countAdminUsers(){

        return $this->find('count');

    }
    public function loginAllUsersExceptAdmin($email,$user_password,$role)
    {

        if ($email != "") {
            $userData = $this->find('all', array(
                'conditions' => array(
                    'Admin.email' => $email,
                    'Admin.role' => $role


                )
            ));


            /*$userData = $this->findByEmail($email, array(
            'user_id',
           'email',
            'password',
            'salt'
           ));*/
            if (empty($userData)) {


                return false;

            }
        }
        $passwordHash = Security::hash($user_password, 'blowfish', $userData[0]['User']['password']);
        $salt = Security::hash($user_password, 'sha256', true);

        if ($passwordHash == $userData[0]['Admin']['password']) {
            if($userData[0]['Admin']['role'] !== "admin") {
                return $userData;
            }else{

                return "203";

            }
        } else {

            return false;


        }



    }

    public function loginRestaurantAndRiderAndUser($email,$user_password)
    {

        if ($email != "") {
            $userData = $this->find('all', array(
                'conditions' => array(
                    'User.email' => $email

                )
            ));

            if (empty($userData)) {


                return false;

            }
        }
        $passwordHash = Security::hash($user_password, 'blowfish', $userData[0]['User']['password']);
        $salt = Security::hash($user_password, 'sha256', true);

        if ($passwordHash == $userData[0]['User']['password']) {
            if($userData[0]['User']['role'] == "user" || $userData[0]['User']['role'] == "hotel" || $userData[0]['User']['role'] == "rider") {
                return $userData;
            }else{

                return "203";

            }
        } else {

            return false;


        }



    }

    public function getAllUsers(){

        return $this->find('all', array(
            'order' => array('Admin.id DESC'),
        ));

    }

    public function getAdminDetails(){

        return $this->find('first', array(
            'conditions' => array(
                'Admin.role' => 0

            ),

        ));


    }


    public function findEmail($email,$role){

        return $this->find('all', array(
            'conditions' => array(
                'User.role' => $role,
                'User.email' => $email

            ),

        ));


    }

    public function getAll(){

        return $this->find('all');




    }



    public function beforeSave($options = array())
    {
        $passwordBlowfishHasher = new BlowfishPasswordHasher();


        if (isset($this->data[$this->alias]['password'])) {
            $password = $this->data[$this->alias]['password'];

            $salt = $password;

            $this->data['Admin']['password'] = $passwordBlowfishHasher->hash($password);
            $this->data['Admin']['salt'] = Security::hash($salt, 'sha256', true);
        }
        return true;
    }


}?>