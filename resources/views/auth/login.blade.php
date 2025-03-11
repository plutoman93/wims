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
                        <div class="text-center"><img src="asset/frontend/images/logos/tech.png" alt=""
                                class="img-fluid"></a></div>
                        <div class="text-center"><img src="asset/frontend/images/logos/worksystem.png" alt=""
                                class="img-fluid"></a></div>

                        <h3 class="mt-4">ลงชื่อเข้าใช้งาน</h3>
                        <p class="mb-5">กรุณากรอกชื่อผู้ใช้และรหัสผ่าน</p>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{{ session('error') }}</li>
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}" class="login-form row">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="loginusername">ชื่อผู้ใช้</label>
                                    <input type="text" id="username" class="form-control" name="username"
                                        placeholder="กรอกชื่อผู้ใช้" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="loginPassword">รหัสผ่าน</label>
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="กรอกรหัสผ่าน" required>
                                </div>
                            </div>

                            <div class="col-md-12.5">
                                <button class="btn btn-primary" type="submit">เข้าสู่ระบบ</button>

                            </div>
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
    <!-- main js -->
    <script src="asset/frontend/js/custom.js"></script>

</body>

</html>
