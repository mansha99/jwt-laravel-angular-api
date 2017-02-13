app.factory('CalorieService', function ($http, Utils, TokenUtils) {
    var service = {};
    service.entity = "calorie";
      service.daySummary = function () {
        var u = Utils.Absolute(this.entity + "/daySummary");
        var token = TokenUtils.getToken();
        return $http({
            url: u,
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token}
        });
    };
    service.read = function (page) {
        var u = Utils.Absolute(this.entity + "?page=" + page);
        var token = TokenUtils.getToken();
        return $http({
            url: u,
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token}
        });
    };
    service.search = function (page, date_from, date_to, time_from, time_to) {
        var u = Utils.Absolute(this.entity + "/search?page=" + page+"&date_from="+date_from+"&date_to="+date_to+"&time_from="+time_from+"&time_to="+time_to);
        var token = TokenUtils.getToken();
        return $http({
            url: u,
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + token}
        });
    };
    service.store = function (model) {
        var u = Utils.Absolute(this.entity + "");
        var token = TokenUtils.getToken();
        return  $http({
            method: 'POST',
            url: u,
            data: model,
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined, 'Authorization': 'Bearer ' + token}

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
    service.remove = function (id) {
        var fd = new FormData();
        fd.append("_method", "DELETE");
        var u = Utils.Absolute(this.entity + "/" + id);
        var token = TokenUtils.getToken();
        return $http({
            url: u,
            method: 'POST',
            data: fd,
            headers: {'Content-Type': undefined, 'Authorization': 'Bearer ' + token}

        });
    };

    return service;
});
