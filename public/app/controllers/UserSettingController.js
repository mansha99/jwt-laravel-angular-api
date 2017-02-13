app.controller('UserSettingController', function ($scope, Utils, TokenUtils, UserSettingService) {
    //////////////////////////////////////////////////////////
    $scope.message = null;
    $scope.model = {};
    $scope.errors = [];
    $scope.init = function () {
        $scope.findForUser();
    };

    $scope.update = function () {
        $scope.loading = true;
        UserSettingService.update(Utils.toFormData($scope.model), $scope.model.id).then(function (response) {
            $scope.loading = false;
            $scope.errors = [];
            $scope.message = null;
            $scope.model = response.data.model;
            $scope.$parent.daySummary();
        }, function (response) {
            $scope.loading = false;
            console.log(response);
            $scope.errors = response.data.errors;
            $scope.message = response.data.message;
            console.log($scope.errors);
        });
    };


    $scope.findForUser = function () {
        $scope.loading = true;
        UserSettingService.findForUser().then(function (response) {
            $scope.loading = false;
            $scope.model = response.data.model;
            console.log($scope.model);
        });
    };




});


