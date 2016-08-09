@extends('layout')
@section('title', 'Surabaya Berita Populer')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
	<h3>Berita Populer</h3>
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
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_content">
<div class="col-xs-12" v-for="berita in beritas" style="cursor: pointer;" @click="detailberita(berita.id)">
  <div class="x_panel">
    <div class="x_title">
      <h2>@{{ berita.judul }}<small>@{{ berita.tanggal }}</small></h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content" v-show="berita.filename.length == 0">@{{{ berita.deskripsi }}}</div>
    <div class="x_content" v-show="berita.filename.length > 0">
    <div class="row">
    	<div class="col-md-4"><img src="@{{ berita.filename }}" width="@{{ berita.width }}px" height="@{{ berita.height }}px"></div>
    	<div class="col-md-8"><p>@{{{ berita.deskripsi }}}</p></div>
    </div>
    </div>
  </div>
</div>
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
var vue = new Vue({
	el: '#appcontent',
	data: {
		beritas : [{!! $beritas !!}]
	},
	methods:{
		detailberita: function(id){
			location.href = '{{ URL::to('beritadetail-') }}'+id;
		}
	}
});
</script>
@endsection