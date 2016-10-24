@extends('admin.layout')
@section('title', 'Surabaya Berita Populer')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main" id="pagevue" style="display:none;" v-show="firsttime">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-user"></i> Users</h3>
              </div>
            </div>
            <div class="clearfix"></div>

<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
    <div class="x_content">
		{!! Form::open(['class' => 'form-horizontal form-label-left', '@submit.prevent' => "loadusers"])  !!}
		<div class="item form-group">
			{!! Form::label('filter', 'Filter', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12']) !!}
			<div class="col-md-6 col-sm-6 col-xs-12">
				{!! Form::select('filter',['User Aktif' =>'User Aktif'
				, 'User Blokir' =>'User Blokir'
				, 'Semua User' =>'Semua User'
				], $filter, ['class' => 'form-control col-md-6 col-xs-6 pointer', 'v-model' => 'filter', '@change' => 'loadusers']) !!}
			</div>
		</div>
		<div class="item form-group">
			{!! Form::label('tampilkan', 'Tampilkan', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12', ]) !!}
			<div class="col-md-6 col-sm-6 col-xs-12">
				{!! Form::select('tampilkan',['Baru Login' =>'Baru Login'
				, 'Terlama Login' =>'Terlama Login'
				, 'Terbanyak Berita' =>'Terbanyak Berita'
				, 'Tersedikit Berita' =>'Tersedikit Berita'
				, 'Terbanyak Komentar' =>'Terbanyak Komentar'
				, 'Tersedikit Komentar' =>'Tersedikit Komentar'
				, 'Terbanyak Share' =>'Terbanyak Share'
				, 'Tersedikit Share' =>'Tersedikit Share'
				], $tampilkan, ['class' => 'form-control col-md-6 col-xs-6 pointer', 'v-model' => 'tampilkan', '@change' => 'loadusers']) !!}
			</div>
		</div>
		<div class="item form-group">
			{!! Form::label('pencarian', 'Pencarian', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12']) !!}
			<div class="col-md-6 col-sm-6 col-xs-12">
				{!! Form::text('pencarian', $pencarian, ['class' => 'form-control col-md-6 col-xs-6', 'v-model' => 'pencarian']) !!}
			</div>
		</div>
		{!! Form::close() !!}
		</div>
	</div>
</div></div>

<div class="row"><div class="col-md-12 col-sm-12 col-xs-12"><div class="x_panel"><div class="x_content"><div class="table-responsive">
	<table class="table table-striped jambo_table bulk_action" v-bind:class="blur">
	  <thead>
	    <tr class="headings">
	      <th>
		<input type="checkbox" id="check-all" class="flat">
	      </th>
	      <th class="column-title">Status</th>
	      <th class="column-title">N I K</th>
	      <th class="column-title">User Name</th>
	      <th class="column-title">Email</th>
	      <th class="column-title">Nama</th>
	      <th class="column-title">Terakhir Login</th>
	      <th class="column-title" style="text-align:right;">Jml. Berita</th>
	      <th class="column-title" style="text-align:right;">Jml. Komentar</th>
	      <th class="column-title" style="text-align:right;">Jml. Share</th>
	      <th class="bulk-actions" colspan="7">
		<li role="presentation" class="dropdown" style="list-style-type: none;">
                  <a class="dropdown-toggle info-number antoo" href="" class="" data-toggle="dropdown" aria-expanded="false" style="color:#fff; font-weight:500;">Tindakan ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                  <ul class="dropdown-menu dropdown-usermenu">
                    <li @click.stop.prevent="aktifkan"><a href=""><i class="fa fa-plus leftmenu"></i> Aktifkan</a></li>
                    <li @click.stop.prevent="blokir"><a href=""><i class="fa fa-remove red leftmenu"></i> Blokir</a></li>
                  </ul>
                </li>
	      </th>
	    </tr>
	  </thead>

	  <tbody>
	    <tr v-show="userdatas.length > 0" v-for="userdata in userdatas">
	      <td class="a-center ">
					<input type="checkbox" class="flat" name="table_records" data-userdataid="@{{ userdata.id }}">
	      </td>
	      <td><label class="label label-danger" v-show="!userdata.aktif">Blokir</label></td>
	      <td><a href="{{ URL::to('admin-userdetail') }}-@{{ userdata.id }}" style="text-decoration:underline;">@{{ userdata.nik }}</a></td>
	      <td>@{{ userdata.username }}</td>
	      <td>@{{ userdata.email }}</td>
	      <td>@{{ userdata.name }}</td>
	      <td>@{{ userdata.lastlogin }}</td>
	      <td align="right">@{{ userdata.jumlah_berita }}</td>
	      <td align="right">@{{ userdata.jumlah_komentar }}</td>
	      <td align="right">@{{ userdata.jumlah_share }}</td>
	      </td>
	    </tr>
	  </tbody>
	</table>
	<ul class="pagination paginationmee">
	  <li @click.stop.prevent="gopage(1)" v-show="gofirstpageshow"><a href="">&laquo;</a></li>
	  <li v-for="page in pages" v-bind:class="page.class" @click.stop.prevent="gopage(page.page)"><a href="">@{{ page.page }}</a></li>
	  <li @click.stop.prevent="golastpage()" v-show="golastpageshow"><a href="">&raquo;</a></li>
  </ul>
</div></div></div></div></div>

<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
    <div class="x_content">
		<h2 style="float:right;">Jumlah Users : @{{ totaluser }}</h2>
		</div>
	</div>
</div></div>

    </div>
</div>
        <!-- /page content -->

@endsection
@section('javascript')
<script>
canajaxprocess = true;
vm = new Vue({
  el:'#pagevue',
  data: {
    userdatas:[],
		listidselecteds:[],
    firsttime: true,
    pages:[],
    totalpage: 0,
    pagego: {{ $pagego }},
    gofirstpageshow: true,
    golastpageshow: true,
    blur:'',
		totaluser: 1,
    filter:'{{ $filter }}',
		tampilkan:'{{ $tampilkan }}',
		pencarian:'{{ $pencarian }}',
  },
  methods: {
    loadusers: function() {
			$('.column-title').show();
        $('.bulk-actions').hide();
      elem = this;
      elem.blur = 'blur';
      elem.$http.get('{{ URL::to('admin-users-table') }}?pagego='+elem.pagego
      +'&filter='+elem.filter
			+'&tampilkan='+elem.tampilkan
			+'&pencarian='+elem.pencarian
			).then(function(response){
			vm.clearlistidselecteds();
			elem.userdatas.splice(0, elem.userdatas.length);
			elem.userdatas = [];
			elem.pages.splice(0, elem.pages.length);
			elem.pages = [];
	if (response.body.length > 0) {
	    var jsonObj = $.parseJSON(response.body);
	    jsonObj.userdatas.map( function(item) {
	      elem.userdatas.push(item);
	    });

			elem.totaluser = jsonObj.totaluser;
      elem.totalpage = jsonObj.totalpage;
      startpage = 1;
      if (elem.pagego > 3 && elem.totalpage > 5) {
        if ((elem.pagego + 1) < elem.totalpage) {
          startpage = elem.pagego - 2;
        } else if (elem.pagego < elem.totalpage) {
          startpage = elem.pagego - 3;
        } else if (elem.pagego - 1 < elem.totalpage) {
          startpage = elem.pagego - 4;
        } else if (elem.pagego - 2 < elem.totalpage) {
          startpage = elem.pagego - 5;
        }
      }

      elem.gofirstpageshow = false;
      if (elem.totalpage > 5) {
        elem.gofirstpageshow = true;
        if (startpage == 1) {
          elem.gofirstpageshow = false;
        }
      }
      if (elem.totalpage > 1) {
        for (i = 0; i < 5; i++) {
          if (startpage == elem.pagego) classset = 'active';
          else classset = '';
          elem.pages.push({'page' : startpage, 'class' : classset });
          if (startpage == elem.totalpage) {
            i = 5;
          }
          startpage ++;
        }
      }

      elem.golastpageshow = false;
      if (elem.totalpage > 5) {
        elem.golastpageshow = true;
        if (startpage > elem.totalpage) {
          elem.golastpageshow = false;
        }
      }
			if (elem.pagego > elem.totalpage) {
				elem.pages.push({'page' : elem.pagego, 'class' : 'active' });
			}
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
				vm.listidselecteds.push($(this).data('userdataid'));
	    });
	    $('.bulk_action input').on('ifUnchecked', function () {
				checkState = '';
				$(this).parent().parent().parent().removeClass('selected');
				countChecked();
				deleteArrayValue(vm.listidselecteds, $(this).data('userdataid'));
	    });
	    $('.bulk_action input#check-all').on('ifChecked', function () {
				checkState = 'all';
				countChecked();
				vm.clearlistidselecteds();
				vm.userdatas.map(function(item) {
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
    gopage: function(pagenow) {
      elem.pagego = pagenow;
      vm.loadusers();
    },
    golastpage: function() {
      elem.pagego = elem.totalpage;
      vm.loadusers();
    },
		addlistid: function(id) {
			this.listidselecteds.push(id);
			console.log(this.listidselecteds);
		},
		clearlistidselecteds:function() {
			this.listidselecteds.splice(0, this.listidselecteds.length);
			this.listidselecteds = [];
		},
    aktifkan: function() {
      if (this.listidselecteds.length > 0 && canajaxprocess) {
				canajaxprocess = false;
				elem = this;
				elem.blur = 'blur';
				elem.$http.post('{{ URL::to('admin-aktifkanusers') }}', {ids: elem.listidselecteds, _token: '{!! csrf_token() !!}'}).then(function(response){
					canajaxprocess = true;
					vm.loadusers();
				});
			}
    },
    blokir: function() {
      if (this.listidselecteds.length > 0 && canajaxprocess) {
				canajaxprocess = false;
				elem = this;
				elem.blur = 'blur';
				elem.$http.post('{{ URL::to('admin-blokirusers') }}', {ids: elem.listidselecteds, _token: '{!! csrf_token() !!}'}).then(function(response){
					canajaxprocess = true;
					vm.loadusers();
				});
			}
    }
  }
});
vm.loadusers();
</script>
@endsection
