var app = angular.module('app', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}).config(['$httpProvider', function ($httpProvider) {
        $httpProvider.defaults.timeout = 500000;
    }]);

