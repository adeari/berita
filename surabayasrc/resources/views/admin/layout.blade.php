<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Bootstrap -->
    <link href="{{ URL::to('pluginhtml/gentelella/vendors') }}/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::to('pluginhtml/gentelella/vendors') }}/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ URL::to('pluginhtml/gentelella/build') }}/css/custom.min.css" rel="stylesheet">
    <link href="{{ URL::to('pluginhtml/gentelella/vendors') }}/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <link href="{{ URL::to('pluginhtml/creator.css') }}" rel="stylesheet">
    <link href="{{ URL::to('pluginhtml/gentelella/vendors') }}/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="{{ URL::to('pluginhtml/mycustom.css') }}" rel="stylesheet">
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ URL::to('admin-berita') }}" class="site_title"><i class="fa fa-paw"></i> <span>Surabaya Digital City</span></a>
            </div>
            <div class="clearfix"></div>
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            	<ul class="nav side-menu">
<li><a href="{{ URL::to('logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>

            	<li v-bind:class="{ 'active': isberitaactive }"><a><i class="fa fa-star-o"></i> Pengaturan <span class="fa fa-chevron-down"></span></a>
		  <ul class="nav child_menu" v-bind:style="beritastyle">
		    <li v-bind:class="{ 'current-page': admin-berita }"><a href="{{ URL::to('admin-berita') }}"><i class="fa fa-trophy"></i> Berita</a></li>
		    <li v-bind:class="{ 'current-page': admin-users }"><a href="{{ URL::to('admin-users') }}"><i class="fa fa-user"></i> Users</a></li>
		    <li v-bind:class="{ 'current-page': admin-grafik }"><a href="{{ URL::to('admin-grafik') }}"><i class="fa fa-area-chart"></i> Grafik</a></li>
                  </ul>
                </li>


                </ul>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
	    <div id="appcontent">@yield('content')</div>
        <footer></footer>
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ URL::to('pluginhtml/gentelella/vendors') }}/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ URL::to('pluginhtml/gentelella/vendors') }}/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="{{ URL::to('pluginhtml/gentelella/vendors') }}/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{ URL::to('pluginhtml/gentelella/vendors') }}/nprogress/nprogress.js"></script>
    <script src="{{ URL::to('pluginhtml/gentelella/vendors') }}/validator/validator.js"></script>
    <script src="{{ URL::to('pluginhtml/gentelella/vendors') }}/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="{{ URL::to('pluginhtml/gentelella/vendors') }}/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="{{ URL::to('pluginhtml/gentelella/vendors') }}/google-code-prettify/src/prettify.js"></script>
    <script src="{{ URL::to('pluginhtml/gentelella/vendors') }}/iCheck/icheck.min.js"></script>

    <script src="{{ URL::to('pluginhtml') }}/vue.min.js"></script>
    <script src="{{ URL::to('pluginhtml') }}/vue-resource.min.js"></script>
    <script src="{{ URL::to('pluginhtml') }}/mycustom.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ URL::to('pluginhtml/gentelella/build') }}/js/custom.js"></script>
@yield('javascript')
  </body>
</html>
