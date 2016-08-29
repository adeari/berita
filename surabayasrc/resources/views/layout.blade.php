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
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ URL::to('populer') }}" class="site_title"><i class="fa fa-paw"></i> <span>Surabaya Berita</span></a>
            </div>
            <div class="clearfix"></div>
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            	<ul class="nav side-menu">
            	<li v-bind:class="{ 'active': isberitaactive }"><a><i class="fa fa-star-o"></i> Berita <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" v-bind:style="beritastyle">
                      	<li v-bind:class="{ 'current-page': populer }"><a href="{{ URL::to('populer') }}"><i class="fa fa-trophy"></i> Populer</a></li>
						<li v-bind:class="{ 'current-page': terbaru }"><a href="{{ URL::to('terbaru') }}"><i class="fa fa-camera-retro"></i> Terbaru</a></li>
                    </ul>
                </li>
                <li v-bind:class="{ 'active': isartikelactive }"><a><i class="fa fa-newspaper-o"></i> Artikel <span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" v-bind:style="artikelstyle">
                      	<li v-bind:class="{ 'current-page': umum }"><a href="{{ URL::to('artikel-umum') }}"><i class="fa fa-newspaper-o"></i> Umum</a></li>
                      	<li v-bind:class="{ 'current-page': acara }"><a href="{{ URL::to('artikel-acara') }}"><i class="fa fa-gift"></i> Acara</a></li>
                      	<li v-bind:class="{ 'current-page': pengaduan }"><a href="{{ URL::to('artikel-pengaduan') }}"><i class="fa fa-binoculars"></i> Pengaduan</a></li>
                      	<li v-bind:class="{ 'current-page': androidpage }"><a href="{{ URL::to('androidpage') }}"><i class="fa fa-android"></i> Android</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-certificate"></i> Pengaturan<span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
                      	<li><a href="berita-add"><i class="fa fa-plus"></i> Tambah berita</a></li>
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
    <script src="{{ URL::to('pluginhtml') }}/vue.min.js"></script>
    <script src="{{ URL::to('pluginhtml') }}/vue-resource.min.js"></script>
    <script src="{{ URL::to('pluginhtml') }}/mycustom.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ URL::to('pluginhtml/gentelella/build') }}/js/custom.min.js"></script>
@yield('javascript')
  </body>
</html>