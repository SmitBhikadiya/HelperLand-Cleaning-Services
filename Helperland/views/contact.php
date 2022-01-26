<?php
session_start();
include("../config.php");
if (isset($_SESSION["userdata"])) {
    $userdata = $_SESSION["userdata"];
    //print_r($userdata);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./static/css/footer.css">
    <link rel="stylesheet" href="./static/css/header1.css">
    <link rel="stylesheet" href="./static/css/modal.css">
    <link rel="stylesheet" href="./static/css/contact.css">
    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Contact Us</title>
</head>

<body>

<?php 
        include("./includes/login-modal.php");
        include("./includes/forgotpsw-modal.php");
        include("./includes/header.php")
    ?>

    <div id="main">
        <div class="header-image"></div>

        <section id="section-contactus">
            <div class="contactus-services">
                <h1>Contact Us</h1>
                <div class="h-line">
                    <img src="./static/images/line.png" alt="" class="line">
                    <img src="./static/images/star.png" alt="" class="star">
                    <img src="./static/images/line.png" alt="" class="line">
                </div>
                <div class="contact-list row">
                    <div class="c-list col-xl-4 col-md-4">
                        <div class="c-img">
                            <img src="./static/images/location-pin.png">
                        </div>
                        <div class="c-title">
                            <p>1111 Lorem ipsum text 100,<br> Lorem ipsum AB</p>
                        </div>
                    </div>
                    <div class="c-list col-xl-4 col-md-4">
                        <div class="c-img">
                            <img src="./static/images/phone-call.png" alt="">
                        </div>
                        <div class="c-title">
                            <p>+49 (40) 123 56 7890<br>+49 (40) 987 56 0000</p>
                        </div>
                    </div>
                    <div class="c-list col-xl-4 col-md-4">
                        <div class="c-img">
                            <img src="./static/images/email.png" alt="">
                        </div>
                        <div class="c-title">
                            <p>info@helperland.com</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        
        <hr class="hr-sepretor">

        <section id="section-contactform" class="contact-form">
            <div class="form-title">
                <h1>Get in touch with us</h1>
            </div>
            <div class="c-form">
                <form action="#" method="post" accept-charset="utf-8">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                <input class="form-control" name="firstname" placeholder="Firstname" type="text"
                                    required autofocus />
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                <input class="form-control" name="lastname" placeholder="Lastname" type="text"
                                    required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">+49</div>
                                    </div>
                                    <input type="number" class="form-control" id="inlineFormInputGroup"
                                        placeholder="Mobile number">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                <input class="form-control" name="email" placeholder="Email address" type="email"
                                    required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                <div class="form-group">
                                    <select id="inputState" class="form-control">
                                        <option>Subject</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <textarea style="resize:vertical;" class="form-control" placeholder="Message..."
                                    rows="6" name="comment" required></textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div class="submit-btn">
                        <button>Submit</button>
                    </div>
                </form>
            </div>
        </section>
        
    </div>

    <section id="section-map">
            <iframe allowfullscreen="" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJxzZgCD_hvkcRTC-2Pt6bXt0&amp;key=AIzaSyAag-Mf1I5xbhdVHiJmgvBsPfw7mCqwBKU"></iframe>
    </section>

    <?php include("./includes/footer.php") ?>

    <script src="./static/js/header.js"></script>
    <script src="./static/js/footer.js"></script>
    <script>
        $(document).ready(function() {

            //remove sticky class
            if (window.scrollY > 30) {
                $(".navbar").removeClass("sticky");
            }
            $(window).scroll(function() {
                if (this.scrollY > 30) {
                    $(".navbar").removeClass("sticky");
                }
            });
        });
    </script>

</body>

</html>