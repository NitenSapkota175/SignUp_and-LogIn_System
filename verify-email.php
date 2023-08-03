<?php 

            session_start();
            if(isset($_GET['token'])){

                $token = $_GET['token'];
                include 'connect.php';
                $sql =  $pdo-> prepare('SELECT * FROM users WHERE verify_token=:token');

                $sql->bindValue(':token',$token);
                
                 $sql->execute();

                $result = $sql->fetch(PDO::FETCH_ASSOC);

                if($result['verify_status'] == 0)
                {
                    $verify_status = 1;
                    $sql =  $pdo-> prepare('UPDATE users SET verify_status=:verify_status WHERE verify_token=:token');

                    $sql->bindValue(':verify_status',$verify_status);
                    $sql->bindValue(':token',$token);
                    
                     $sql->execute();


                    $_SESSION['status'] = "you are verfied so login";
                    header('Location: signin.php');

                }
                else{
                    $_SESSION['status'] = "email already verified please login";
                    header('Location: signin.php');
                }
            }
            else{

                $_SESSION['status'] = "Not allowed";
                header('Location: signup.php');
            }


?>