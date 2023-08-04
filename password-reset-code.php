<?php 
        session_start();
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        require 'vendor/autoload.php';
 

         // resent email verification setup
         function  send_passwordRest_Mail($name,$email,$verify_token){
             $mail = new PHPMailer(true);
             
            
             // $mail->SMTPDebug = 2;                                      
             $mail->isSMTP();                                           
             $mail->Host       = 'smtp.gmail.com;';                   
             $mail->SMTPAuth   = true;                            
             $mail->Username   = 'pointers200@gmail.com';                
             $mail->Password   ='psykvjhdodqqrlkm';                       
             $mail->SMTPSecure = 'tls';                             
             $mail->Port       = 587; 
         
             $mail->setFrom('pointers200@gmail.com', $name);          
             $mail->addAddress($email);
             $mail->Subject = "Passowrd ";
             
             $mail->isHTML(true);                                 
             $email_template = "
                 <h2>TechBuzz </h2>
                 <h5>You have receiving this email because we recieved password reset request for your account</h5>
                 <br></br>
                 <a href='http://localhost:81/SignUp_and_SignIn/password-change.php?token=$verify_token&email=$email'>Click me></a>

             
             ";

             $mail->Body = $email_template;
             $mail->send();
            
         }
        

        if(isset($_POST['password_reset_link']))
        {
                include 'connect.php';

                $email = $_POST['email'];
            
                $sql = $pdo->prepare('SELECT * FROM users WHERE email=:email LIMIT 1');
            
                $sql->bindValue(':email',$email);
                
                $sql->execute();

                $result = $sql->fetch(PDO::FETCH_ASSOC);

                

                if($result)
                {
                        $token = $result['verify_token'];
                        $name = $result['name'];
                        send_passwordRest_Mail($name,$email,$token);
                        $_SESSION['status'] = 'we have sent you the password reset link ,check your email';
                        header('Location: signin.php');
                        

                }
                else{
                    $_SESSION['status'] = 'email not found';
                    header('Location: password-reset.php');
                }
        }


        if(isset($_POST['update-password']))
        {
                    
            include 'connect.php';

            $email = $_POST['email'];
        
            $sql = $pdo->prepare('SELECT * FROM users WHERE email=:email LIMIT 1');
        
            $sql->bindValue(':email',$email);
            
            $sql->execute();

            $result = $sql->fetch(PDO::FETCH_ASSOC);

            

            if($result)
            {
                $token = $result['verify_token'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];

                if(!empty($password)){
                   if($password == $confirm_password)
                   {

                        
                        $sql = $pdo->prepare('UPDATE users SET password=:password WHERE email=:email');
                        $sql->bindValue(':password',md5($password));
                        $sql->bindValue(':email',$email);

                        $sql->execute();

                        $_SESSION['status'] = "Your password is successfully reset";
                        header("Location: signin.php");

                   }
                   else{

                        $_SESSION['status'] = 'password does not match with confirm password';
                        header("Location: password-change.php?token=$token&email=$email");

                   }

                }
                else{

                    $_SESSION['status'] = 'password field should not be empty';
                    header("Location: password-change.php?token=$token&email=$email");

                }
                    

            }
            else{
                $_SESSION['status'] = 'email not found';
                header("Location: password-change.php?token=$token&email=$email");
            }

        }

?>