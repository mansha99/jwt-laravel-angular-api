<html ng-app="app">
    <head>
        <link rel="stylesheet" type="text/css" href="{{asset('core/css/bootstrap.css')}}"/>
        @include('welcome_style')
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
        <script type="text/javascript" src="{{asset('app/services/UserSettingService.js')}}"></script>


        <!-- ------------------------------------------------------------------- -->
        <script type="text/javascript" src="{{asset('app/controllers/LoginController.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/controllers/AdminCalorieController.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/controllers/CalorieController.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/controllers/AdminController.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/controllers/UserController.js')}}"></script>
        <script type="text/javascript" src="{{asset('app/controllers/UserSettingController.js')}}"></script>




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
                                                id="email"
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
                                            name='login'
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
