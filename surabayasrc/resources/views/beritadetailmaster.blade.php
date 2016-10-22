@section('title', 'Surabaya Berita Populer')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
				<a href="{{ URL::to($backpage.(empty($parameter) ? '' : '?'.$parameter)) }}"><h3 class="blue"><i class="fa fa-arrow-left"></i> Kembali</h3></a>
      </div>
@if (Auth::check())
@if (Auth::user()->isadmin)
	@if ($berita->populer)
		<label class="label label-danger textbig">Populer</label>
	@endif
			<ul class="nav navbar-nav navbar-right" id="adminoption">
			<li class="">
				<a href="javascript:;" class="user-profile dropdown-toggle rightadminmenu" data-toggle="dropdown" aria-expanded="false">
					<button class="btn btn-success"><i class="fa fa-gear"></i> Tindakan <span class=" fa fa-angle-down"></span></button>
				</a>
				<ul class="dropdown-menu dropdown-usermenu pull-right">
@if ($berita->populer)
	<li><a href="{{ URL::to('admin-batalpopuler1?beritaid='.$berita->id.'&backpage='.$backpage.'&'.$parameter) }}"><i class="fa fa-star-o leftmenu"></i>  Batal Populer</a></li>
@else
	<li><a href="{{ URL::to('admin-populer1?beritaid='.$berita->id.'&backpage='.$backpage.'&'.$parameter) }}"><i class="fa fa-star red leftmenu"></i> Populerkan</a></li>
@endif
	<li><a href="" @click.stop.prevent="hapusnihberita('{{ URL::to('admin-hapusberita1?beritaid='.$berita->id.'&backpage='.$backpage.'&'.$parameter) }}')"><i class="fa fa-remove leftmenu"></i> Hapus</a></li>
				</ul>
			</li>
			</ul>
@endif
@endif
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
@if (empty($berita->user1->gambar))
		<div class="row pembuatberitarow">
      <div class="col-md-12 usernamekomentar">{{ $berita->user1->name }}</div>
    </div>
@else
			<div class="row pembuatberitarow">
      <div class="col-md-1">
	<img src="{{ URL::to('public/image/'.$berita->user1->gambar) }}" class="img-circle profile_img" style="margin:0 10px 0 0;padding:0;max-width:40px;max-height:40px;">
      </div>
      <div class="col-md-11 usernamekomentar">{{ $berita->user1->name }}</div>
    </div>
@endif
	  </div>
	</div>
      </div>
    </div>
    
<div id="komentarlistlayout" v-show="viewkomentars" style="display:none;">

  <div class="row" v-for="komentar in komentars"><div class="col-md-12 col-sm-12 col-xs-12"><div class="x_panel">

<div v-show="komentar.viewkomentar">
  <div style="margin:0 0 10px 0;" v-if="komentar.isaccess == 1">
    <button class="btn btn-warning" @click="ralatkomentar(komentar)">RALAT</button>
    <button class="btn btn-danger" style="float:right;" v-show="komentar.showhapusbutton" @click="askhapuskomentar(komentar)">HAPUS</button>
    <div style="float:right" v-show="komentar.showlayoutconfirmhapus">
    Jadi dihapus ? <button class="btn btn-danger" @click="dohapuskomentar(komentar)">Ya</button> <button class="btn btn-success" @click="batalhapuskomentar(komentar)">Tidak</button>
    </div>
  </div>

    <div class="row" v-if="komentar.usersgambar.length > 0">
      <div class="col-md-1">
	<img src="@{{ komentar.usersgambar }}" class="img-circle profile_img" style="margin:0 10px 0 0;padding:0;max-width:40px;max-height:40px;">
      </div>
      <div class="col-md-11 usernamekomentar">@{{ komentar.name }}</div>
    </div>
    <div class="row" v-else>
      <div class="col-md-12 usernamekomentar">@{{ komentar.name }}</div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12 text-center" v-show="komentar.gambar.length > 0"><img src="@{{ komentar.gambar }}" ></div>
      <div class="col-md-12">@{{ komentar.komentar }}</div>
    </div>
  </div>
  <div v-show="komentar.vieweditkomentar">
  <h3>Ralat komentar</h3><hr>
    {!! Form::open(['class' => 'form-horizontal form-label-left', 'novalidate' => 'novalidate', '@submit.prevent' => 'ralatkomentarprocess(komentar)', 'id' => 'formdata'])  !!}
     <div class="item form-group">
      {!! Form::label('komentargambar', 'Gambar', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
      <div class="col-md-6 col-sm-6 col-xs-12">
	<input name="komentargambar@{{ komentar.id }}" type="file" id="komentargambar@{{ komentar.id }}" @change="onchangeimagekomentar(komentar, $event)" style="width:300px;">
	<div v-show="komentar.imageberitashow"><br><img src="@{{ komentar.gambar }}" id="imagepictedit@{{ komentar.id }}" width="260px" height="200px" class="pointer"></div>
	{{ Form::button('Hapus Gambar', array('class' => 'btn btn-primary', '@click' => 'hapusgambar(komentar)', 'v-show' => 'komentar.vdelimagebutton')) }}
      </div>
    </div>
    <div class="item form-group">
      {!! Form::label('komentar', 'Komentar', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
      <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::text('komentar', '', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'komentar', 'required' => 'required', 'v-model' => 'komentar.komentaredit']) !!}
      </div>
    </div>
     <div class="form-group">
	<div class="col-md-6 col-md-offset-3">
	  <button id="send" type="submit">Simpan</button>
	  {{ Form::button('Batal', array('class' => 'btn btn-warning', '@click' => 'batalralat(komentar)', 'type' => 'button')) }}
	</div>
      </div>
    {!! Form::close() !!}
  </div>
  </div></div>
</div>
</div>
    
<div id="komentarlayout">

  <div class="row" v-show="komentaraddlayout" style="display:none;"><div class="col-md-12 col-sm-12 col-xs-12"><div class="x_panel"><div class="x_content">
  {!! Form::open(['class' => 'form-horizontal form-label-left', 'novalidate' => 'novalidate', '@submit.prevent' => 'komentaradd'])  !!}
  <div class="item form-group">
    {!! Form::label('komentar', 'Komentar', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-9 col-sm-9 col-xs-12">
      {!! Form::text('komentar', '@{{ komentar }}', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'komentar', 'required' => 'required', 'v-model' => 'komentar']) !!}
    </div>
  </div>
  <div class="item form-group">
    {!! Form::label('imageberita', 'Gambar', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12', '@submit.prevent' => 'komentaradd']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input name="imageberita" type="file" id="imageberita" @change="onchangeimage" style="width:300px;">
      <div v-show="imageberitashow"><br><img src="" id="imagepict" width="260px" height="200px" class="pointer"></div>
    </div>
  </div>
  
<div class="demo" v-show="loadingshow">
  <svg class="loader">
    <filter id="blur">
      <fegaussianblur in="SourceGraphic" stddeviation="2"></fegaussianblur>
    </filter>
    <circle cx="75" cy="75" r="60" fill="transparent" stroke="#F4F519" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>
  </svg>
  <svg class="loader loader-2">
    <circle cx="75" cy="75" r="60" fill="transparent" stroke="#DE2FFF" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>
  </svg>
  <svg class="loader loader-3">
    <circle cx="75" cy="75" r="60" fill="transparent" stroke="#FF5932" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>
  </svg>
  <svg class="loader loader-4">
    <circle cx="75" cy="75" r="60" fill="transparent" stroke="#E97E42" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>
  </svg>
  <svg class="loader loader-5">
    <circle cx="75" cy="75" r="60" fill="transparent" stroke="white" stroke-width="6" stroke-linecap="round" filter="url(#blur)"></circle>
  </svg>
  <svg class="loader loader-6">
    <circle cx="75" cy="75" r="60" fill="transparent" stroke="#00DCA3" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>
  </svg>
  <svg class="loader loader-7">
    <circle cx="75" cy="75" r="60" fill="transparent" stroke="purple" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>
  </svg>
  <svg class="loader loader-8">
    <circle cx="75" cy="75" r="60" fill="transparent" stroke="#AAEA33" stroke-width="6" stroke-linecap="round" stroke-dasharray="385" stroke-dashoffset="385" filter="url(#blur)"></circle>
  </svg>
</div> 
  
  <div class="item form-group">
    <div class="col-md-6 col-md-offset-3">
      {!! Form::Submit('Komentar', ['class' => 'btn btn-primary']) !!}
    </div>
  </div>
  {!! Form::close() !!}
  </div></div></div></div>

@if(Auth::check())
@if (!Auth::user()->isadmin)
  <div class="row" v-show="viewkomentaraddbutton">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel" style="text-align:center">
      <button class="btn btn-success" @click="viewlayoutaddkomentar">Komentar</button>
      </div>
    </div>
  </div>
@endif
@endif
</div>

  </div>
</div>
<!-- /page content -->
@endsection
@section('javascript')
<script>
candelete = true;
var komentarlistlayout = new Vue({
  el: '#komentarlistlayout',
  data: {
    komentars:[],
    viewkomentars:false,
  },
  methods:{
    getkomentarlist: function() {
      elem = this;
      elem.viewkomentars = false;
      elem.$http.get('{{ URL::to('komentarlist-'.$berita->id) }}').then(function(response){
	elem.komentars.splice(0, elem.komentars.length);
	if (response != null && response.body.length > 0) {
	  var jsonObj = $.parseJSON(response.body);
	  jsonObj.map( function(item) {
	    elem.komentars.push(item);
	  });
	}
	if (elem.komentars.length > 0) {
	  elem.viewkomentars = true;
	}
      });
    },
    batalhapuskomentar : function(komentar) {
      komentar.showhapusbutton = true;
      komentar.showlayoutconfirmhapus = false;
    },
    askhapuskomentar : function(komentar) {
      komentar.showhapusbutton = false;
      komentar.showlayoutconfirmhapus = true;
    },
    ralatkomentar: function(komentar) {
      komentar.viewkomentar = false;
      komentar.vieweditkomentar = true;
      komentarvuew.viewkomentaraddbutton = false;
      komentar.komentaredit = komentar.komentar;
      if (komentar.gambar.length > 0) {
	komentar.imageberitashow = true;
	komentar.vdelimagebutton = true;
      }
    },
    onchangeimagekomentar: function(komentar, evue) {
      thefile = evue.target.files[0];
      if (thefile.size < 2000000) {
	var readImg = new FileReader();
	readImg.readAsDataURL(evue.target.files[0]);
	readImg.onload = function(e) {
		$('#imagepictedit'+komentar.id).attr('src',e.target.result);
	}
	komentar.imageberitashow = true;
	komentar.vdelimagebutton = true;
	validator.unmark( $('#imagepictedit'+komentar.id));
	komentar.saveimagekomentar = true;
      } else {
	komentar.imageberitashow = false;
	komentar.saveimagekomentar = false;
	validator.mark($('#imagepictedit'+komentar.id), 'Gambar Maksimal 2MB');
      }
    },
    hapusgambar: function(komentar) {
      komentar.imageberitashow = false;
      komentar.vdelimagebutton = false;
      $('#komentargambar'+komentar.id).val('');
      komentar.dohapusgambar = '1';
    },
    batalralat: function(komentar) {
      komentar.viewkomentar = true;
      komentar.vieweditkomentar = false;
      komentarvuew.viewkomentaraddbutton = true;
    },
    ralatkomentarprocess: function(komentar) {
      if (canaddkomen) {
	canaddkomen = false;
	elem = this;
	elem.loadingshow = true;
	var oData = new FormData();
	oData.append('_token', '{!! csrf_token() !!}');
	oData.append('idkomentar', komentar.id);
	oData.append('komentar', komentar.komentaredit);
	if (komentar.dohapusgambar == '1') {
	  oData.append('hapusgambar', '1');
	}
	var form = document.querySelector('#komentargambar'+komentar.id);
	if (komentar.saveimagekomentar) {
	  oData.append('gambar', form.files[0]);
	}
	elem.$http.post('{{ URL::to('addkomentar') }}',oData).then(function(response){
	  $('#komentargambar'+komentar.id).val('');
	  canaddkomen = true;
	  komentarlistlayout.getkomentarlist();
	  komentarvuew.viewkomentaraddbutton = true;
	});
      }
    },
    dohapuskomentar: function(komentar) {
    if (candelete) {
      candelete = false;
      elem = this;
      elem.$http.post('{{ URL::to('komentar-hapus') }}', {_token: '{!! csrf_token() !!}', idkomentar:komentar.id }).then(function(response){
	$.each(elem.komentars, function(i){
	    if(elem.komentars[i] == komentar) {
		elem.komentars.splice(i,1);
		candelete = true;
		return false;
	    }
	});
      });
    }
  },
  }
});
komentarlistlayout.getkomentarlist();

canaddkomen = true;
var komentarvuew = new Vue({
  el: '#komentarlayout',
  data: {
    viewkomentaraddbutton:true,
    komentaraddlayout:false,
    imageberitashow:false,
    saveimage:false,
    loadingshow:false,
		komentar: '',
  },
  methods: {
    viewlayoutaddkomentar: function(){
      this.komentaraddlayout = true;
      this.viewkomentaraddbutton = false;
			this.imageberitashow = false;
			this.komentar = '';
			$('#imageberita').val('');
    },
    onchangeimage: function(evue){
      thefile = evue.target.files[0];
      if (thefile.size < 2000000) {
	var readImg = new FileReader();
	readImg.readAsDataURL(evue.target.files[0]);
	readImg.onload = function(e) {
		$('#imagepict').attr('src',e.target.result);
	}
	this.imageberitashow = true;
	validator.unmark( $('#imageberita'));
	this.viewhhapusbutton = true;
	this.saveimage = true;
      } else {
	this.saveimage = false;
	this.imageberitashow = false;
	validator.mark( $('#imageberita'), 'Gambar Maksimal 2MB');
      }
    },
    komentaradd: function() {
      if (canaddkomen) {
	canaddkomen = false;
	elem = this;
	elem.loadingshow = true;
	var oData = new FormData();
	oData.append('_token', '{!! csrf_token() !!}');
	oData.append('idberita', '{{ $berita->id }}');
	oData.append('komentar', elem.komentar);
	var form = document.querySelector('#imageberita');
	if (this.saveimage) {
	  oData.append('gambar', form.files[0]);
	}
	elem.$http.post('{{ URL::to('addkomentar') }}',oData).then(function(response){
	  $('#imageberita').val('');
	  elem.komentar = '';
	  elem.komentaraddlayout = false;
	  elem.viewkomentaraddbutton = true;
	  elem.loadingshow = false;
	  canaddkomen = true;
	  komentarlistlayout.getkomentarlist();
	});
      }
    },
  },
});

@if(Auth::check())
@if (Auth::user()->isadmin)

new Vue({
	el: '#adminoption',
	methods: {
		hapusnihberita: function (urlnext) {
			if (confirm('Apakah berita ini Dihapus')) {
				window.location = urlnext;
			}
		}
	}
});

@endif
@endif

</script>
@endsection