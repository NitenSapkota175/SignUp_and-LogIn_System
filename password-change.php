<?php 
    session_start();
    $page_title = "Signin";
    include_once 'includes/header.php' ;
    include_once 'includes/navbar.php';
    $email = $_GET['email'];
?> 

    <div class="py-5">
        <div class="conatiner">
            <div class="row justify-content-center">
                <div class="col-md-6">
                <div class="alert">
                        <?php 
                                if(isset($_SESSION['status'])) { ?>
                                
                                    <div class="alert alert-success">
                                     <h5><?= $_SESSION['status']; ?></h5>
                                    

                                    </div>
                                
                                
                        <?php unset($_SESSION['status']); }?>
                    </div>
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Rest your password</h5>
                        </div>
                        <div class="card-body">
                                <form action="password-reset-code.php" method="POST">
                                   
                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <input type="email" name ="email" value ="<?php echo $email; ?>" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">New password</label>
                                        <input type="password" name ="password"class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Confirm Passowrd</label>
                                        <input type="password" name ="confirm_password"class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="sumbit" name="update-password" class="btn btn-primary">Rest Password</button>
                                        
                                    </div>
                                </form>
                                <hr>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




<?php include_once 'includes/footer.php' ?>