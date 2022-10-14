<?php 



class UserLogIn{

    public static $errors =['',''];
    public $data = ['','',''];
    public $email,$password;

    function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password; 

        $this->UserLogInEmail($email, $password);  
    }

     function UserLogInEmail($email, $password){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            // echo 'checking email in database';
            // echo '<br>';
            include 'autoload/config/userdb.php';

            $sql = "SELECT * from users where users.email = '$email'";

            $result = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($result);

            

            if($count !=1){
                self::$errors[0] = "Email Error";
                // echo 'email error';
                
            }else{
                
                // echo 'email is ok';
                $this->data[0] = $email;
                
                $this->UserLogInPassword($email, $password);
            }
        }
        else{
            // echo 'not an email';
            self::$errors[0] = "This is not an email! is this kinda joke?";
        }
    }
    function UserLogInPassword($email, $password){

        include 'autoload/config/userdb.php';
        
        if(!preg_match("/^[A-Za-z0-9]+$/i", $password)){
            self::$errors[1] = "What is this?";
        }
        else{
        $hashed = MD5($password);
        
        $sql = "SELECT * FROM users where email = '$email' and password = '$hashed'";

        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        

        

        $count = mysqli_num_rows($result);

        // echo '<br>';
        // echo ($count);

        if($count == 1){
            // echo 'LOGGED IN';
            
            
            // echo '<br> Array:';
            // print_r($row);
            // echo '<br>';

            $this->data[1] = $row[0]['firstname'];

            // echo ($this->data[1]);
            $this->data[2] = $row[0]['lastname'];
            
            $user_id = $row[0]['id'];
            $_SESSION['user_id'] = $user_id;

            // echo ($this->data[2]);
        }
        else{
            self::$errors[1] = "Password Error";
            // echo 'password error';
        }
    }
    }

    public function errors(){

        if(self::$errors[0] != ''){
            return 'Email error';
        }
        elseif(self::$errors[1] != ''){
            return 'Password Error';
        }
        else{
            return '';
        }
    }
}




?>