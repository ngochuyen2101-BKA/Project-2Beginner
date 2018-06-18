<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>2Beginner</title>
    <link href="Image/hi.png" rel="icon" type="image/ico">
    <!-- Bootstrap CSS + jQuery library -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/vegas.min.css">
    <link rel="stylesheet" href="css/style3.css">
    <link href='https://fonts.googleapis.com/css?family=Rajdhani:400,500,700' rel='stylesheet' type='text/css'>
    <script src="js/jquery.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/md5.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/vegas.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<!-- home section -->
<section id="home">
    <div class="container">
        <div class="row">

            <div class="col-md-offset-2 col-md-8 col-sm-12">
                <div class="home-thumb">
                    <h1 class="wow fadeInUp" data-wow-delay="0.4s">Hello, we are 2Beginner</h1>
                    <h3 class="wow fadeInUp" data-wow-delay="0.6s">We are almost <strong>ready to help</strong> you <strong>improve your English</strong> skills!</h3>
                    <a href="" id="goabout" class="btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs" data-wow-delay="0.8s">About us</a>
                    <a onclick="clickbegin()" class="btn btn-lg btn-success smoothScroll wow fadeInUp" data-wow-delay="1.0s">Let's begin</a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- about section -->
<section id="about">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-12">
                <img src="Image/about.png" class="img-responsive wow fadeInUp" alt="About">
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="about-thumb">
                    <div class="section-title">
                        <h1 class="wow fadeIn" id="aboutid" data-wow-delay="0.2s">about us</h1>
                        <h3 class="wow fadeInUp" data-wow-delay="0.4s">2Beginner is a website to practice English</h3>
                    </div>
                    <div class="wow fadeInUp" data-wow-delay="0.6s" style="text-align: justify;">
                        <p>Why is 2Beginner? Because this is a website which is suitable for beginner. With 2Beginner, you can learn English effectively whenever you want. Our lessons cost totally no fee. But they are not free. You must to spend your time and effort if you want to get a good result. 2Beginner is friendly with learner: No adcasotisement, use easily, no collecting user's information. We have developed a learning path for learners.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- feature section -->
<section id="feature">
    <div class="container">
        <div class="row">

            <svg preserveAspectRatio="none" viewBox="0 0 100 102" height="100" width="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="svgcolor-light">
                <path d="M0 0 L50 100 L100 0 Z"></path>
            </svg>

            <div class="col-md-4 col-sm-6">
                <div class="media wow fadeInUp" data-wow-delay="0.4s">
                    <div class="media-object media-left">
                        <i class="glyphicon glyphicon-headphones"></i>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading">Listening</h2>
                        <p>We have <span id="listenlevels"></span> levels. In each lesson, learners type whatever they listened. This is a good way to improve learner's listening skill.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="media wow fadeInUp" data-wow-delay="0.8s">
                    <div class="media-object media-left">
                        <i class="glyphicon glyphicon-bullhorn"></i>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading">Speaking</h2>
                        <p>We have <span id="speaklevels"></span> levels. Learner can practice speaking through many topics. Learners will also learn IPA.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-8">
                <div class="media wow fadeInUp" data-wow-delay="1.2s">
                    <div class="media-object media-left">
                        <i class="glyphicon glyphicon-book"></i>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading">Vocabulary</h2>
                        <p>Our website supports searching words in the dictionary. Then learners can save them in your list words. We will prompt learners to learn them.</p>
                    </div>
                </div>
            </div>

            <div class="clearfix text-center col-md-12 col-sm-12">
                <a href="" class="btn btn-default smoothScroll">What we have</a>
            </div>

        </div>
    </div>
</section>

<!-- contact section -->
<section id="contact">
    <div class="container">
        <div class="row">

            <div class="col-md-offset-2 col-md-8 col-sm-12">
                <div class="section-title">
                    <h1 class="wow fadeInUp" data-wow-delay="0.3s">Sign up</h1>
                    <p class="wow fadeInUp" data-wow-delay="0.6s">To get our lessons, please create a account. It's free. Let us help you improve your English.</p>
                </div>
                <div class="contact-form wow fadeInUp" data-wow-delay="1.0s">
                    <div id="contact-form">
                        <div class="col-sm-12">
                            <input id="name" type="text" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" id="email" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <input id="password" type="password" class="form-control" placeholder="Your Password">
                        </div>
                        <div class="col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8">
                            <input type="button" class="form-control submit text-center" id="submit" value="SEND INFO" onclick="regis()">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- footer section -->
<footer>
    <div class="container">
        <div class="row team">

            <svg class="svgcolor-light" preserveAspectRatio="none" viewBox="0 0 100 102" height="100" width="100%" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0 L50 100 L100 0 Z"></path>
            </svg>

            <div class="col-md-4 col-sm-6">
                <h2>our team</h2>
                <div class="wow fadeInUp" data-wow-delay="0.3s">
                    <p>A project of team 3. Team members:</p>
                    <p>Trinh Minh Thuy - 20156568</p>
                    <p>Nguyen Thi Ngoc Huyen - 20156292</p>
                    <p>Le Thi Hong - 20155669</p>
                    <p>Vu Hong Thang - 20156510</p>
                </div>
            </div>

            <div class="col-md-1 col-sm-1"></div>

            <div class="col-md-4 col-sm-5">
                <h2>Contact</h2>
                <p class="wow fadeInUp" data-wow-delay="0.6s">
                    Contact us for support<br>
                    Email: 2beginnervn@gmail.com<br>
                    Ha Noi University of Science and Technology
                </p>
            </div>

        </div>
    </div>
</footer>

<!-- modal -->
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-popup">
            <div class="modal-header">
                <button type="button" class="close" id="close1" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 class="modal-title">Welcome to 2Beginner</h2>
            </div>
            <form>
                <input type="text" class="form-control" id="email1" placeholder="Email">
                <input type="password" class="form-control" id="password1" placeholder="Password">
                <input type="button" class="form-control" id="login" value="Log in" onclick="log_in()">
            </form>
            <p>Don't have an account? <a onclick = "sign()">Sign Up</a></p>
            <p>or <a onclick="openreset()">Reset password</a></p>
        </div>
    </div>
</div>

<!-- Back top -->
<a href="#back-top" class="go-top"><span class="glyphicon glyphicon-chevron-up"></span></a>

</body>
</html>

