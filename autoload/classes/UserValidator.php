<?php
class UserValidator{

    private $email;
    private $username;
    public static $errors = ['','','','','','','','','',''];
    public static $data = [0,0,0,0,0,0,0,0,0,0];

    function __construct($username, $email, $password, $firstname, $lastname){
        $this->username = $username;
        $this ->email = $email;
        $this ->password = $password;
        $this ->firstname = $firstname;
        $this ->lastname = $lastname;

        self::NameValidator($username);
        self::EmailValidator($email);
        self::FirstNameValidator($firstname);
        self::LastNameValidator($lastname);
        self::PasswordValidator($password);
    }


    static function NameValidator($username){
        if(!preg_match("/^[a-zA-Z]+$/i", $username)){
            
            
            self::$errors[0] = 'Username error';
            return 0;
            
        }
        else{
            self::$data[0] = $username;
            return 1;
        }
    }

    static function EmailValidator($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            
            self::$errors[1] = 'Email error';
            return 0;
        }
        else{
            self::$data[1] = $email;
            return 1;
        }
    }

    static function PasswordValidator($password){
        if(!preg_match("/^[A-Za-z0-9]+$/i", $password)){
            self::$errors[2] = "Password Error";
            return 0;
        }else{
            self::$data[2] = $password;
            return 1;
        }
    }
    static function FirstNameValidator($firstname){
        if(!preg_match("/^[A-Za-z]+$/i", $firstname)){
            self::$errors[3] = "first name Error";
            return 0;
        }else{
            self::$data[3] = $firstname;
            return 1;
        }
    }
    static function LastNameValidator($lastname){
        if(!preg_match("/^[A-Za-z]+$/i", $lastname)){
            self::$errors[4] = "Last name Error";
            return 0;
        }else{
            self::$data[4] = $lastname;
            return 1;
        }
    }

    public static function errors(){

        foreach(self::$errors as $error){
            if($error != ''){
                return "Error: $error";
            }   
        }
        return '';
        
        // if(self::$errors[0] == 'Username error'){
            
        //     return 'Check your name';
        // }
        // elseif (self::$errors[1] == 'Email error'){
        //     return 'Check your email';
        // }
        // elseif (self::$errors[2] != ''){
        //     return 'Check your password';
        // }
        // elseif (self::$errors[3] != ''){
        //     return 'Check your firstname';
        
        // }
        // elseif (self::$errors[4] != ''){
        //     return 'Check your LASTname';
        // }
        // else{
        //     return '';
        // }
    }
}

?>