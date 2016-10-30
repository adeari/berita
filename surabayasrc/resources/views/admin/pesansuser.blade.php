@extends('admin.layout')
@section('title', 'Admin - SurabayaDigitalCity')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main" id="pagevue" style="display:none;" v-show="firsttime">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-envelope"></i> <i class="fa fa-person"></i> Pesan User</h3>
              </div>
            </div>
            <div class="clearfix"></div>

<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
    <div class="x_content">
		{!! Form::open(['class' => 'form-horizontal form-label-left', '@submit.prevent' => "loadpesan"])  !!}
		<div class="item form-group">
			{!! Form::label('filter', 'Filter', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12']) !!}
			<div class="col-md-6 col-sm-6 col-xs-12">
				{!! Form::select('filter',['' =>'Tampilkan Semua Email'
				, 'Belum Dibalas' =>'Belum Dibalas'
				, 'Sudah Dibalas' =>'Sudah Dibalas'
				], $filter, ['class' => 'form-control col-md-6 col-xs-6 pointer', 'v-model' => 'filter', '@change' => 'loadpesan']) !!}
			</div>
		</div>
		<div class="item form-group">
			{!! Form::label('tampilkan', 'Tampilkan', ['class' => 'control-label col-md-2 col-sm-2 col-xs-12', ]) !!}
			<div class="col-md-6 col-sm-6 col-xs-12">
				{!! Form::select('tampilkan',['Email Terbaru ke Lama' =>'Email Terbaru ke Lama'
				, 'Email Lama ke Baru' =>'Email Lama ke Baru'
				], $tampilkan, ['class' => 'form-control col-md-6 col-xs-6 pointer', 'v-model' => 'tampilkan', '@change' => 'loadpesan']) !!}
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

<div class="row" v-for="pesan in pesans"><div class="col-md-12 col-sm-12 col-xs-12"><div class="x_panel">
    <div class="x_title"><h2>@{{ pesan.judul }}</h2><div class="clearfix"></div></div>
    <div class="x_content">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <p><b>@{{ pesan.created_at }}</b></p>
        <p><span style="font-size:22px;color:brown;"><i class="fa fa-envelope-o"></i> @{{ pesan.email }}</span></p>
        <p>@{{ pesan.pesan }}</p>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 tile_stats_count">
        {!! Form::open(['class' => 'form-horizontal form-label-left', '@submit.prevent' => "balaspesan(pesan)"])  !!}
        <div class="item form-group" v-show="pesan.tanggalbalasan.length > 0">
    			{!! Form::label('tanggalbalasan', 'Tanggal Email di Balas: @{{ pesan.tanggalbalasan }}', ['class' => 'control-label']) !!}
        </div>
        <div class="item form-group">
    			{!! Form::label('pesanbalasan', 'Balas Pesan', ['class' => 'control-label']) !!}
        </div>
        <div class="item form-group" v-show="pesan.prosespengiriman"><div class="demo">
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
    			{!! Form::textarea('pesanbalasan', '@{{ pesan.pesanbalasan }}', ['class' => 'form-control',  'rows' => 5, 'v-model' => 'pesan.pesanbalasan']) !!}
        </div>
        <div class="item form-group" v-show="!pesan.prosespengiriman">
    			{!! Form::button('<i class="fa fa-paper-plane-o"></i> Kirim Balasan', ['class' => 'btn btn-success', 'type' => 'submit']) !!}
        </div>
        {!! Form::close() !!}
      </div>
    </div>
</div></div></div>

<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
    <div class="x_content">
		<h2 style="float:right;">Jumlah Pesan : @{{ totalpesan }}</h2>
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
    pesans:[],
		listidselecteds:[],
    firsttime: true,
    pages:[],
    totalpage: 0,
    pagego: {{ $pagego }},
    gofirstpageshow: true,
    golastpageshow: true,
    blur:'',
		totalpesan: 1,
		filter:'{{ $filter }}',
		tampilkan:'{{ $tampilkan }}',
		pencarian:'{{ $pencarian }}',
  },
  methods: {
    loadpesan: function() {
			$('.column-title').show();
        $('.bulk-actions').hide();
      elem = this;
      elem.blur = 'blur';
      elem.$http.get('{{ URL::to('admin-pesanuser-table') }}?pagego='+elem.pagego
			+'&filter='+elem.filter
			+'&tampilkan='+elem.tampilkan
			+'&pencarian='+elem.pencarian
			).then(function(response){
			vm.clearlistidselecteds();
			elem.pesans.splice(0, elem.pesans.length);
			elem.pesans = [];
			elem.pages.splice(0, elem.pages.length);
			elem.pages = [];
	if (response.body.length > 0) {
	    var jsonObj = $.parseJSON(response.body);
	    jsonObj.pesans.map( function(item) {
	      elem.pesans.push(item);
	    });

			elem.totalpesan = jsonObj.totalpesan;
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
	}
  elem.blur = '';
      });
    },
    gopage: function(pagenow) {
      elem.pagego = pagenow;
      vm.loadpesan();
    },
    golastpage: function() {
      elem.pagego = elem.totalpage;
      vm.loadpesan();
    },
		addlistid: function(id) {
			this.listidselecteds.push(id);
			console.log(this.listidselecteds);
		},
		clearlistidselecteds:function() {
			this.listidselecteds.splice(0, this.listidselecteds.length);
			this.listidselecteds = [];
		},
    balaspesan: function(pesan) {
      if (canajaxprocess && pesan.pesanbalasan.length > 0) {
        canajaxprocess = false;
        pesan.prosespengiriman = true;
        this.$http.post('{{ URL::to('admin-balaspesan') }}' , {_token: '{!! csrf_token() !!}'
          , pesanbalasan: pesan.pesanbalasan
          , pesanid: pesan.id
        }).then(function(response) {
          if (response.body.length > 0) {
            canajaxprocess = true;
            pesan.prosespengiriman = false;
            jsonresponse = JSON.parse(response.body);
            pesan.tanggalbalasan = jsonresponse.tanggalbalasan;
          }
        });
      }
    }
  }
});
vm.loadpesan();
</script>
@endsection
