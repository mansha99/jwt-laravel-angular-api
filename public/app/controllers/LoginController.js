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
    $scope.doLogin = function () {
        $scope.loading = true;
        LoginService.doLogin($scope.email, $scope.password).then(function (response) {
            $scope.loading = false;
            console.log('--------------------------------SUCCESS--------------------------');
            console.log(response);
            TokenUtils.setToken(response.data.token);
            TokenUtils.setRoles(response.data.roles);
            document.location = Utils.Absolute(TokenUtils.getRole());

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
    $scope.init = function () {

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
});


