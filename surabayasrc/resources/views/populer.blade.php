<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Surabaya Berita</title>

    <!-- Bootstrap -->
    <link href="{{ URL::to('pluginhtml/gentelella/vendors') }}/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ URL::to('pluginhtml/gentelella/vendors') }}/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ URL::to('pluginhtml/gentelella/build') }}/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Surabaya Berita</span></a>
            </div>

            <div class="clearfix"></div>
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            	<ul class="nav side-menu">
            	<li><a><i class="fa fa-star-o"></i> Berita <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
                      	<li><a href="index.html"><i class="fa fa-trophy"></i> Populer</a></li>
						<li><a href="index.html"><i class="fa fa-camera-retro"></i> Terbaru</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-newspaper-o"></i> Artikel <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
                      	<li><a href="index.html"><i class="fa fa-newspaper-o"></i> Umum</a></li>
                      	<li><a href="index.html"><i class="fa fa-gift"></i> Acara</a></li>
                      	<li><a href="index.html"><i class="fa fa-binoculars"></i> Pengaduan</a></li>
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

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Populer</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>judul berita <small>tanggal</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      deskriptsi
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        
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
    
    <!-- Custom Theme Scripts -->
    <script src="{{ URL::to('pluginhtml/gentelella/build') }}/js/custom.min.js"></script>
  </body>
</html>
