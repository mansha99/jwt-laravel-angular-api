 <div  class="alert alert-warning" ng-if="list.length <= 0 && !loading">
     No record found
 </div>
        <nav ng-if="list.length >0">
            <ul class="pagination pagination-sm">
                <li ng-class="{'disabled':page <= 1}">
                    <a href="#" aria-label="Previous" ng-click="pre()">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li 
                    ng-repeat="n in []| range:count:page"
                    ng-class="{'active':page == n}">
                    <a href="#"  ng-click="getpage(n)">
                        [[n]]
                    </a>
                </li>

                <li ng-class="{'disabled':page >= count}">
                    <a href="#" aria-label="Next"  ng-click="next()">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <li >
                    <span style="cursor: auto;padding-left: 10px;margin-top: 5px;border-top: none;;border-right:  none;;border-bottom:  none">
                        Showing <b>[[page]]</b> of <b>[[count]]</b>
                    </span>
                </li>
            </ul>
           
        </nav>
    