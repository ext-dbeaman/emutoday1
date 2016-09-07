<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')AdminEMU</title>
    <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @section('style-vendor')

    @show

    @section('style-plugin')

    @show

    @section('style-app')
        <link rel="stylesheet" href="{{ elixir('css/admin-styles.css') }}" />
        <!-- Theme style -->

        {{-- <link rel="stylesheet" href="/themes/admin-lte/dist/css/AdminLTE.min.css"> --}}
        {{-- <link rel="stylesheet" href="{{ elixir('css/admin-styles.css') }}" /> --}}

        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
                    page. However, you can choose any other skin. Make sure you
                    apply the skin class to the body tag so the changes take effect.
        -->
        {{-- <link rel="stylesheet" href="/themes/admin-lte/dist/css/skins/skin-purple.min.css"> --}}
    @show
    @section('scripts-vendor')
        <!-- Vendor Scripts that need to be loaded in the header before other plugin or app scripts -->
    @show
    @section('scripts-plugin')
        <!-- Scripts  for code libraries and plugins that need to be loaded in the header -->
    @show
    @section('scripts-app')
        <!-- App related Scripts  that need to be loaded in the header -->
    @show
    @include('include.js')


    <meta name="_token" content="{{ csrf_token() }}">
  </head>

    <body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="/emu-today/hub" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>EMU</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>EMU</b>-TODAY</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                            <li class="dropdown notifications-menu">
                                <!-- Menu toggle button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bug"></i>
                                    <span class="label label-alert"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    {{-- <li class="header">You have tracked 4 bugz</li> --}}
                                    <li>
                                        <!-- inner menu: contains the messages -->
                                        <ul class="menu">
                                            @include('admin.bugz.subview.miniform')
                                        </ul>
                                        <!-- /.menu -->
                                    </li>
                                    <li class="footer"><a href="#" class="btn btn-info expanded btn-xs" data-toggle="collapse">close</a>
</li>
                                </ul>
                            </li>
                            <!-- /.messages-menu -->
    @can('super', $currentUser)
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-calendar-o"></i>
                                <span class="label label-warning">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 events to approve</li>
                                <li>
                                    <!-- inner menu: contains the messages -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <!-- User Image -->
                                                    <i class="fa fa-calendar bg-orange"></i>
                                                    {{-- <img src="/assets/imgs/user/user2-160x160.jpg" class="img-circle" alt="User Image"> --}}
                                                </div>
                                                <!-- Message title and timestamp -->
                                                <h4>
                                                    Event 1
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <!-- The message -->
                                                <p>EMU Picnic</p>
                                            </a>
                                        </li>
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <!-- User Image -->
                                                    <i class="fa fa-calendar bg-orange"></i>
                                                    {{-- <img src="/assets/imgs/user/user2-160x160.jpg" class="img-circle" alt="User Image"> --}}
                                                </div>
                                                <!-- Message title and timestamp -->
                                                <h4>
                                                    Event 2
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <!-- The message -->
                                                <p>EMU Registration</p>
                                            </a>
                                        </li>
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <!-- User Image -->
                                                    <i class="fa fa-calendar bg-orange"></i>
                                                    {{-- <img src="/assets/imgs/user/user2-160x160.jpg" class="img-circle" alt="User Image"> --}}
                                                </div>
                                                <!-- Message title and timestamp -->
                                                <h4>
                                                    Event 3
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <!-- The message -->
                                                <p>EMU Concert</p>
                                            </a>
                                        </li>
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <!-- User Image -->
                                                    <i class="fa fa-calendar bg-orange"></i>
                                                    {{-- <img src="/assets/imgs/user/user2-160x160.jpg" class="img-circle" alt="User Image"> --}}
                                                </div>
                                                <!-- Message title and timestamp -->
                                                <h4>
                                                    Event 4
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <!-- The message -->
                                                <p>EMU Sporting Event</p>
                                            </a>
                                        </li>
                                        <!-- end message -->
                                    </ul>
                                    <!-- /.menu -->
                                </li>
                                <li class="footer"><a href="/admin/event">See All Events</a></li>
                            </ul>
                        </li>
                        <!-- /.messages-menu -->

                        <!-- Notifications Menu -->
                        <li class="dropdown notifications-menu">
                            <!-- Menu toggle button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bullhorn"></i>
                                <span class="label label-danger">3</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 3 Announcements to approve</li>
                                <li>
                                    <!-- Inner Menu: contains the notifications -->
                                    <ul class="menu">
                                        <li><!-- start notification -->
                                            <a href="#">
                                                <i class="fa fa-bullhorn text-red"></i> Announcement 1
                                            </a>
                                        </li>
                                        <li><!-- start notification -->
                                            <a href="#">
                                                <i class="fa fa-bullhorn text-red"></i> Announcement 2
                                            </a>
                                        </li>
                                        <li><!-- start notification -->
                                            <a href="#">
                                                <i class="fa fa-bullhorn text-red"></i> Announcement 3
                                            </a>
                                        </li>
                                        <!-- end notification -->
                                    </ul>
                                </li>
                                <li class="footer"><a href="/admin/announcement">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks Menu -->
                        <li class="dropdown tasks-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-files-o"></i>
                                <span class="label label-success">2</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 2 Stories to approve</li>
                                <li>
                                    <!-- Inner menu: contains the tasks -->
                                    <ul class="menu">
                                        <li><!-- start notification -->
                                            <a href="#">
                                                <i class="fa fa-file-text text-green"></i> Story 1
                                            </a>
                                        </li>
                                        <li><!-- start notification -->
                                            <a href="#">
                                                <i class="fa fa-file-text text-green"></i> Story 2
                                            </a>
                                        </li>
                                        {{-- <li><!-- Task item -->
                                            <a href="#">
                                                <!-- Task title and progress text -->
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <!-- The progress bar -->
                                                <div class="progress xs">
                                                    <!-- Change the css width attribute to simulate progress -->
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li> --}}
                                        <!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="/admin/story">View all stories</a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->

                                    @if(count($currentUser->mediaFiles) > 0)
                                        <img src="/imagecache/avatar160/{{$currentUser->mediaFiles->first()->filename}}" class="user-image" alt="User Image">
                                    @else
                                        <img src="/assets/imgs/user/user2-160x160.jpg" class="user-image" alt="User Image">
                                    @endif


                                {{-- <img src="{{$currentUser->mediaFiles->}}" class="user-image" alt="User Image"> --}}

                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{$currentUser->last_name}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    @if(count($currentUser->mediaFiles) > 0)
                                        <img src="/imagecache/avatar160/{{$currentUser->mediaFiles->first()->filename}}" class="img-circle" alt="User Image">
                                    @else
                                        <img src="/assets/imgs/user/user2-160x160.jpg" class="img-circle" alt="User Image">
                                    @endif

                                    <p>
                                        {{$currentUser->first_name}} {{$currentUser->last_name}}

                                        <small>{{$currentUser->roles->pluck('name')}}</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                {{-- <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li> --}}
                                <!-- Menu Footer-->
                                <li class="user-footer bg-purple">
                                    <div class="pull-left">
                                        <a href="/admin/users/{{$currentUser->id}}" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('auth.logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
                        @if(count($currentUser->mediaFiles) > 0)
                            <img src="/imagecache/avatar160/{{$currentUser->mediaFiles->first()->filename}}" class="user-image img-circle" alt="User Image">
                        @else
                            <img src="/assets/imgs/user/user2-160x160.jpg" class="user-image" alt="User Image">
                        @endif
            </div>
            <div class="pull-left info">
              <p>{{ $currentUser->last_name }}</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form (Optional) -->
          {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
                  <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
            </div>
          </form> --}}
          <!-- /.search form -->

          <!-- ********************************
                Sidebar Menu
                ******************************** -->
          <ul class="sidebar-menu">
                    @include('admin.layouts.sidebar.menu')

          </ul>
          <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
        <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          {{-- <h1>
                    {{Route::current()->getName()}}
            <small>	{{Route::current()->getActionName()}}</small>
          </h1> --}}
                <div class="row">

                <div class="col-xs-6">

                            <ol class="breadcrumb">
                                <li><a class="btn bg-olive btn-sm" href="{{URL::previous()}}"><i class="fa fa-arrow-circle-left fa-lg"></i></a></li>
                        <li><a class="btn bg-purple btn-sm" href="/admin/dashboard"><i class="fa fa-dashboard fa-lg"></i></a></li>
                                <li class="active">Here</li>
                      </ol>

                    </div><!-- /.col-xs-6 -->
                <div class="col-xs-6">
                {{-- {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default pull-right']) !!} --}}

                {{-- <a href="{{URL::previous()}}"><i class="fa fa-arrow-circle-left pull-right bg-yellow"></i></a> --}}
        </div><!-- /.col-xs-6 -->

    </div><!-- /.row -->
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
                @include('flash::message')
                @include('admin/partials.errors')
                @yield('content')
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
        <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          2016
        </div>
        <!-- Default to the left -->
        <strong><a href="#">EMU-Today</a></strong>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                        <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-newspaper-o bg-green"></i>

                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">EMU-Today Weekly</h4>

                    <p>Wednesday July 6th, 2016</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-book bg-blue"></i>

                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">EMU Magazine Launch</h4>

                    <p>Monday August 1st, 2016</p>
                  </div>
                </a>
              </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Compile Magazine Content
                    <span class="label label-danger pull-right">70%</span>
                  </h4>

                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
            </ul>
            <!-- /.control-sidebar-menu -->

          </div>
          <!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
          <!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Google Analytics
                  <input type="checkbox" class="pull-right" checked>
                </label>

                <p>
                  Some information about this general settings option
                </p>
              </div>
              <!-- /.form-group -->
            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
      </aside>
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div> <!-- wrapper -->
    @section('footer-vendor')

        <script src="{{ elixir('js/vendor-scripts.js') }}"></script>
    @show
    @section('footer-plugin')

    @show
    @section('footer-app')
        {{-- <script>
    var AdminLTEOptions = {
        //Enable sidebar expand on hover effect for sidebar mini
        //This option is forced to true if both the fixed layout and sidebar mini
        //are used together
        sidebarExpandOnHover: false,
        //BoxRefresh Plugin
        enableBoxRefresh: true,
        //Bootstrap.js tooltip
        enableBSToppltip: true
    };
</script> --}}
    <script src="/themes/admin-lte/dist/js/app.js" type="text/javascript"></script>
        <script src="/js/vue-ajax-form.js" ></script>
    @show

    @section('footer-script')
    @show

    </body>
    </html>
