app.controller('AdminCalorieController', function ($scope, Utils, TokenUtils, UserService, AdminCalorieService, LoginService, ListUtils) {
    $scope.date_from = null;
    $scope.date_to = null;
    $scope.time_from = null;
    $scope.time_to = null;
    $scope.search = null;
    //////////////////////////////////////////////////////////
    $scope.delete_id = 0;
    $scope.message = null;
    $scope.status = null;
    $scope.view = 'list';
    $scope.page = 1;
    $scope.count = 0;
    $scope.kw = '';
    $scope.loading = false;
    $scope.list = [];
    $scope.list_user = [];

    $scope.model = {};
    $scope.errors = [];

    $scope.init = function () {
        $scope.search = false;
        $scope.date_from = Utils.getCurrentDate();
        $scope.date_to = Utils.getCurrentDate();
        $scope.time_from = Utils.getCurrentTime();
        $scope.time_to = Utils.getCurrentTime();
        $scope.read();
        $scope.readUsers();
        $scope.view = 'list';

    };
    $scope.addNew = function () {
        $scope.errors = [];
        $scope.model = {dt: Utils.getCurrentDate(), tm: Utils.getCurrentTime()};
        $scope.view = 'create';
    };
    $scope.edit = function (id) {
        $scope.errors = [];
        $scope.model = ListUtils.__find($scope.list, id);
        $scope.view = 'edit';
    };

    $scope.store = function () {
        $scope.loading = true;
        AdminCalorieService.store(Utils.toFormData($scope.model)).then(function (response) {
            $scope.loading = false;
            console.log(response);
            $scope.errors = response.data.errors;
            $scope.status = response.data.status;
            $scope.message = response.data.message;
            console.log($scope.errors);
        }, function (response) {
            $scope.loading = false;
            console.log(response);
            $scope.errors = response.data.errors;
            $scope.status = response.data.status;
            $scope.message = response.data.message;
            console.log($scope.errors);
        });
    };

    $scope.update = function () {
        $scope.loading = true;
        AdminCalorieService.update(Utils.toFormData($scope.model), $scope.model.id).then(function (response) {
            $scope.loading = false;
            console.log(response);
            $scope.errors = response.data.errors;
            $scope.status = response.data.status;
            $scope.message = response.data.message;
            console.log($scope.errors);
        }, function (response) {
            $scope.loading = false;
            console.log(response);
            $scope.errors = response.data.errors;
            $scope.status = response.data.status;
            $scope.message = response.data.message;
            console.log($scope.errors);
        });
    };

    $scope.showList = function () {
        $scope.model = {};
        $scope.message = null;
        $scope.view = 'list';
        $scope.read();
    };
    $scope.remove_display = function (id) {
        $scope.delete_id = id;
    };
    $scope.remove_confirm = function (id) {
        AdminCalorieService.remove(id).then(function (response) {
            $scope.delete_id = 0;
            $scope.read();
        });

    };
    $scope.remove_cancel = function (id) {
        $scope.delete_id = 0;
    };

    $scope.read = function () {
        $scope.loading = true;
        AdminCalorieService.read($scope.page, $scope.kw).then(function (response) {
            $scope.loading = false;
            $scope.count = Utils.recordToPage(response.data.total);
            $scope.list = response.data.data;
            $scope.message = $scope.list.length == 0 ? "No record found " : null;
        });
    };
    $scope.readUsers = function () {
        $scope.loading = true;
        UserService.readAll().then(function (response) {
            $scope.loading = false;
            $scope.list_user = response.data;
            console.log("===========================USER LIST====================");
            console.log(response);
            console.log($scope.list_user);
            
            
        });
    };
    $scope.reset = function () {
        $scope.search = false;
        $scope.date_from = Utils.getCurrentDate();
        $scope.date_to = Utils.getCurrentDate();
        $scope.time_from = Utils.getCurrentTime();
        $scope.time_to = Utils.getCurrentTime();
        $scope.page = 1;

        $scope.read();
    };
    $scope.doSearch = function () {
        $scope.search = true;
        $scope.page = 1;
        $scope.loading = true;
        AdminCalorieService.search($scope.page, $scope.date_from, $scope.date_to, $scope.time_from, $scope.time_to).then(function (response) {
            $scope.loading = false;
            $scope.count = Utils.recordToPage(response.data.total);
            $scope.list = response.data.data;
            $scope.errors = [];
            $scope.message = null;
            $scope.message = $scope.list.length == 0 ? "No record found " : null;
        }, function (response) {
            $scope.loading = false;
            $scope.list = [];
            $scope.errors = response.data.errors;
            $scope.message = response.data.message;

        });
    };
    $scope.getpage = function (n) {
        $scope.page = n;
        if ($scope.search == false)
            $scope.read();
        else
            $scope.search();
    };
    $scope.search = function () {
        $scope.page = 1;
        if ($scope.search == false)
            $scope.read();
        else
            $scope.search();

    };
    $scope.next = function () {
        if ($scope.page < $scope.count) {
            $scope.page++;
            if ($scope.search == false)
                $scope.read();
            else
                $scope.search();
        }
    };
    $scope.pre = function () {
        if ($scope.page > 1) {
            $scope.page--;
            if ($scope.search == false)
                $scope.read();
            else
                $scope.search();
        }
    };




});


