app.factory('ListUtils', function ($http, Utils) {
    var service = {};    
    service.__update = function (list_data, model) {
        for (k in list_data) {
            var object = list_data[k];
            if (object.id == model.id) {
                list_data[k] = model;
            }
        }
    };
    //==================================================================== 
    service.__remove = function (list_data, model) {
        for (k in list_data) {
            var object = list_data[k];
            if (object.id == model.id) {
                list_data.splice(k, 1);            
            }
        }
    };
    //====================================================================
    service.__add = function (list_data, model) {
      
        list_data.unshift(model);
    };
    service.__find = function (list, id) {
        for (k in list) {
            var v = list[k];
            if (v.id == id)
                return v;
        }
        return null;
    };
    //======================================================================
    return service;
});


