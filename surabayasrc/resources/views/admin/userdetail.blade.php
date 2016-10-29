@extends('admin.layout')
@section('title', 'Surabaya Berita Populer')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main" id="pagevue" style="display:none;" v-show="firsttime">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <a href="{{ URL::to('admin-users') }}" style="float:left;text-align:left;margin:0 20px 0 0;"><h3 class="blue"><i class="fa fa-arrow-left"></i> Kembali</h3></a>
                <h3 style="float:left;text-align:left;"><i class="fa fa-user"></i> {{ $userdata->nik }} <small>{{ $userdata->username }}</small></h3>
              </div>
              @if (!$userdata->aktif)
            		<label class="label label-danger textbig">Blokir</label>
            	@endif

              <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle rightadminmenu" data-toggle="dropdown" aria-expanded="false">
                  <button class="btn btn-success"><i class="fa fa-gear"></i> Tindakan <span class=" fa fa-angle-down"></span></button>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  @if (!$userdata->aktif)
                  <li><a href="{{ URL::to('admin-aktifkanuser-'.$userdata->id) }}"><i class="fa fa-plus leftmenu"></i>  Aktifkan</a></li>
                  @else
                  <li><a href="{{ URL::to('admin-blokiruser-'.$userdata->id) }}"><i class="fa fa-remove red leftmenu"></i> Blokir</a></li>
                  @endif
<li @click.stop.prevent="showkirimpesan"><a href=""><i class="fa fa-envelope-o blue leftmenu"></i> Kirim Pesan</a></li>
                </ul>
              </li>
              </ul>
            </div>
            <div class="clearfix"></div>
<div class="row" v-show="showalertpesanterkirim"><div class="col-md-12"><div class="x_panel text-center"><h2>Pesan terkirim <span class="text-right red pointer" style="font-weight:bold;" @click="closepesanterkirim">X</span></h2></div></div></div>
<div class="row" v-show="showlayoutpesan"><div class="col-md-12"><div class="x_panel">
  <div class="x_title"><h2><i class="fa fa-envelope-o blue"></i> Kirim Pesan</h2><div class="clearfix"></div></div>
  <div class="content">

    {!! Form::open(['class' => 'form-horizontal form-label-left', 'novalidate' => 'novalidate', '@submit.prevent' => 'kirimpesan', 'id' => 'formkirimpesan'])  !!}
    <div class="item form-group">
      {!! Form::label('judul', 'Judul Pesan', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
      <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('judul', '', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'judul', 'required' => 'required', 'v-model' => 'judulpesan']) !!}
      </div>
    </div>
    <div class="item form-group">
      {!! Form::label('pesan', 'Pesan', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
      <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::textarea('pesan', '', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'judul', 'required' => 'required', 'v-model' => 'pesanpesan', 'rows' => 4]) !!}
      </div>
    </div>
    <div class="row loadernaikup" v-show="loadingshowpesan">
    <div class="demo">
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
    </div></div>
    <div class="item form-group">
      <div class="col-md-3 col-sm-3 col-xs-12"></div>
      <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::submit('Kirim', ['class' => 'btn btn-success']) !!}
        {!! Form::button('Batal', ['class' => 'btn btn-danger', '@click' => 'batalkirimpesan']) !!}
      </div>
    </div>
    {!! Form::close() !!}

  </div>
  </div></div></div>
<div class="row"><div class="col-md-12"><div class="x_panel"><div class="x_content">
  {!! Form::open(['class' => 'form-horizontal form-label-left', '@submit.prevent' => "loadberita"])  !!}
  <div class="row" style="text-align:center;">
    <img src="{{ (empty($userdata->gambar) ? 'public/imagesystem/user.png' : 'public/image/'.$userdata->gambar) }}" style="width:300px;margin:0 0 0 -40px;" class="img-circle profile_img"><br>
  </div>
  <div class="item form-group">
    {!! Form::label('name', 'User Name', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12']) !!}
    {!! Form::label('name', $userdata->name, ['class' => 'control-label col-md-9 col-sm-9 col-xs-12 blue', 'style' => 'text-align:left;']) !!}
  </div>
  <div class="item form-group">
    {!! Form::label('name', 'Password', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12']) !!}
    {!! Form::label('name', $userdata->realpassword, ['class' => 'control-label col-md-9 col-sm-9 col-xs-12 blue', 'style' => 'text-align:left;']) !!}
  </div>
  <div class="item form-group">
    {!! Form::label('name', 'Terakhir Login', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12']) !!}
    {!! Form::label($userdata->lastloginshow, $userdata->lastloginshow, ['class' => 'control-label col-md-9 col-sm-9 col-xs-12', 'style' => 'text-align:left;']) !!}
  </div>
  <div class="item form-group">
    {!! Form::label('name', 'Nama', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12']) !!}
    {!! Form::label($userdata->name, $userdata->name, ['class' => 'control-label col-md-9 col-sm-9 col-xs-12', 'style' => 'text-align:left;']) !!}
  </div>
  <div class="item form-group">
    {!! Form::label('name', 'N I K', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12']) !!}
    {!! Form::label($userdata->nik, $userdata->nik, ['class' => 'control-label col-md-9 col-sm-9 col-xs-12', 'style' => 'text-align:left;']) !!}
  </div>
  <div class="item form-group">
    {!! Form::label('email', 'Email', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12']) !!}
    {!! Form::label($userdata->email, $userdata->email, ['class' => 'control-label col-md-9 col-sm-9 col-xs-12', 'style' => 'text-align:left;']) !!}
  </div>
  <div class="item form-group">
    {!! Form::label('name', 'Jumlah Berita', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12']) !!}
    {!! Form::label($userdata->jumlah_berita, $userdata->jumlah_berita, ['class' => 'control-label col-md-9 col-sm-9 col-xs-12', 'style' => 'text-align:left;']) !!}
  </div>
  <div class="item form-group">
    {!! Form::label('name', 'Jumlah Komentar', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12']) !!}
    {!! Form::label($userdata->jumlah_komentar, $userdata->jumlah_komentar, ['class' => 'control-label col-md-9 col-sm-9 col-xs-12', 'style' => 'text-align:left;']) !!}
  </div>
  <div class="item form-group">
    {!! Form::label('name', 'Jumlah Share', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12']) !!}
    {!! Form::label($userdata->jumlah_share, $userdata->jumlah_share, ['class' => 'control-label col-md-9 col-sm-9 col-xs-12', 'style' => 'text-align:left;']) !!}
  </div>
  {!! Form::close() !!}
</div></div></div></div>

<div class="row" v-show="beritas.length > 0"><div class="col-md-12"><div class="x_panel">
  <div class="x_title"><h2>Berita <small>{{ $userdata->username }}</small></h2><div class="clearfix"></div></div>
  <div class="content">
    <table class="table table-striped jambo_table bulk_action" v-bind:class="blur">
  	  <thead>
  	    <tr class="headings">
  	      <th>
  		<input type="checkbox" id="check-all" class="flat">
  	      </th>
  	      <th class="column-title">Kategori</th>
  	      <th class="column-title">Judul Berita </th>
  	      <th class="column-title">Jumlah Komentar</th>
  	      <th class="column-title">Jumlah Share</th>
  	      <th class="bulk-actions" colspan="7">
        		<li role="presentation" class="dropdown" style="list-style-type: none;">
              <a class="dropdown-toggle info-number antoo" href="" class="" data-toggle="dropdown" aria-expanded="false" style="color:#fff; font-weight:500;">Tindakan ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
              <ul class="dropdown-menu dropdown-usermenu">
                <li @click.stop.prevent="populerkan"><a href=""><i class="fa fa-star red leftmenu"></i> Populerkan</a></li>
                <li @click.stop.prevent="batalpopulerkan"><a href=""><i class="fa fa-star-o leftmenu"></i> Batal Populer</a></li>
        				<li @click.stop.prevent="hapusberita"><a href=""><i class="fa fa-remove leftmenu"></i> Hapus</a></li>
              </ul>
            </li>
  	      </th>
  	    </tr>
  	  </thead>

  	  <tbody>
  	    <tr v-for="berita in beritas">
  	      <td class="a-center ">
  					<input type="checkbox" class="flat" name="table_records" data-beritaid="@{{ berita.id }}">
  	      </td>
  	      <td>
  					<i class="fa fa-star red" v-show="berita.populer"></i>
  					<label class="label" v-bind:class="berita.kategoriclass">@{{ berita.kategori }}</label>
  				</td>
  	      <td><a href="{{ URL::to('admin-beritadetail-') }}@{{ berita.id }}-admin-userdetail-{{ $userdata->id }}" style="text-decoration:underline;">@{{ berita.judul }}</a></td>
  	      <td>@{{ berita.jumlah_komentar }}</td>
  	      <td>@{{ berita.jumlah_share }}</td>
  	      </td>
  	    </tr>
  	  </tbody>
  	</table>
  </div>
</div></div></div>

    </div>
</div>
        <!-- /page content -->

@endsection
@section('javascript')
<script>
$('form')
  .on('blur', 'input[required], input.optional, select.required', validator.checkField)
  .on('change', 'select.required', validator.checkField)
  .on('keypress', 'input[required][pattern]', validator.keypress);

$('.multi.required').on('keyup blur', 'input', function() {
  validator.checkField.apply($(this).siblings().last()[0]);
});
canajaxprocess = true;
vm = new Vue({
  el: '#pagevue',
  data: {
    firsttime:true,
    listidselecteds:[],
    blur:'',
    beritas: [],
    showlayoutpesan:false,
    pesanpesan:'',
    judulpesan:'',
    showalertpesanterkirim: false,
    loadingshowpesan: false,
  },
  methods: {
    loadberita: function() {
			$('.column-title').show();
        $('.bulk-actions').hide();
      elem = this;
      elem.blur = 'blur';
      elem.$http.get('{{ URL::to('admin-beritainuser-table-'.$userdata->id) }}').then(function(response){
			vm.clearlistidselecteds();
			elem.beritas.splice(0, elem.beritas.length);
			elem.beritas = [];
	if (response.body.length > 0) {
	    var jsonObj = $.parseJSON(response.body);
	    jsonObj.beritas.map( function(item) {
				if (item.kategori == 'Umum') {
					item.kategoriclass = 'label-info';
				} else if (item.kategori == 'Acara') {
					item.kategoriclass = 'label-success';
				} else if (item.kategori == 'Pengaduan') {
					item.kategoriclass = 'label-primary';
				} else {
					item.kategoriclass = 'label-danger';
				}
	      elem.beritas.push(item);
	    });
	}
  elem.blur = '';
	elem.$nextTick(function() {
	    $('input.flat').iCheck({
		checkboxClass: 'icheckbox_flat-green',
		radioClass: 'iradio_flat-green'
	    });
	    $('.bulk_action input').on('ifChecked', function () {
				checkState = '';
				$(this).parent().parent().parent().addClass('selected');
				countChecked();
				vm.listidselecteds.push($(this).data('beritaid'));
	    });
	    $('.bulk_action input').on('ifUnchecked', function () {
				checkState = '';
				$(this).parent().parent().parent().removeClass('selected');
				countChecked();
				deleteArrayValue(vm.listidselecteds, $(this).data('beritaid'));
	    });
	    $('.bulk_action input#check-all').on('ifChecked', function () {
				checkState = 'all';
				countChecked();
				vm.clearlistidselecteds();
				vm.beritas.map(function(item) {
					vm.listidselecteds.push(item.id);
				});
	    });
	    $('.bulk_action input#check-all').on('ifUnchecked', function () {
				checkState = 'none';
				countChecked();
				vm.clearlistidselecteds();
	    });
	});

      });
    },
    clearlistidselecteds:function() {
      this.listidselecteds.splice(0, this.listidselecteds.length);
      this.listidselecteds = [];
    },
    populerkan: function() {
      if (this.listidselecteds.length > 0 && canajaxprocess) {
        canajaxprocess = false;
        elem = this;
        elem.blur = 'blur';
        elem.$http.post('{{ URL::to('admin-populerkanberitas') }}', {ids: elem.listidselecteds, _token: '{!! csrf_token() !!}'}).then(function(response){
          canajaxprocess = true;
          vm.loadberita();
        });
      }
    },
    batalpopulerkan: function() {
      if (this.listidselecteds.length > 0 && canajaxprocess) {
        canajaxprocess = false;
        elem = this;
        elem.blur = 'blur';
        elem.$http.post('{{ URL::to('admin-batalpopulerkanberitas') }}', {ids: elem.listidselecteds, _token: '{!! csrf_token() !!}'}).then(function(response){
          canajaxprocess = true;
          vm.loadberita();
        });
      }
    },
    hapusberita: function() {
      if (this.listidselecteds.length > 0  && canajaxprocess) {
        if (confirm('Ingin menghapus berita?')) {
          elem.blur = 'blur';
          canajaxprocess = false;
          elem = this;
          elem.$http.post('{{ URL::to('admin-deleteberitas') }}', {ids: elem.listidselecteds, _token: '{!! csrf_token() !!}'}).then(function(response){
            canajaxprocess = true;
            location.reload();
          });
        }
      }
    },
    showkirimpesan: function() {
      this.showlayoutpesan = true;
      this.showalertpesanterkirim = false;
      this.judulpesan = '';
      this.pesanpesan = '';
    },
    batalkirimpesan: function() {
      this.showlayoutpesan = false;
      this.showalertpesanterkirim = false;
      elem.loadingshowpesan = false;
    },
    kirimpesan: function() {
      if (validator.checkAll($('#formkirimpesan'))) {
        if (canajaxprocess) {
          canajaxprocess = false;
          elem = this;
          elem.loadingshowpesan = true;
          elem.$http.post('{{ URL::to('admin-kirimpesanuser-'.$userdata->id) }}', {_token: '{!! csrf_token() !!}', judul: elem.judulpesan, pesan: elem.pesanpesan, userid: {{ $userdata->id }}}).then(function(response){
            elem.batalkirimpesan();
            this.showalertpesanterkirim = true;
            canajaxprocess = true;
          });
        }
      }
    },
    closepesanterkirim: function() {
      this.showalertpesanterkirim = false;
    }
  },
});
vm.loadberita();
</script>
@endsection
