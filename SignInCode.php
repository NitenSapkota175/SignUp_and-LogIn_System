<?php 
            session_start();
            if(isset($_POST['SignUpNoW'])){

                if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))){
                    include 'connect.php';

                    $email = $_POST['email'];

                    $sql =  $pdo-> prepare('SELECT * FROM users WHERE email=:email LIMIT 1');

                    $sql->bindValue(':email',$email);
                    
                    $sql->execute();
                    $result = $sql->fetch(PDO::FETCH_ASSOC);
                    // check if user exists 
                    if($result){


                                
                               

                                if($result['verify_status'] == 1){

                                            $og_password = $result['password'];

                                            $Entered_password = md5($_POST['password']);

                                           

                                            if($og_password === $Entered_password)
                                            {
                                                $_SESSION['authenticated'] = TRUE;
                                                $_SESSION['auth_user'] = [
                                                    'username' => $result['name'],
                                                    'email' => $result['email']


                                                ];

                                                $_SESSION['status'] = "You are logged in successfully";
                                                header('Location:dashboard.php');

                                            }
                                            else{
                                                $_SESSION['status'] = "Password invalid";
                                                header("Location:signin.php");

                                            }


                            }
                            else{
                                $_SESSION['status'] = "Your email is not verified , please verify your email";
                                header("Location:signin.php");
                            }

                }
                else{
                        $_SESSION['status'] = "User doesn't exists with the entered Credentials";
                        header("Location:signin.php");
                }

                    
                }

                else{
                    $_SESSION['status'] = "All fields are mandatory";
                    header('Location:sigin.php');
                }

              
            }


?>