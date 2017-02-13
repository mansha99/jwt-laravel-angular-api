<!DOCTYPE html>
<html lang="en" ng-app="app">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Calorie Manager</title>
        <link href="{{asset("core/css/custom.css")}}" rel="stylesheet">
        <link href="{{asset("core/css/color.css")}}" rel="stylesheet">
        <link href="{{asset("core/css/mega-menu.css")}}" rel="stylesheet">
        <link href="{{asset("core/css/bootstrap.css")}}" rel="stylesheet">
        <link href="{{asset("core/css/bootstrap-theme.min.css")}}" rel="stylesheet">
        <link href="{{asset("core/css/materialize.css")}}" rel="stylesheet">
        <link href="{{asset("core/css/font-awesome.min.css")}}" rel="stylesheet">
        <link href="{{asset("core/css/owl.slider.css")}}" rel="stylesheet">
        <!--[if lt IE 9]>
        
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        
            <![endif]-->
        <script type="text/javascript" src="{{asset('core/angular.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/app.js')}}"></script>
        <!-- ------------------------------------------------------------------- -->
        <script type="text/javascript" src="{{asset('app/filters/capitalize.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/filters/range.js')}}"></script>

        <!-- ------------------------------------------------------------------- -->
        <script type="text/javascript" src="{{asset('app/services/Utils.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/services/TokenUtils.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/services/ListUtils.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/services/LoginService.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/services/CalorieService.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/services/AdminCalorieService.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/services/UserService.js')}}"></script>

        <!-- ------------------------------------------------------------------- -->
        <script type="text/javascript" src="{{asset('app/controllers/LoginController.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/controllers/AdminCalorieController.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/controllers/CalorieController.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/controllers/AdminController.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/controllers/UserController.js')}}"></script>
        <!-- ------------------------------------------------------------------- -->

    </head>
    <body ng-controller="LoginController" ng-init="init('{{Route::getFacadeRoot()->current()->uri()}}')">

        <div id="wrapper" class="wrapper">

            <div id="cp-header" class="cp-header">



                <div class="cp-logo-row">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="logo">
                                    <a href="{{url('/')}}">
                                        Calorie App
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-8">

                            </div>
                        </div>
                    </div>
                </div>



                <div class="cp-megamenu">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cp-mega-menu">
                                    <ul class="collapse main-menu">
                                        <li>
                                            <a href="{{url("/")}}">Home</a>                                            
                                        </li>
                                        <li ng-if="hasRole('user')">
                                            <a href="{{url('page/user')}}" >Calorie Manager</a>                                            
                                        </li>
                                        <li ng-if="hasRole('admin')">
                                            <a href="{{url('page/admin')}}" >Calorie Manager</a>                                            
                                        </li>
                                        <li ng-if="hasRole('manager') || hasRole('admin')">
                                            <a href="{{url('page/manager')}}" >Users</a>                                            
                                        </li>
                                        <li ng-if="user != null">
                                            <a href="#" ng-click="doLogout()">Logout</a>                                            
                                        </li>

                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>





            <div class="main-content" style="padding: 10px;min-height: 600px">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            @yield('content')
                        </div><!-- 8 -->



                    </div>

                </div>
            </div>
            <footer id="footer" class="footer">

                <!--    <div class="footer-two footer-widgets">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="widget form-widget">
                                        <h3>Stay connected</h3>
                                        <div class="cp-widget-content">
                                            <form class="material">
                                                <div class="input-group">
                                                    <input type="text" name="name" placeholder="Name" required>
                                                    <input type="email" name="email" placeholder="Email Address" required>
                                                    <input type="text" name="subject" placeholder="Subject">
                                                    <textarea name="message" placeholder="Message"></textarea>
                                                </div>
                                                <button class="btn btn-submit waves-effect waves-button" type="submit">Submit <i class="fa fa-angle-right"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="widget twitter-widget">
                                        <h3>Latest Tweets</h3>
                                        <div class="cp-widget-content">
                                            <ul class="tweets">
                                                <li><a href="#">@nelson.doe</a>
                                                    <div class="tweets_txt">Nunc nisl tortor, pretium quis magna a, egestas laoreet lectus <span>themeforest.net/item/materialmag</span></div>
                                                </li>
                                                <li><a href="#">@nelson.doe</a>
                                                    <div class="tweets_txt">Proin ipsum elit, varius eu tempor sit amet, rutrum a justo neque eget <span>themeforest.net/item/materialmag</span></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="widget contact-widget">
                                        <h3>Contact Info</h3>
                                        <div class="cp-widget-content">
                                            <address>
                                                <ul>
                                                    <li> <i class="fa fa-university"></i>
                                                        <p>The Material Magazine Building,
                                                            123 South Road, Industrial Avenue, 1234 New York, U.S.A.</p>
                                                    </li>
                                                    <li> <i class="fa fa-phone"></i>
                                                        <p> Phone: 0123 456 7890<br>
                                                            Fax: 0800 080 1234 </p>
                                                    </li>
                                                    <li> <i class="fa fa-skype"></i>
                                                        <p> Skype: +12 8564 232 </p>
                                                    </li>
                                                    <li> <i class="fa fa-envelope-o"></i>
                                                        <p> Email: <a href="/cdn-cgi/l/email-protection#1871767e775875796c7d6a71797475797f367b7775">info@materialmag.com</a> </p>
                                                    </li>
                                                    <li> <i class="fa fa-globe"></i>
                                                        <p> <a href="#">www.materialmag.com</a> </p>
                                                    </li>
                                                </ul>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-three">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="footer-logo"><img src="images/footer-logo.png" alt=""></div>
                                </div>
                                <div class="col-md-6">
                                    <ul class="footer-social">
                                        <li> <a href="#"><i class="fa fa-twitter"></i></a> </li>
                                        <li> <a href="#"><i class="fa fa-facebook"></i></a> </li>
                                        <li> <a href="#"><i class="fa fa-pinterest"></i></a> </li>
                                        <li> <a href="#"><i class="fa fa-linkedin"></i></a> </li>
                                        <li> <a href="#"><i class="fa fa-google-plus"></i></a> </li>
                                        <li> <a href="#"><i class="fa fa-youtube"></i></a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>-->
                <div class="footer-four">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p>
                                    All Rights Reserved 2017 
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>



    </body>
</html>
