<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>WIMS.LoginPage</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!--Favicon-->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">

    <!-- THEME CSS
 ================================================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="asset/frontend/plugins/bootstrap/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="asset/frontend/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="asset/frontend/plugins/slick-carousel/slick.css">
    <link rel="stylesheet" href="asset/frontend/plugins/slick-carousel/slick-theme.css">
    <!-- manin stylesheet -->
    <link rel="stylesheet" href="asset/frontend/css/style.css">
</head>

<body>


    <section class="login-signup section-padding">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7">
                    <div class="login">
                        {{-- <div class="text-center"><a href="https://computer.surin.rmuti.ac.th/computer/index.php"><img
                                    src="https://rmuti.ac.th/main/wp-content/uploads/2021/05/RMUTI_KORAT-e1620021467198.png"
                                    width="150" height="150" alt="image" class="img-fluid"></a></div> --}}
                                    <div class="text-center"><a href="index.html"><img src="asset/frontend/images/logos/tech.png" alt="" class="img-fluid"></a></div>
                                    <div class="text-center"><a href="index.html"><img src="asset/frontend/images/logos/worksystem.png" alt="" class="img-fluid"></a></div>

                        <h3 class="mt-4">Login Here</h3>
                        <p class="mb-5">Enter your valid mail & password</p>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}" class="login-form row">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="loginemail">Email</label>
                                    <input type="text" id="loginemail" class="form-control" name="email"
                                        placeholder="Enter mail" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="loginPassword">Password</label>
                                    <input type="password" id="loginPassword" class="form-control" name="password"
                                        placeholder="Password" required>
                                </div>
                            </div>

                            <div class="col-md-12.5">
                                <button class="btn btn-primary" type="submit">Login</button>

                            </div>
                            {{-- <div class="regis">
                                <p class="mt-3 mb-1">Not a member yet? <a href="{{ route('register') }}">Register
                                    Here</a></p>
                            <p class="mt-3 mb-1">Forgot Password<a href="{{ route('password.request') }}">Forgot
                                    Password</a></p>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- THEME JAVASCRIPT FILES
================================================== -->
    <!-- initialize jQuery Library -->
    <script src="asset/frontend/plugins/jquery/jquery.js"></script>
    <!-- Bootstrap jQuery -->
    <script src="asset/frontend/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Slick Slider -->
    <script src="asset/frontend/plugins/slick-carousel/slick.min.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
    <script src="asset/frontend/plugins/google-map/gmap.js"></script>
    <!-- main js -->
    <script src="asset/frontend/js/custom.js"></script>

</body>

</html>
