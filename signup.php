<?php 
    $page_title = "SignUp";
    include_once 'includes/header.php' ;
    include_once 'includes/navbar.php';
?> 

    <div class="py-5">
        <div class="conatiner">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h5>Sign Up</h5>
                        </div>
                        <div class="card-body">
                                <form action="">
                                    <div class="form-group mb-3">
                                        <label for="">Name</label>
                                        <input type="text" name ="name"class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Phone Number</label>
                                        <input type="text" name ="phone"class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">Email</label>
                                        <input type="email" name ="email"class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="">password</label>
                                        <input type="password" name ="password"class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="">confirm password</label>
                                        <input type="password" name ="confirm_password"class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="sumbit" class="btn btn-primary">Register now</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




<?php include_once 'includes/footer.php' ?>