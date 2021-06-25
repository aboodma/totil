
<div class="row">
  <div class="col-lg-12 pb-3">
      <div class="bg-white  shadow-sm pr-3 pl-3 pt-2 pb-2  " style="background-color: #241332 !important">
          <div class="dropdown-menu-show clearfix ">
              <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                  aria-controls="collapseExample" style="font-weight: 600
       " class=" text-white">
                  <p class="float-left m-0" style="font-size: larger"><b> <i class="fa fa-bars"></i> Menu</b> </p>
                  
              </a>

          </div>
      </div>
      <div id="collapseExample" class="bg-white rounded shadow-sm sidebar-fix collapse show  pb-2" >

          <div class="dropdown-menu-show">
              <a class="dropdown-item py-2 @if (Route::is('customer_dashboard')) active   @endif"
                  href="{{route('customer_dashboard')}} ">
                 <i class="fas fa-user mr-2"></i> {{__('Profile')}}
              </a>
              <a class="dropdown-item py-2 @if (Route::is('customer.profile')) active   @endif"
                  href="{{route('customer.profile')}} ">
                  <i class="fas fa-user-cog mr-2"></i> {{__('Profile Settings ')}}
              </a>
              <a class="dropdown-item py-2 @if (Route::is('customer.orders')) active   @endif"
                  href="{{route('customer.orders')}} ">
                  <i class="fas fa-book mr-2"></i>  {{__('My Books')}}
              </a>
              
              <a class="dropdown-item py-2 @if (Route::is('customer.myFavoritList')) active   @endif"
                  href="{{route('customer.myFavoritList')}} ">
                  <i class="fas fa-star mr-2"></i>  {{__('My Favorit Celebrates')}}
              </a>
              
          </div>
      </div>
  </div>
</div>