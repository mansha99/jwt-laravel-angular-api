app.factory('UserSettingService', function ($http, Utils, TokenUtils) {
    var service = {};
    service.entity = "usersetting";
    service.findForUser = function () {
        var u = Utils.Absolute(this.entity + "/findForUser");
        var token = TokenUtils.getToken();
        return $http({
            url: u,
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token}
        });
    };

    service.update = function (model, id) {
        model.append("_method", "PUT");
        var u = Utils.Absolute(this.entity + "/" + id);
        var token = TokenUtils.getToken();
        return  $http({
            method: 'POST',
            url: u,
            data: model,
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Authorization': 'Bearer ' + token}

        });
    };



    return service;
});
