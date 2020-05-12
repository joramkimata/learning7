<!-- Topbar Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-right mb-0">

            <li class="dropdown notification-list">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle nav-link">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>



            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                   href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{url('uploads/user.png')}}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                                    {{auth()->user()->name}} <i class="mdi mdi-chevron-down"></i>
                                </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">TodoApp!</h6>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" data-toggle="modal" data-target=".change-password-modal" class="dropdown-item notify-item">
                        <i class="remixicon-lock-line"></i>
                        <span>Change Password</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="{{route('users.logout')}}" class="dropdown-item notify-item">
                        <i class="remixicon-logout-box-line"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li>



        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index-2.html" class="logo text-center">
                            <span class="logo-lg">
                                <img src="{{url('uploads/logo-todo.png')}}" alt="" height="70">
                                <!-- <span class="logo-lg-text-light">Xeria</span> -->
                            </span>
                <span class="logo-sm">
                                <!-- <span class="logo-sm-text-dark">X</span> -->
                                <img src="{{url('uploads/logo-todo.png')}}" alt="" height="24">
                    </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">



        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->
