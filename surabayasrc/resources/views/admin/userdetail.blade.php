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
<li @click="showkirimpesan"><a href=""><i class="fa fa-remove red leftmenu"></i> Kirim Pesan</a></li>                  
                </ul>
              </li>
              </ul>

            </div>
            <div class="clearfix"></div>

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
canajaxprocess = true;
vm = new Vue({
  el: '#pagevue',
  data: {
    firsttime:true,
    listidselecteds:[],
    blur:'',
    beritas: [],
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
  },
});
vm.loadberita();
</script>
@endsection
