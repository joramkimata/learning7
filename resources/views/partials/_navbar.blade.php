<div class="topbar-menu">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="has-submenu">
                    <a href="{{route('users.dashboard')}}">
                        <i class="remixicon-dashboard-line"></i>Dashboard
                    </a>
                </li>

                <li class="has-submenu">
                    <a href="#">
                        <i class="fa fa-list"></i>Todos
                        <div class="arrow-down"></div>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{route('todos.index')}}"><i class="fa fa-list"></i> Manage Todos</a>
                        </li>
                    </ul>
                </li>

                @if(auth()->user()->role == 'admin')
                    <li class="has-submenu">
                        <a href="#">
                            <i class="fa fa-users"></i>Users
                            <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{route('users.index')}}"><i class="fa fa-list"></i> Manage Users</a>
                            </li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="#">
                            <i class="fa fa-cogs"></i>Settings
                            <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{route('categories.index')}}"><i class="fa fa-list"></i> Manage Categories</a>
                            </li>
                        </ul>
                    </li>

                @endif


            </ul>
            <!-- End navigation menu -->

            <div class="clearfix"></div>
        </div>
        <!-- end #navigation -->
    </div>
    <!-- end container -->
</div>
<!-- end navbar-custom -->

