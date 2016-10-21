@extends('admin.layout')
@section('title', 'Surabaya Berita Populer')
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



<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_content">
      <div class="table-responsive">
	<table class="table table-striped jambo_table bulk_action">
	  <thead>
	    <tr class="headings">
	      <th>
		<input type="checkbox" id="check-all" class="flat">
	      </th>
	      <th class="column-title">Judul Berita </th>
	      <th class="column-title">Jumlah Komentar</th>
	      <th class="column-title">Jumlah Share</th>
	      <th class="bulk-actions" colspan="7">
		<li role="presentation" class="dropdown" style="list-style-type: none;">
                  <a class="dropdown-toggle info-number antoo" href="javascript:;" class="" data-toggle="dropdown" aria-expanded="false" style="color:#fff; font-weight:500;">Pilihan ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                  <ul class="dropdown-menu dropdown-usermenu">
                    <li><a href="javascript:;"><i class="fa fa-remove leftmenu"></i> Hapus</a></li>
                  </ul>
                </li>

	      </th>
	    </tr>
	  </thead>

	  <tbody>
	    <tr v-show="beritas.length > 0" v-for="berita in beritas" v-bind:class="blur">
	      <td class="a-center ">
		<input type="checkbox" class="flat" name="table_records">
	      </td>
	      <td class=" ">@{{ berita.judul }}</td>
	      <td class=" ">@{{ berita.jumlah_komentar }}</td>
	      <td class=" ">@{{ berita.jumlah_share }}</td>
	      </td>
	    </tr>


	  </tbody>
	</table>
	<ul class="pagination paginationmee">
	  <li @click.stop.prevent="gopage(1)" v-show="gofirstpageshow"><a href="">&laquo;</a></li>
	  <li v-for="page in pages" v-bind:class="page.class" @click.stop.prevent="gopage(page.page)"><a href="">@{{ page.page }}</a></li>
	  <li @click.stop.prevent="golastpage()" v-show="golastpageshow"><a href="">&raquo;</a></li>
  </ul>
      </div>
    </div>
</div>

    </div>
</div>
        <!-- /page content -->

@endsection
@section('javascript')
<script>
vm = new Vue({
  el:'#pagevue',
  data: {
    beritas:[],
    firsttime: false,
    pages:[],
    totalpage: 0,
    pagego: 1,
    gofirstpageshow: true,
    golastpageshow: true,
    blur:'',
  },
  methods: {
    loadberita: function() {
      elem = this;
      elem.blur = 'blur';
      elem.$http.get('{{ URL::to('admin-berita-table') }}?pagego='+elem.pagego).then(function(response){
	elem.beritas.splice(0, elem.beritas.length);
	elem.beritas = [];
  elem.pages.splice(0, elem.pages.length);
	elem.pages = [];
	if (response.body.length > 0) {
	    var jsonObj = $.parseJSON(response.body);
	    jsonObj.beritas.map( function(item) {
	      elem.beritas.push(item);
	    });

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
	elem.$nextTick(function() {
	    $('input.flat').iCheck({
		checkboxClass: 'icheckbox_flat-green',
		radioClass: 'iradio_flat-green'
	    });
	    $('.bulk_action input').on('ifChecked', function () {
		checkState = '';
		$(this).parent().parent().parent().addClass('selected');
		countChecked();
	    });
	    $('.bulk_action input').on('ifUnchecked', function () {
		checkState = '';
		$(this).parent().parent().parent().removeClass('selected');
		countChecked();
	    });
	    $('.bulk_action input#check-all').on('ifChecked', function () {
		checkState = 'all';
		countChecked();
	    });
	    $('.bulk_action input#check-all').on('ifUnchecked', function () {
		checkState = 'none';
		countChecked();
	    });
      if (!elem.firsttime) elem.firsttime=true;
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
    }
  }
});
vm.loadberita();
</script>
@endsection
