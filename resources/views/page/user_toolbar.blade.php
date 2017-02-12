<div class="row">
    <div class="col-md-12">
        <h4>            
            <form class="form-inline">
                <div class="form-group">
                    <label>
                        Calorie Management
                    </label>
<!--                    <input class="form-control" ng-model="kw"/>-->
                </div>
<!--                <button class="btn btn-info" ng-click="search()">
                    <i class="glyphicon glyphicon-search"></i>
                </button>                -->
                <a href="#" 
                   class="btn btn-sm btn-link" >
                    <img 
                        ng-class="{'hidden':loading == false}"
                        src="{{asset('ajax-loader.gif') }}"/>
                </a>

                <div class="pull-right">                    
                    <a href="#" class="btn btn-sm btn-default" ng-click="addNew()">
                        <i class="glyphicon glyphicon-plus"></i>
                    </a>


                </div>
            </form>
        </h4>
    </div>
</div>