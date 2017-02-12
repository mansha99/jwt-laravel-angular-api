app.factory('TokenUtils', function ($http, Utils) {
    var obj = {};
    obj.setToken = function (token) {
        localStorage.setItem("token", token);
    };
    obj.setRoles = function (roles) {
        localStorage.setItem("roles", JSON.stringify(roles));
    };

    //======================================================================
    obj.getToken = function () {
        var token = localStorage.getItem("token");
        return token;
    };
    obj.getRole = function () {
        //variable.constructor === Array
        var roles = localStorage.getItem("roles");
        if (roles == null || roles == '')
            return roles;
        roles = JSON.parse(roles);
        return roles[0];
    };
    obj.validate = function () {
        var u = Utils.Absolute("validateToken" );
        var token = this.getToken();
        return  $http({
            method: 'GET',
            url: u,
            headers: {'Authorization': 'Bearer ' + token}

        });

    };
    //======================================================================

    return obj;
});




