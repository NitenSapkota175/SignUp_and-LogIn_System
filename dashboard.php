<?php 

    include 'authentication.php';
    $page_title = "Home Page";
    include_once 'includes/header.php' ;
    include_once 'includes/navbar.php';
?> 


        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <h4>User Dashboard</h4>
                        </div>
                        <div class="card-body">
                        <h4>Your are signed  in</h4>
                        <hr>
                        <h5>Username : <?php echo $_SESSION['auth_user']['username'] ?></h5>
                        <h5>Email : <?php echo $_SESSION['auth_user']['email'] ?></h5>

                        </div>
                    </div>
                
                </div>
            </div>
        </div>


<?php include_once 'includes/footer.php' ?>
