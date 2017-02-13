<div ng-class="
    {'form-group':true,
        'has-error':errors.name.length > 0,
        'has-feedback':errors.name.length > 0}">
    <label>Name</label>
    <input class="form-control" ng-model="model.name"/>
    <span 
        ng-if="errors.name.length > 0"
        class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
    <span 
        ng-if="errors.name.length > 0">[[errors.name]]</span>
</div>
<div ng-class="
    {'form-group':true,
        'has-error':errors.email.length > 0,
        'has-feedback':errors.email.length > 0}">
    <label>Email</label>
    <input class="form-control" ng-model="model.email"/>
    <span 
        ng-if="errors.email.length > 0"
        class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
    <span 
        ng-if="errors.email.length > 0">[[errors.email]]</span>
</div>


<div   class="alert alert-warning" ng-if="message != null && message != ''">
    [[message]]
</div>