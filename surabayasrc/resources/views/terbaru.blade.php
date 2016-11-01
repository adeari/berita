@extends('layout')
@section('title', 'Surabaya Berita Terbaru')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
	<h3>Berita Terbaru</h3>
      </div>

      <div class="title_right">
	<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
	  <div class="input-group">
      <input type="text" class="form-control" placeholder="Pencarian ..." @keyup.enter="pencarian" v-model="katapencarian">
	    <span class="input-group-btn">
        {!! Form::button('Go!', ['class' => 'btn btn-default', '@click' => 'pencarian' ]) !!}
	    </span>
	  </div>
	</div>
      </div>
    </div>
 <div class="clearfix"></div>
 <div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_content" style="display:none;" v-show="viewberita">
<div class="col-xs-12" v-for="berita in beritas" style="cursor: pointer;" @click="detailberita(berita.id)">
  <div class="x_panel">
    <div class="x_title">
      <h2>@{{ berita.judul }}<small>@{{ berita.tanggal }}</small></h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content" v-show="berita.filename.length == 0">@{{{ berita.deskripsi }}}</div>
    <div class="x_content" v-show="berita.filename.length > 0">
    <div class="row">
    	<div class="col-md-4"><img src="@{{ berita.filename }}" style="max-width:100%;"></div>
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
menuvue.isberitaactive = true;
menuvue.terbaru = true;
menuvue.beritastyle = {display: 'block'};
var vue = new Vue({
	el: '#appcontent',
	data: {
		viewberita: true
		,isberitaactive : true
		,beritastyle : { dislay:'block' }
		,beritas : [{!! $beritas !!}]
	},
	methods:{
		detailberita: function(id){
			location.href = '{{ URL::to('beritadetail-') }}'+id+'-{{ $backpage }}';
		},
    pencarian: function() {
      elem = this;
      elem.$http.get('{{ URL::to('berita-cari-terbaru') }}?katapencarian='+elem.katapencarian).then(function(response){
        elem.beritas.splice(0, elem.beritas.length);
  			elem.beritas = [];
        if (response.body.length > 0) {
          var jsonObj = $.parseJSON(response.body);
          elem.beritas = jsonObj.beritaresult;
        }
      });
    }
	}
});
</script>
@endsection
