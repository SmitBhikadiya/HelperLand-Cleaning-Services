<?php
    $err = "";
    $useremail = "";
    if (isset($_SESSION["error"])){
        $err = $_SESSION["error"][1];
        $useremail = $_SESSION["error"][0];
        unset($_SESSION["error"]);
    }
?>
<!-- Model For Login -->
<div class="modal fade" id="exampleModallogin" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title" id="staticBackdropLabel">Login to your account</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span style='color:red'><?php if(!empty($err)){
                        echo $err;
                    }?></span>
                    <form action="../controllers/UsersController.php" id="loginmodal" method="POST">
                        <div class="mb-3 form-group icon-textbox">
                            <input type="email" name="username" class="form-control" placeholder="Email" value="
                            <?php 
                                if(isset($_COOKIE['username'])){
                                    echo $_COOKIE["username"]; 
                                }else{
                                    if(!empty($useremail)){
                                        echo $useremail; 
                                    }
                                } 
                            ?>
                            ">
                            <img alt="email" src="./static/images/user.png">
                        </div>
                        <div class="mb-3 form-group icon-textbox">
                            <input type="password" name="password" class="form-control" placeholder="Password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE["password"]; } ?>">
                            <img alt="Password" src="./static/images/lock.png">
                        </div>
                        <div class="form-check mt-3 mb-3">
                            <input class="form-check-input" type="checkbox" name="rememberme" id="flexCheckChecked" <?php if(isset($_COOKIE['rememberme'])){ echo "checked"; } ?>>
                            <label class="form-check-label" for="flexCheckChecked">
                                Remember Me
                            </label>
                        </div>
                        <button class="submit-button mb-3" type="submit" name="signin">Login</button>
                        <div class="text-center mb-2"><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalfpwd" data-bs-dismiss="modal">Forgot Password</a></div>
                        <div class="text-center">Don't have an account? <a href="./userRegistration.php">Create an
                                account</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Model -->