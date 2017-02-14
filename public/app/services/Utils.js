app.factory('Utils', function () {
    var service = {};
    service.Absolute = function (url) {
        return 'http://' + location.host + '/' + url;
        //return "http://localhost/manish-sharma/public/index.php/" + url;
    };
    service.param = function (param, dummyPath) {
        var sPageURL = dummyPath || window.location.search.substring(1),
                sURLVariables = sPageURL.split(/[&||?]/),
                res;
        res = null;
        for (var i = 0; i < sURLVariables.length; i += 1) {
            var paramName = sURLVariables[i],
                    sParameterName = (paramName || '').split('=');

            if (sParameterName[0] === param) {
                res = sParameterName[1];
            }
        }

        return res;
    };
    service.recordToPage = function (record) {
        var x = 1 + ((record - 1) / 10);
        return (~~x);
    };
    service.toFormData = function (model) {
        var form_data = new FormData();
        for (var key in model) {
            form_data.append(key, model[key]);
        }
        return form_data;
    };
    service.getCurrentDate = function () {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!

        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        return  mm + '-' + dd + '-' + yyyy;

    };
    service.getCurrentTime = function () {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        if (h < 10) {
            h = '0' + h;
        }
        if (m < 10) {
            m = '0' + m;
        }


        return h + ":" + m;

    };
    return service;
});