<?php
        session_start();

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        require 'vendor/autoload.php';


        // send email fuctionality start here
       function sendmail_verify($name,$email,$verify_token){

    
 
       
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
                    $mail->Subject = "Email verification from TechBuzz";
                    
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


        // send email fuctionality ends here 


        // validating user 

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            include 'connect.php';
            if(isset($_POST['signup_btn'])){
                $name= $_POST['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $password = md5($_POST['password']);
                $confirm_password = md5($_POST['confirm_password']);
                $verify_token = md5(rand());
            
      
                // check if the user already exists or not 
                $sql =  $pdo-> prepare('SELECT * FROM users WHERE email=:email');

                $sql->bindValue(':email',$email);
                
                 $sql->execute();

                $result = $sql->fetch(PDO::FETCH_ASSOC);
                
                if($result){

                            $_SESSION['status'] = "Email already exists";
                            header('Location:signup.php');
                }
                else{

                    // check if password match
                    if(!empty($password)){
                    if($password == $confirm_password){


                    // insert user  into database

                    $statement = $pdo-> prepare("INSERT INTO users (name,	phone,email,password,verify_token) VALUES(:name,:phone,:email,:password,:verify_token)");

                    $statement->bindValue(':name',$name);
                    $statement->bindValue(':phone',$phone);
                    $statement->bindValue(':email',$email);
                    $statement->bindValue(':password',$password);
                    $statement->bindValue(":verify_token",$verify_token);
    
                    $ifSecusse = $statement->execute();
                            if($ifSecusse)
                            {

                                // sending email 

                                sendmail_verify("$name","$email","$verify_token");




                                $_SESSION['status'] = "Signup successfull! please veriy your email";
                                header('Location:signup.php');
                               
                             }
                             else{
                           
                                $_SESSION['status'] = "signup failed";
                                 header('Location:signup.php');

                      }
                   
                    
                 }

                    else{

                        $_SESSION['status'] = "Password doesn't match";
                        header('Location:signup.php');
                    }

                }
                else{

                    $_SESSION['status'] = "Password field cannot be empty";
                    header('Location:signup.php');
                }
               
               
                }
                


               
             

            }
        }
      
