<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="Content-Language" content="en">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <title>{{$title}}</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
      <meta name="description" content="This is an example dashboard created using build-in elements and components.">
      <meta name="msapplication-tap-highlight" content="no">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
      <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
      @stack('css')
      <script>
         let baseUrl = "{{url('')}}/"
         let _token = "{{csrf_token()}}"
      </script>
   </head>
   <body>
      <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
         <div class="app-header header-shadow">
            <div class="app-header__logo">
               <a href="dashboard.html">
                  <div class="logo-src"></div>
               </a>
               <div class="header__pane ml-auto">
                  <div>
                     <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                     <span class="hamburger-box">
                     <span class="hamburger-inner"></span>
                     </span>
                     </button>
                  </div>
               </div>
            </div>
            <div class="app-header__mobile-menu">
               <div>
                  <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                  <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                  </span>
                  </button>
               </div>
            </div>
            <div class="app-header__menu">
               <span>
               <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
               <span class="btn-icon-wrapper">
               <i class="fa fa-ellipsis-v fa-w-6"></i>
               </span>
               </button>
               </span>
            </div>
            <div class="app-header__content">
               <div class="app-header-right">
                  <div class="header-btn-lg pr-0">
                     <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                           <div class="widget-content-left">
                              <div class="btn-group">
                                 <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                 <img width="42" class="rounded-circle" src="{{asset('assets/images/avatars/4.jpg')}}" alt="">
                                 <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                 </a>
                                 <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                    <a href=""  tabindex="0" class="dropdown-item">My Account</a>
                                    <a href="change-password.html" tabindex="0" class="dropdown-item">Change Password</a>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <button type="button" tabindex="0" class="dropdown-item" onclick="window.location='{{route('logout')}}'">Logout</button>
                                 </div>
                              </div>
                           </div>
                           <div class="widget-content-left  ml-3 header-user-info">
                              <div class="widget-heading">
                                 {{Auth::user()->first_name.' '.Auth::user()->last_name}}
                              </div>
                           </div>
                           <div class="widget-content-right header-user-info ml-3">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
               <div class="app-header__logo">
                  <div class="logo-src"></div>
                  <div class="header__pane ml-auto">
                     <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                        </span>
                        </button>
                     </div>
                  </div>
               </div>
               <div class="app-header__mobile-menu">
                  <div>
                     <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                     <span class="hamburger-box">
                     <span class="hamburger-inner"></span>
                     </span>
                     </button>
                  </div>
               </div>
               <div class="app-header__menu">
                  <span>
                  <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                  <span class="btn-icon-wrapper">
                  <i class="fa fa-ellipsis-v fa-w-6"></i>
                  </span>
                  </button>
                  </span>
               </div>
               <div class="scrollbar-sidebar" id="leftmenu">
                  <div class="app-sidebar__inner">
                     <ul class="vertical-nav-menu">
                        <li class="app-sidebar__heading">Dashboard</li>
                        <li>
                           <a href="{{route('dashboard')}}" class="mm-active">
                           <i class="fa-solid fa-gauge metismenu-icon"></i>
                           Dashboard
                           </a>
                        </li>
                        <li>
                           <a href="{{route('user-list')}}">
                           <i class="fa-solid fa-users metismenu-icon"></i>
                           Users
                           </a>
                        </li>
                        <li>
                           <a href="#">
                           <i class="fa-solid fa-cart-shopping metismenu-icon"></i>
                           Orders
                           </a>
                        </li>
                        <li>
                           <a href="{{ route('category-list') }}">
                           <i class="fa-solid fa-cart-shopping metismenu-icon"></i>
                           Categories/Shows
                           </a>
                        </li>
                        <li>
                           <a href="{{ route('banner-list') }}">
                           <i class="fa-solid fa-cart-shopping metismenu-icon"></i>
                           Banner Management
                           </a>
                        </li>
                        <li>
                           <a href="{{ route('offer-list') }}">
                           <i class="fa-solid fa-cart-shopping metismenu-icon"></i>
                           Sale Management
                           </a>
                        </li>
                        <li>
                           <a href="{{ route('logout') }}">
                           <i class="fa-solid fa-arrow-right-from-bracket metismenu-icon"></i>
                           Logout
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
<div class="app-main__outer">

@yield('content')

   <div class="app-wrapper-footer">
      <div class="app-footer">
         <div class="app-footer__inner">
            <div class="app-footer-left">
            </div>
            <div class="app-footer-right">
               <ul class="nav">
                  <li class="nav-item">
                     <a href="javascript:void(0);" class="nav-link">
                        <div class="badge badge-success mr-1 ml-0">
                           <small>Copyright</small>
                        </div>
                        Ones Media
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
      </div>
      <script
         src="https://code.jquery.com/jquery-2.2.4.js"
         integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
         crossorigin="anonymous"></script>
      <script type="text/javascript" src="{{asset('assets/scripts/main.js')}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
      <script src="{{asset('assets/scripts/custom.js')}}"></script>
        <script src="{{ asset('assets/scripts/common.js')}}"></script>
      
      @stack('scripts')
   </body>
</html>