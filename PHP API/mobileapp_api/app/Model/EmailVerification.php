<?php



class EmailVerification extends AppModel
{
    public $useTable = 'email_verification';



    public function verifyCode($email,$code){

        return $this->find('first', array(
            'conditions' => array(
                'EmailVerification.email' => $email,
                'EmailVerification.code' => $code
            )


        ));

    }


    public function getDetails($id){

        return $this->find('first', array(
            'conditions' => array(
                'EmailVerification.id' => $id,

            )


        ));

    }


}