<div ng-class="
    {'form-group':true,
        'has-error':errors.txt.length > 0,
        'has-feedback':errors.txt.length > 0}">
    <label>Meal</label>
    <input class="form-control" ng-model="model.txt"/>
    <span 
        ng-if="errors.txt.length > 0"
        class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
    <span 
        ng-if="errors.txt.length > 0">[[errors.txt]]</span>
</div>
<div ng-class="
    {'form-group':true,
        'has-error':errors.numcalories.length > 0,
        'has-feedback':errors.numcalories.length > 0}">
    <label>Number of Calories</label>
    <input class="form-control" ng-model="model.numcalories"/>
    <span 
        ng-if="errors.numcalories.length > 0"
        class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
    <span 
        ng-if="errors.numcalories.length > 0">[[errors.numcalories]]</span>
</div>
<div ng-class="
    {'form-group':true,
        'has-error':errors.dt.length > 0,
        'has-feedback':errors.dt.length > 0}">
    <label>Date</label>
    <input class="form-control" ng-model="model.dt"/>
    <span 
        ng-if="errors.dt.length > 0"
        class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
    <span 
        ng-if="errors.dt.length > 0">[[errors.dt]]</span>
</div>
<div ng-class="
    {'form-group':true,
        'has-error':errors.tm.length > 0,
        'has-feedback':errors.tm.length > 0}">
    <label>Time</label>
    <input class="form-control" ng-model="model.tm"/>
    <span 
        ng-if="errors.tm.length > 0"
        class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
    <span 
        ng-if="errors.tm.length > 0">[[errors.tm]]</span>
</div>

<div   class="alert alert-warning" ng-if="message != null && message != ''">
    [[message]]
</div>