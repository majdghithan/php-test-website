<?php 

include 'UserValidator.php';

class ShippingValidator extends UserValidator{

    // static $information = array();

    static function check($email, $firstname, $lastname, $adress, $zip,$state){

        parent::EmailValidator($email); //1
        self::ValidateStringAndNumber($adress); //2
        parent::FirstNameValidator($firstname); //3
        parent::LastNameValidator($lastname); //4
        self::ValidateNumber($zip); //5
        self::ValidateString($state); //6

    }

    static function check_paypal($email, $password){
        parent::EmailValidator($email);
        parent::PasswordValidator($password);
      
        return (parent::errors() =='' ? 1: 0);
    }

    static function check_card($name, $number,$exp,$cvv){

        self::ValidateString($name);
        self::ValidateCreditCard($number);
        self::ValidateExp($exp);
        self::ValidateCVV($cvv);

        return (parent::errors() =='' ? 1: 0);
    }

    static function ValidateCreditCard($number){
        if(!preg_match("/^[0-9 ]+$/i", $number)){
            parent::$errors[7] = "Should be in this form: #### #### #### ####";
            
            return 0;
        }else{
            parent::$data[7] = $number;
            return 1;
        }
    }
    static function ValidateExp($number){
        if(!preg_match("/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/i", $number)){
            parent::$errors[8] = "Should be in this form: ##/## or #### or ##/####";

            

            return 0;
        }else{
            parent::$data[8] = $number;
            return 1;
        }
    }
    static function ValidateCVV($number){
        if(!preg_match("/^[0-9]{3,4}$/i", $number)){
            parent::$errors[9] = "Should be 3 or 4 degits";
           
            return 0;
        }else{
            parent::$data[9] = $number;
            // echo 'cvv is no ok';
            return 1;
        }
    }

    static function ValidateString($sttring){
        if(!preg_match("/^[A-Za-z]+$/i", $sttring)){
            parent::$errors[6] = "Should be characters";
            return 0;
        }else{
            parent::$data[6] = $sttring;
            return 1;
        }
    }
    static function ValidateNumber($num){
        if(!preg_match("/^[0-9]+$/i", $num)){
            parent::$errors[5] = "Should be a number only";
            return 0;
        }else{
            parent::$data[5] = $num;
            return 1;
        }
    }
    static function ValidateStringAndNumber($value){
        if(!preg_match("/^[A-Za-z0-9 ]+$/i", $value)){
            parent::$errors[2] = "Should consist of characters and numbers only";
            return 0;
        }else{
            parent::$data[2] = $value;
            return 1;
        }
    }
}





?>