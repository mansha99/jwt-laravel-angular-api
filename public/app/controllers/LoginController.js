app.controller('LoginController', function ($scope, Utils, TokenUtils, LoginService) {
    $scope.form = 'login';
    $scope.email = '';
    $scope.password = '';
    $scope.reg_email = '';
    $scope.reg_password = '';
    $scope.reg_name = '';
    $scope.message = null;
    $scope.errors = [];
    $scope.loading = false;
    $scope.action = null;
    $scope.roles = null;
    $scope.user = null;
    $scope.init = function (action) {
        $scope.action = action;

        $scope.validateToken();


    };
    $scope.doLogin = function () {
        $scope.loading = true;
        LoginService.doLogin($scope.email, $scope.password).then(function (response) {
            $scope.loading = false;
            console.log('--------------------------------SUCCESS--------------------------');
            console.log(response);
            TokenUtils.setToken(response.data.token);
            TokenUtils.setRoles(response.data.roles);
            document.location = Utils.Absolute('page/' + TokenUtils.getRole());

        }, function (response) {
            $scope.loading = false;
            console.log('--------------------------------ERROR--------------------------');
            console.log(response);
            $scope.message = response.data.message;
            $scope.errors = response.data.errors;


        });
    };
    $scope.doRegister = function () {
        $scope.loading = true;
        LoginService.doRegister($scope.reg_email, $scope.reg_password, $scope.reg_name).then(function (response) {
            $scope.loading = false;
            console.log('--------------------------------SUCCESS : R--------------------------');
            console.log(response);
            $scope.message = response.data.message;
            $scope.errors = [];
            $scope.loading = false;
            $scope.showLogin();

        }, function (response) {
            $scope.loading = false;
            console.log('--------------------------------ERROR : R--------------------------');
            console.log(response);
            $scope.message = response.data.message;
            $scope.errors = response.data.errors;


        });
    };

    $scope.showLogin = function () {
        $scope.form = 'login';
    }
    $scope.showForm = function (form) {
        $scope.message = null;
        $scope.errors = [];
        $scope.loading = false;

        $scope.form = form;

    };
    $scope.doLogout = function () {
        LoginService.doLogout().then(function (response) {
            console.log('--------------------------------SUCCESS--------------------------');
            console.log(response);
            TokenUtils.setToken("none");
            $scope.user = null;
            document.location = Utils.Absolute("/");

        }, function (response) {
            $scope.loading = false;
            console.log('--------------------------------ERROR--------------------------');
            console.log(response);
            $scope.user = null;
            document.location = Utils.Absolute("/");


        });
    };
    $scope.validateToken = function () {
        TokenUtils.validate().then(function (response) {
            console.log('--------------------------------SUCCESS--------------------------');
            console.log(response);
            $scope.user = response.data.user;
            $scope.roles = response.data.roles;
            if ($scope.action == "" || $scope.action == "/") {
                if ($scope.hasRole('admin')) {
                    document.location = Utils.Absolute("/page/admin");
                }
                if ($scope.hasRole('user')) {
                    document.location = Utils.Absolute("/page/user");
                }
                if ($scope.hasRole('manager')) {
                    document.location = Utils.Absolute("/page/manager");
                }

            }
            if ($scope.action == "page/user" && !$scope.hasRole('user')) {
                document.location = Utils.Absolute("/");
            }

            if ($scope.action == "page/admin" && !$scope.hasRole('admin')) {
                document.location = Utils.Absolute("/");
            }
            if ($scope.action == "page/manager") {
                if (!$scope.hasRole('manager') && !$scope.hasRole('admin')) {
                    document.location = Utils.Absolute("/");
                }
            }



        }, function (response) {
            $scope.loading = false;
            console.log('--------------------------------ERROR--------------------------');
            console.log(response);
            $scope.user = null;
            $scope.role = null;

        });
    };
    $scope.hasRole = function (role) {
        return $scope.roles != null && $scope.roles.indexOf(role) != -1;
    };

});


