@extends('layout')
@section('title', 'Surabaya Berita Populer')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
		<a href="{{ URL::to($backpage) }}"><h3 class="blue"><i class="fa fa-arrow-left"></i> Kembali</h3></a>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
	    <h2>{{ $berita->judul }}<small>{{ substr($berita->updated_at, 8, 2).'/'.substr($berita->updated_at, 5, 2).'/'.substr($berita->updated_at, 0, 4).substr($berita->updated_at, 10, 6) }}</small></h2>
	    <div class="clearfix"></div>
	  </div>
	  <div class="x_content">
	      @if (!is_null($berita->filename) && !empty($berita->filename))
	      <div class="col-md-12 text-center">
<img src="{{ URL::to('public/image/'.$berita->filename) }}" style="margin-bottom:20px;max-width:100%;"><br>
</div>
	      @endif
	      {!! $berita->deskripsi !!}
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
$(document).ready(function() {
    setContentHeight();
});
</script>
@endsection