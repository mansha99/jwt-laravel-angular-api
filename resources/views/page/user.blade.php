@extends('layouts.index')
@section('content')
<div ng-controller="CalorieController" ng-init="init()">

    <div ng-show="view == 'list'">
        @include('page.user_toolbar')

        <table class="table table-striped" ng-if="list.length > 0">
            <thead>
                <tr>
                    <th>Meal</th>                    
                    <th>Calorie</th>                    
                    <th>Date</th>                    
                    <th>Time</th>                    
                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="object in list track by $index">
                  
                    <td>
                        [[object.txt]]
                    </td>
                    <td>
                        [[object.numcalories]]
                    </td>
                    <td>
                        [[object.dt]]
                    </td>
                    <td>
                        [[object.tm]]
                    </td>
                    
                    <td>
                        <a href="#" ng-click="edit(object.id)">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        &nbsp;&nbsp;
                        <a href="#" ng-click="remove_display(object.id)" class="text-danger">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                        &nbsp;&nbsp;
                        <div ng-if="object.id == delete_id">
                            <b>Confirm</b>
                            &nbsp;&nbsp;
                            <a href="#" class="text-danger" ng-click="remove_confirm(object.id)">
                                <i class="glyphicon glyphicon-ok"></i>    
                            </a>
                            &nbsp;&nbsp;
                            <a href="#" class="text-muted" ng-click="remove_cancel(object.id)">
                                <i class="glyphicon glyphicon-remove"></i>    
                            </a>

                        </div>

                    </td>

                </tr>
            </tbody>
        </table>
         @include('page.user_pagination')
    </div>
    <div ng-show="view == 'create'">
          @include('page.user_create')
    </div>
    <div ng-show="view == 'edit'">
          @include('page.user_edit')
    </div>



</div>
@endsection