@extends('admin.layout')
@section('title', 'Admin - SurabayaDigitalCity')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main" id="pagevue" style="display:none;" v-show="firsttime">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-trophy"></i> Berita</h3>
              </div>
            </div>
            <div class="clearfix"></div>

<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
    <div class="x_content">
		{!! Form::open(['class' => 'form-horizontal form-label-left', '@submit.prevent' => "loadberita"])  !!}
		<div class="item form-group">
			{!! Form::label('filter', 'Filter', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12']) !!}
			<div class="col-md-6 col-sm-6 col-xs-12">
				{!! Form::select('filter',['' =>'Tampilkan Semua Berita'
				, 'Populer' =>'Tampilkan Populer saja'
				, 'Umum' =>'Tampilkan Artikel Umum'
				, 'Acara' =>'Tampilkan Artikel Acara'
				, 'Pengaduan' =>'Tampilkan Artikel Pengaduan'
				], $filter, ['class' => 'form-control col-md-6 col-xs-6 pointer', 'v-model' => 'filter', '@change' => 'loadberita']) !!}
			</div>
		</div>
		<div class="item form-group">
			{!! Form::label('tampilkan', 'Tampilkan', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12', ]) !!}
			<div class="col-md-6 col-sm-6 col-xs-12">
				{!! Form::select('tampilkan',['Berita Terbaru ke Berita Terlama' =>'Berita Terbaru ke Berita Terlama'
				, 'Berita Terlama ke Berita Terbaru' =>'Berita Terlama ke Berita Terbaru'
				, 'Komentar Terbanyak ke sedikit' =>'Komentar Terbanyak ke sedikit'
				, 'Komentar Sedikit ke banyak' =>'Komentar Sedikit ke banyak'
				, 'Terbanyak di share ke sedikit' =>'Terbanyak di share ke sedikit'
				, 'Sedikit di share ke banyak' =>'Sedikit di share ke banyak'
				], $tampilkan, ['class' => 'form-control col-md-6 col-xs-6 pointer', 'v-model' => 'tampilkan', '@change' => 'loadberita']) !!}
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
	    <tr v-show="beritas.length > 0" v-for="berita in beritas">
	      <td class="a-center ">
					<input type="checkbox" class="flat" name="table_records" data-beritaid="@{{ berita.id }}">
	      </td>
	      <td>
					<i class="fa fa-star red" v-show="berita.populer"></i>
					<label class="label" v-bind:class="berita.kategoriclass">@{{ berita.kategori }}</label>
				</td>
	      <td><a href="{{ URL::to('admin-beritadetail-') }}@{{ berita.id }}-admin-berita" style="text-decoration:underline;">@{{ berita.judul }}</a></td>
	      <td>@{{ berita.jumlah_komentar }}</td>
	      <td>@{{ berita.jumlah_share }}</td>
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
		<h2 style="float:right;">Jumlah Berita : @{{ totalberita }}</h2>
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
    beritas:[],
		listidselecteds:[],
    firsttime: true,
    pages:[],
    totalpage: 0,
    pagego: {{ $pagego }},
    gofirstpageshow: true,
    golastpageshow: true,
    blur:'',
		totalberita: 1,
		filter:'{{ $filter }}',
		tampilkan:'{{ $tampilkan }}',
		pencarian:'{{ $pencarian }}',
  },
  methods: {
    loadberita: function() {
			$('.column-title').show();
        $('.bulk-actions').hide();
      elem = this;
      elem.blur = 'blur';
      elem.$http.get('{{ URL::to('admin-berita-table') }}?pagego='+elem.pagego
			+'&filter='+elem.filter
			+'&tampilkan='+elem.tampilkan
			+'&pencarian='+elem.pencarian
			).then(function(response){
			vm.clearlistidselecteds();
			elem.beritas.splice(0, elem.beritas.length);
			elem.beritas = [];
			elem.pages.splice(0, elem.pages.length);
			elem.pages = [];
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

			elem.totalberita = jsonObj.totalberita;
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
    gopage: function(pagenow) {
      elem.pagego = pagenow;
      vm.loadberita();
    },
    golastpage: function() {
      elem.pagego = elem.totalpage;
      vm.loadberita();
    },
		addlistid: function(id) {
			this.listidselecteds.push(id);
			console.log(this.listidselecteds);
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
						vm.loadberita();
					});
				}
			}
		},
  }
});
vm.loadberita();
</script>
@endsection
