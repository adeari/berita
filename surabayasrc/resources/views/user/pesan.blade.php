@extends('layout')
@section('title', 'Surabaya Digital City')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main" id="pagehere">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-leaf"></i> Terima kasih telah mendaftar di web ini</h3>
              </div>
            </div>
            <div class="clearfix"></div>

<div class="row"><div class="col-md-12 col-sm-12 col-xs-12"><div class="x_panel"><div class="x_content">
{!! $pesan !!}
</div></div></div></div>

<div v-show="pesansaya.length > 0">
<div class="row" v-for="pesan in pesansaya"><div class="col-md-12 col-sm-12 col-xs-12"><div class="x_panel">
  <div class="x_title">
    <h2>@{{ pesan.judul }}</h2>
    <ul class="nav navbar-right"><li><a class="close-link pointer red" @click="hapusini(pesan.id)"><i class="fa fa-close" style="text-align:right;"></i></a></li> </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    @{{ pesan.pesan }}
  </div>
</div></div></div>
</div>
          </div>
        </div>
        <!-- /page content -->

@endsection
@section('javascript')
<script>
new Vue({
  el: '#pagehere',
  data:{
    pesansaya:[{!! $pesansaya !!}]
  },
  methods: {
    hapusini: function(id) {
      this.$http.post('{{ URL::to('hapuspesan') }}-'+id , {_token: '{!! csrf_token() !!}'});
    }
  }
});
</script>
@endsection
