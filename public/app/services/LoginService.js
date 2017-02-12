app.factory('LoginService', function ($http, Utils) {

    var service = {};
    service.doLogin = function (email, password) {
        var obj = {email: email, password: password};
        return  $http({
            method: 'POST',
            url: Utils.Absolute('authenticate'),
            data: obj
        });
    };
    service.doRegister = function (email, password, name) {
        var obj = {email: email, password: password, name: name};
        return  $http({
            method: 'POST',
            url: Utils.Absolute('register'),
            data: obj
        });
    };

    return service;
});