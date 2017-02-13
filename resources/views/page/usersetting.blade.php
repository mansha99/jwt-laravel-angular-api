@extends('layouts.index')
@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">

        
        <form action="#" method="POST">
            <div ng-controller="UserSettingController" ng-init="init()">

                <div ng-class="{'form-group':true,
        'has-error':errors.calperday.length > 0,
        'has-feedback':errors.calperday.length > 0}">
                    <label>Calorie Per day</label>
                    <input class="form-control" ng-model="model.calperday"/>
                    <span 
                        ng-if="errors.calperday.length > 0"
                        class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                    <span 
                        ng-if="errors.calperday.length > 0">[[errors.calperday]]</span>
                </div>
                <button 
                    type="button" 
                    ng-click="update()"
                    class="btn btn-info  btn-sm"> Update</button>   

                <img 
                    ng-class="{'hidden':loading == false}"
                    src="{{asset('ajax-loader.gif')}}"/>


        </form>
    </div>
</div>
</div>
@endsection