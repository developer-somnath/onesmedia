<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta http-equiv="Content-Language" content="en">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Once Media Login</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
      <meta name="description" content="ArchitectUI HTML Bootstrap 4 Dashboard Template">
      <meta name="msapplication-tap-highlight" content="no">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
      <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
      <link href="{{asset('assets/css/main.css') }}" rel="stylesheet">
      <link href="{{asset('assets/css/custom.css') }}" rel="stylesheet">
      <script>
        let baseUrl="{{url('')}}/"
      </script>
   </head>
   <body>
      <div class="app-container app-theme-white body-tabs-shadow">
         <div class="app-container">
            <div class="h-100">
               <div class="h-100 no-gutters row">
                  <div class="d-none d-lg-block col-lg-6">
                     <div class="slider-light">
                        <div class="slick-slider">
                           <div>
                              <div class="position-relative h-100 d-flex justify-content-center align-items-center" tabindex="-1">
                                 <div class="slide-img-bg"></div>
                                 <div class="logintop"><img src="{{asset('assets/images/logo.png')}}">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-6">
                     <div class="" style="position: absolute;left: 0;top: 0;width: 100%;height: 100%;background-size: cover;
                        opacity: 1;
                        background: #0071AE;
                        z-index: 10;">
                        <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                           <div class="shape-logo"><img src="{{asset('assets/images/login-shape.png')}}" /></div>
                           <h4 class="mb-0 margin-top">
                              <span>Login</span>
                           </h4>
                           <div>
                              <form class="adminFrm" data-action="user-check" method="post">
                                 @csrf
                                 <div class="form-row">
                                    <div class="col-md-12">
                                       <div class="position-relative form-group">
                                          <label style="color:#fff">Email</label>
                                          <input name="email" id="exampleEmail" placeholder="Email" type="email" class="form-control requiredCheck" data-check="Email">
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="position-relative form-group">
                                          <label style="color:#fff">Password</label>
                                          <input name="password" id="examplePassword" placeholder="Password" type="password" class="form-control requiredCheck" data-check="Password">
                                       </div>
                                    </div>
                                 </div>
                                    <div class="position-relative form-check text-center">
                                        <a href="forgot-password.html" class="btn-link text-danger">Forgot Password</a>
                                    </div>
                                 <div class="d-flex align-items-center">
                                    <div class="mx-auto text-center">
                                       <div class="clearfix mb-4"></div>
                                       <button class="btn btn-warning btn-lg" type="submit">Login</button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
        <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script type="text/javascript" src="{{asset('assets/scripts/main.js')}}"></script>
        <script src="{{ asset('assets/scripts/custom.js')}}"></script>
        <script src="{{ asset('assets/scripts/common.js')}}"></script>
   </body>
</html>