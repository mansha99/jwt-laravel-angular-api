  @include('page.user.toolbar_form')
<div class="row">
    <div class="col-md-6 col-md-offset-3">


        <form action="#" method="POST">
              @include('page.user.form') 

            <button 
                type="button" 
                ng-click="update()"
                class="btn btn-info  btn-sm"> Update</button>   
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