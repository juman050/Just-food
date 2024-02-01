@include('admin.partials.header')
@yield('css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="{{route('dashboard')}}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>J</b>F</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Just</b>Food</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="#"><b> {{ changeDateFormate(date('Y-m-d H:i:s')) }}</b></a></li>

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image"> -->
                                <span class="hidden-xs">{{Auth::user()->name}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <!-- <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image"> -->

                                    <p>
                                        {{Auth::user()->email}}
                                        <small>Member since {{Auth::user()->created_at}}</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{route('adminProfile')}}" class="btn btn-default btn-flat">Profile</a>
                                    </div>


                                    <div class="pull-right">
                                        <a  href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>


                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        @include('admin.partials.sidebar')

        @yield('content')

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Just</b> Food
            </div>
            <strong>Copyright &copy; Justfood <a href="https://justfood">Justfood</a>.</strong> All rights
            reserved.
        </footer>


    </div>
    <!-- ./wrapper -->
    @include('admin.partials.footer')