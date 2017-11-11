
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/morris.js/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/jvectormap/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{Session::get('username')}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                                <p>
                                    {{Session::get('username')}} - Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{url('/admin/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Session::get('username')}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li class="{{ Request::getPathInfo() == '/admin/user' ? 'active' : ''}}">
                    <a href="{{url('admin/user')}}">
                        <i class="fa fa-group"></i> <span>User</span>
                    </a>
                </li>
                <li class="{{ Request::getPathInfo() == '/admin/vip' ? 'active' : ''}}">
                    <a href="{{url('admin/vip')}}">
                        <i class="fa fa-vimeo"></i> <span>VIP User</span>
                    </a>
                </li>

                <li class="treeview {{ (Request::getPathInfo() == '/admin/video' or Request::getPathInfo() == '/admin/videovip' or Request::getPathInfo() == '/admin/loading' or Request::getPathInfo() == '/admin/videoadd' or Request::getPathInfo() == '/admin/recovervideo') ? 'active menu-open' : ''}}">
                    <a href="#">
                        <i class="fa fa-video-camera"></i>
                        <span>VIDEO</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::getPathInfo() == '/admin/video' ? 'active' : ''}}"><a href="{{url('admin/video')}}"><i class="fa fa-circle-o text-aqua"></i> Public video</a></li>
                        <li class="{{ Request::getPathInfo() == '/admin/videovip' ? 'active' : ''}}"><a href="{{url('admin/videovip')}}"><i class="fa fa-circle-o text-aqua"></i> VIP video</a></li>
                        <li class="{{ Request::getPathInfo() == '/admin/loading' ? 'active' : ''}}"><a href="{{url('admin/loading')}}"><i class="fa fa-circle-o text-aqua"></i> loading video</a></li>
                        <li class="{{ Request::getPathInfo() == '/admin/videoadd' ? 'active' : ''}}"><a href="{{url('admin/videoadd')}}"><i class="fa fa-circle-o text-aqua"></i> add video</a></li>
                        <li class="{{ Request::getPathInfo() == '/admin/recovervideo' ? 'active' : ''}}"><a href="{{url('admin/recovervideo')}}"><i class="fa fa-circle-o text-aqua"></i> recover
 video</a></li>
                    </ul>
                </li>
                <li class="treeview {{ (Request::getPathInfo() == '/admin/links' or Request::getPathInfo() == '/admin/linksadd') ? 'active menu-open' : ''}}">
                    <a href="#">
                        <i class="fa fa-link"></i>
                        <span>Links</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::getPathInfo() == '/admin/links' ? 'active' : ''}}"><a href="{{url('admin/links')}}"><i class="fa fa-circle-o text-aqua"></i> Links</a></li>
                        <li class="{{ Request::getPathInfo() == '/admin/linksadd' ? 'active' : ''}}"><a href="{{url('admin/linksadd')}}"><i class="fa fa-circle-o text-aqua"></i> add link</a></li>
                    </ul>
                </li>
                <li class="treeview {{ (Request::getPathInfo() == '/admin/notice' or Request::getPathInfo() == '/admin/noticeadd') ? 'active menu-open' : ''}}">
                    <a href="#">
                        <i class="fa fa-link"></i>
                        <span>Notice</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::getPathInfo() == '/admin/notice' ? 'active' : ''}}"><a href="{{url('admin/notice')}}"><i class="fa fa-circle-o text-aqua"></i> Notice</a></li>
                        <li class="{{ Request::getPathInfo() == '/admin/noticeadd' ? 'active' : ''}}"><a href="{{url('admin/noticeadd')}}"><i class="fa fa-circle-o text-aqua"></i> add Notice</a></li>
                    </ul>
                </li>
                <li class="{{ Request::getPathInfo() == '/admin/system' ? 'active' : ''}}">
                    <a href="/admin/system">
                        <i class="fa  fa-gears"></i> <span>System</span>
                    </a>
                </li>
                <li class="{{ Request::getPathInfo() == '/admin/message' ? 'active' : ''}}">
                    <a href="/admin/message">
                        <i class="fa  fa-gears"></i> <span>message</span>
                    </a>
                </li>
                <li class="treeview {{ Request::getPathInfo() == '/admin/code' ? 'active menu-open' : ''}}">
                    <a href="#">
                        <i class="fa fa-paper-plane"></i>
                        <span>Code</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{(isset($_GET['id']) && $_GET['id'] == 1) ? 'active' : ''}}"><a href="{{url('/admin/code?id=1')}}"><i class="fa fa-circle-o text-aqua"></i> 1 day</a></li>
                        <li class="{{ (isset($_GET['id']) && $_GET['id'] == 30) ? 'active' : ''}}"><a href="{{url('/admin/code?id=30')}}"><i class="fa fa-circle-o text-aqua"></i> 1 month</a></li>
                        <li class="{{(isset($_GET['id']) && $_GET['id'] == 90) ? 'active' : ''}}"><a href="{{url('/admin/code?id=90')}}"><i class="fa fa-circle-o text-aqua"></i> 1 Quarterly</a></li>
                        <li class="{{(isset($_GET['id']) && $_GET['id'] == 360) ? 'active' : ''}}"><a href="{{url('/admin/code?id=360')}}"><i class="fa fa-circle-o text-aqua"></i> 1 year</a></li>
                    </ul>
                </li>


                <li>
                    <a href="/admin/logout">
                        <i class="fa fa-undo"></i> <span>Logout</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title')
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">@yield('title')</li>
            </ol>
        </section>

        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2017 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('admin/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('admin/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('admin/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
@yield('script')
</body>
</html>
