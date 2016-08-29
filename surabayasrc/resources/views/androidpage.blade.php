@extends('layout')
@section('title', 'Surabaya Berita Populer')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
	<h3>Download Android</h3>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_content">
	      <a href="{{ URL::to('apk/apps.apk') }}">Download Android</a>
	  </div>
	</div>
      </div>
    </div>
    
    
    
  </div>
</div>
<!-- /page content -->
@endsection
@section('javascript')
<script>
menuvue.isartikelactive = true;
menuvue.androidpage = true;
menuvue.artikelstyle = {display: 'block'};
</script>
@endsection