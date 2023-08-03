<?php 

            session_start();
            if(isset($_GET['token'])){

                $token = $_GET['token'];
                include 'connect.php';
                $sql =  $pdo-> prepare('SELECT * FROM users WHERE verify_token=:token');

                $sql->bindValue(':token',$token);
                
                 $sql->execute();

                $result = $sql->fetch(PDO::FETCH_ASSOC);

                if($result)
                {
                    $_SESSION['staus'] = "you are verfied so login";
                    header('Location: signin.php');

                }
                else{
                    $_SESSION['staus'] = "verification failded";
                    header('Location: signup.php');
                }
            }
            else{

                $_SESSION['staus'] = "Not allowed";
                header('Location: signup.php');
            }


?>