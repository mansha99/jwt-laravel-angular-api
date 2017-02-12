<html ng-app="app">
    <head>
        <link rel="stylesheet" type="text/css" href="{{asset('core/css/bootstrap.css')}}"/>
        <style type="text/css">
            body {
                padding-top: 90px;
            }
            .panel-login {
                border-color: #ccc;
                -webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
                -moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
                box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
            }
            .panel-login>.panel-heading {
                color: #00415d;
                background-color: #fff;
                border-color: #fff;
                text-align:center;
            }
            .panel-login>.panel-heading a{
                text-decoration: none;
                color: #666;
                font-weight: bold;
                font-size: 15px;
                -webkit-transition: all 0.1s linear;
                -moz-transition: all 0.1s linear;
                transition: all 0.1s linear;
            }
            .panel-login>.panel-heading a.active{
                color: #029f5b;
                font-size: 18px;
            }
            .panel-login>.panel-heading hr{
                margin-top: 10px;
                margin-bottom: 0px;
                clear: both;
                border: 0;
                height: 1px;
                background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
                background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
                background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
                background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
            }
            .panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
                height: 45px;
                border: 1px solid #ddd;
                font-size: 16px;
                -webkit-transition: all 0.1s linear;
                -moz-transition: all 0.1s linear;
                transition: all 0.1s linear;
            }
            .panel-login input:hover,
            .panel-login input:focus {
                outline:none;
                -webkit-box-shadow: none;
                -moz-box-shadow: none;
                box-shadow: none;
                border-color: #ccc;
            }
            .btn-login {
                background-color: #59B2E0;
                outline: none;
                color: #fff;
                font-size: 14px;
                height: auto;
                font-weight: normal;
                padding: 14px 0;
                text-transform: uppercase;
                border-color: #59B2E6;
            }
            .btn-login:hover,
            .btn-login:focus {
                color: #fff;
                background-color: #53A3CD;
                border-color: #53A3CD;
            }
            .forgot-password {
                text-decoration: underline;
                color: #888;
            }
            .forgot-password:hover,
            .forgot-password:focus {
                text-decoration: underline;
                color: #666;
            }

            .btn-register {
                background-color: #1CB94E;
                outline: none;
                color: #fff;
                font-size: 14px;
                height: auto;
                font-weight: normal;
                padding: 14px 0;
                text-transform: uppercase;
                border-color: #1CB94A;
            }
            .btn-register:hover,
            .btn-register:focus {
                color: #fff;
                background-color: #1CA347;
                border-color: #1CA347;
            }
            .validation-error{
                color:#c43333;
            }
        </style>
        <script type="text/javascript" src="{{asset('core/angular.min.js')}}">
        </script>
        <script type="text/javascript" src="{{asset('app/app.js')}}">
        </script>
        <script type="text/javascript" src="{{asset('app/services/Utils.js')}}">
        </script>
        <script type="text/javascript" src="{{asset('app/services/TokenUtils.js')}}">
        </script>
        <script type="text/javascript" src="{{asset('app/services/LoginService.js')}}">
        </script>

        <script type="text/javascript" src="{{asset('app/controllers/LoginController.js')}}">
        </script>



    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login" ng-controller="LoginController" ng-init="init('{{Route::getFacadeRoot()->current()->uri()}}')">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="#" 
                                       ng-class="{'active':form == 'login'}" 
                                       ng-click="showForm('login')"
                                       id="login-form-link">Login</a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="#" 
                                       ng-class="{'active':form == 'register'}" 
                                       ng-click="showForm('register')"                                       
                                       id="register-form-link">Register</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="login-form" action="#" method="post" role="form" ng-show="form == 'login'">
                                        <div ng-class="{'form-group':true,'has-error':errors.email.length > 0,'has-feedback':errors.email.length > 0}">
                                            <input 
                                                type="text" 
                                                name="email"  
                                                tabindex="1" 
                                                class="form-control" 
                                                placeholder="Email" ng-model="email">
                                            <span  ng-if="errors.email.length > 0" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                            <span class="validation-error" ng-if="errors.email.length > 0">[[errors.email]]</span>
                                        </div>
                                        <div ng-class="{'form-group':true,'has-error':errors.password.length > 0,'has-feedback':errors.password.length > 0}">
                                            <input 
                                                type="password" 
                                                name="password" 
                                                id="password" 
                                                tabindex="2" 
                                                class="form-control" 
                                                ng-model="password"
                                                placeholder="Password">
                                            <span  ng-if="errors.password.length > 0" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                            <span class="validation-error" ng-if="errors.password.length > 0">[[errors.password]]</span>
                                        </div>
                                        <div ng-class="{'form-group':true}" ng-if="message != null">
                                            <div class="alert alert-warning">[[message]]</div>
                                        </div>
                                        <button
                                            type="button" 
                                            tabindex="4" 
                                            ng-disabled="loading == true" 
                                            ng-click="doLogin()"
                                            class="btn btn-sm btn-success">
                                            Log In
                                        </button> 
                                        <img 
                                            ng-show="loading == true" 
                                            src="{{asset('ajax-loader.gif')}}"/>

                                    </form>
                                    <form id="register-form" action="#" method="post" role="form" ng-show="form == 'register'">
                                        <div ng-class="{'form-group':true,'has-error':errors.name.length > 0,'has-feedback':errors.name.length > 0}">
                                            <input 
                                                type="text" 
                                                name="name"  
                                                tabindex="1" 
                                                class="form-control" 
                                                placeholder="Name" ng-model="reg_name">
                                            <span  ng-if="errors.name.length > 0" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                            <span class="validation-error" ng-if="errors.name.length > 0">[[errors.name]]</span>
                                        </div>
                                        <div ng-class="{'form-group':true,'has-error':errors.email.length > 0,'has-feedback':errors.email.length > 0}">
                                            <input 
                                                type="text" 
                                                name="email"  
                                                tabindex="1" 
                                                class="form-control" 
                                                placeholder="Email" ng-model="reg_email">
                                            <span  ng-if="errors.email.length > 0" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                            <span class="validation-error" ng-if="errors.email.length > 0">[[errors.email]]</span>
                                        </div>
                                        <div ng-class="{'form-group':true,'has-error':errors.password.length > 0,'has-feedback':errors.password.length > 0}">
                                            <input 
                                                type="password" 
                                                name="password" 
                                                id="password" 
                                                tabindex="2" 
                                                class="form-control" 
                                                ng-model="reg_password"
                                                placeholder="Password">
                                            <span  ng-if="errors.password.length > 0" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                                            <span class="validation-error" ng-if="errors.password.length > 0">[[errors.password]]</span>
                                        </div>
                                        <div ng-class="{'form-group':true}" ng-if="message != null">
                                            <div class="alert alert-warning">[[message]]</div>
                                        </div>
                                        <button
                                            type="button" 
                                            tabindex="4" 
                                            ng-disabled="loading == true" 
                                            ng-click="doRegister()"
                                            class="btn btn-sm btn-info">
                                            Create Account
                                        </button> 
                                        <img 
                                            ng-show="loading == true" 
                                            src="{{asset('ajax-loader.gif')}}"/>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
