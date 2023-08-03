<?php 
            session_start();
           use PHPMailer\PHPMailer\PHPMailer;
           use PHPMailer\PHPMailer\Exception;
           require 'vendor/autoload.php';
    

            // resent email verification setup
            function  resend_email_to_verify($name,$email,$verify_token){
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
                $mail->Subject = "Resend Email verification from TechBuzz";
                
                $mail->isHTML(true);                                 
                $email_template = "
                    <h2>Youhave registered to TechBuzz </h2>
                    <h5>Verify you email address to login with the below given link</h5>
                    <br></br>
                    <a href='http://localhost:81/SignUp_and_SignIn/verify-email.php?token=$verify_token'>click me></a>

                
                ";

                $mail->Body = $email_template;
                $mail->send();
                echo "Mail has been sent successfully!";
            }

            if(isset($_POST['resend_email_verify_btn']))
            {

                if(!empty(trim($_POST['email'])))
                {
                    // check if user exists

                    include 'connect.php';
                    $email = $_POST['email'];
                    $sql =  $pdo-> prepare('SELECT * FROM users WHERE email=:email LIMIT 1');

                    $sql->bindValue(':email',$email);
                    
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);

                    if($result)
                    {
                        // check if the user is already verified
                        if($result['verify_status'] == 0)
                        {
                                $name = $result['name'];
                                $verify_token = $result['verify_token'];
                                resend_email_to_verify($name,$email,$verify_token);
                                $_SESSION['status'] = "Email has been sent please verify your email";
                                header('Location: signin.php');
                        }
                        // if verified send them to sigin page
                        else{
                            $_SESSION['status'] = "Your are already verified";
                            header('Location: signin.php');
                        }

                    }
                    // user doesn't exists validation 
                    else{
                        $_SESSION['status'] = "user does'nt exists please register";
                        header('Location: sigup.php');
                    }


                }
                // invalid field validation 
                else{
                    $_SESSION['status'] = "Please enter the email field";
                    header("Location: resend_email_verify_btn");
                    exit(0);
                }


            }

?>