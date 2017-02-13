  @include('page.admin_calorie.toolbar_form')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form action="#" method="POST">
              @include('page.admin_calorie.form')            
            <button 
                type="button" 
                ng-disabled="loading == true" 
                ng-click="store()"
                class="btn btn-success btn-sm"> 
                Save
            </button>   
            <button 
                type="button" 
                ng-click="showList()"
                class="btn btn-primary-outline btn-sm">Back to List</button>   
            <img 
                ng-class="{'hidden':loading == false}"
                src="{{asset('ajax-loader.gif')}}"/>


        </form>
    </div>
</div>