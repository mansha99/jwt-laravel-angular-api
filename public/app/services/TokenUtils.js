app.factory('TokenUtils', function () {
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

    //======================================================================

    return obj;
});




