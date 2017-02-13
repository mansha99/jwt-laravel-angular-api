<div class="row">
    <div class="col-md-12">
        <h4 class="pull-left">            
            Calorie Management
            <form class="form-inline">
                <div class="form-group">
                    <label>
                        Date from
                    </label>
                    <input type='text' class="form-control" ng-model="date_from"/>
                </div>
                <div class="form-group">
                    <label>
                        to
                    </label>
                    <input type='text' class="form-control" ng-model="date_to"/>
                </div>
                <div class="form-group">
                    <label>
                        Time from
                    </label>
                    <input type='text' class="form-control" ng-model="time_from"/>
                </div>
                <div class="form-group">
                    <label>
                        to
                    </label>
                    <input type='text' class="form-control" ng-model="time_to"/>
                </div>
                <button type="button" class="btn btn-sm btn-info"  ng-click="doSearch()">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
                <a href="#" 
                   ng-if="search == true"
                   class="btn btn-sm btn-link" ng-click="reset()">
                    Clear
                </a>

                <a href="#" 
                   class="btn btn-sm btn-link" >
                    <img 
                        ng-class="{'hidden':loading == false}"
                        src="{{asset('ajax-loader.gif')}}"/>
                </a>
            </form>
        </h4>
        <div class="pull-right">                    
            <a href="#" class="btn btn-sm btn-default" ng-click="addNew()">
                <i class="glyphicon glyphicon-plus"></i>
            </a>


        </div>


    </div>
</div>