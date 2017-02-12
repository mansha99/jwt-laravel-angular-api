app.controller('CalorieController', function ($scope, Utils, TokenUtils, CalorieService, LoginService, ListUtils) {
    $scope.delete_id = 0;
    $scope.message = null;
    $scope.status = null;
    $scope.view = 'list';
    $scope.page = 1;
    $scope.count = 0;
    $scope.kw = '';
    $scope.loading = false;
    $scope.list = [];
    $scope.model = {};

    $scope.init = function () {
        $scope.read();
        $scope.view = 'list';
    };
    $scope.addNew = function () {
        $scope.errors=[];
        $scope.model = {dt: Utils.getCurrentDate(), tm: Utils.getCurrentTime()};        
        $scope.view = 'create';
    };
    $scope.edit = function (id) {
        $scope.errors=[];
        $scope.model = ListUtils.__find($scope.list, id);
        $scope.view = 'edit';
    };

    $scope.store = function () {
        $scope.loading = true;

        CalorieService.store(Utils.toFormData($scope.model)).then(function (response) {
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
        CalorieService.update(Utils.toFormData($scope.model),$scope.model.id).then(function (response) {
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
        CalorieService.remove(id).then(function (response) {
            $scope.delete_id = 0;
            $scope.read();
        });

    };
    $scope.remove_cancel = function (id) {
        $scope.delete_id = 0;
    };

    $scope.read = function () {
        $scope.loading = true;
        CalorieService.read($scope.page, $scope.kw).then(function (response) {
            $scope.loading = false;
            $scope.count = Utils.recordToPage(response.data.total);
            $scope.list = response.data.data;
        });
    };
    $scope.getpage = function (n) {
        $scope.page = n;
        $scope.read();
    };
    $scope.search = function () {
        $scope.page = 1;
        $scope.read();

    };
    $scope.next = function () {
        if ($scope.page < $scope.count) {
            $scope.page++;
            $scope.read();
        }
    };
    $scope.pre = function () {
        if ($scope.page > 1) {
            $scope.page--;
            $scope.read();
        }
    };




});


