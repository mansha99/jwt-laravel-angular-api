app.factory('Utils', function () {
    var service = {};
    service.Absolute = function (url) {
        return 'http://' + location.host + '/' + url;
    };
    return service;
});