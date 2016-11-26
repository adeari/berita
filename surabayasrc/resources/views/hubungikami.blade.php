@extends('layout')
@section('title', 'Surabaya Digital City')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main" id="appcontent">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-phone"></i> Silahkan menghubungi kami</h3>
                <h3><small>Terima kasih atas kritik dan sarannya</small></h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
                    <h2>Silahkan isi data berikut untuk mengirimkan pesan anda</h2>
                    <div class="clearfix"></div>
                </div>
                  <div class="x_content">
                    <div class="row" v-show="showalertpesanterkirim"><div class="col-md-12"><div class="x_panel text-center"><h2>Pesan anda telah terkirim <span class="text-right red pointer" style="font-weight:bold;" @click="closepesanterkirim">X</span></h2></div></div></div>
                    {!! Form::open(['class' => 'form-horizontal form-label-left', '@submit.prevent' => "kirimpesan", 'id' => 'formdata'])  !!}
                    <div class="item form-group">
                      {!! Form::label('email', 'Email', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::email('email', '', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'email', 'required' => 'required', 'v-model' => 'email']) !!}
                      </div>
                    </div>
                    <div class="item form-group">
                      {!! Form::label('judul', 'Judul Pesan', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::text('judul', '', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'judul', 'required' => 'required', 'v-model' => 'judul']) !!}
                      </div>
                    </div>
                    <div class="item form-group">
                      {!! Form::label('pesan', 'Pesan', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::textarea('pesan', '', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'pesan', 'required' => 'required', 'v-model' => 'pesan']) !!}
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
                    <div class="item form-group" v-show="simpanbuttonshow">
                      {!! Form::label('', '', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::button('<i class=\'fa fa-paper-plane\'> </i> Kirim', ['class' => 'btn btn-lg btn-success', 'type' => 'submit']) !!}
                      </div>
                    </div>

                    {!! Form::close() !!}
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
$('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

menuvue.isloginactive = true;
var vue = new Vue({
    el: '#appcontent',
    data: {
	    loadingshow: false,
	    simpanbuttonshow: true,
	    cansave: true,
	    showalertpesanterkirim: false,
	    judul: '',
	    email: '',
	    pesan: '',
    },
    methods:{
	    kirimpesan: function(evue) {
	    elem = this;
	    if (validator.checkAll($('#formdata'))) {
    	if (elem.cansave) {
    		elem.cansave = false;
    		elem.simpanbuttonshow = false;
    		elem.loadingshow = true;
    		elem.$http.post('{{ URL::to('kirimpesansekarang') }}', {_token: '{!! csrf_token() !!}', email: elem.email,
          pesan: elem.pesan, judul: elem.judul}).then(function(response){
              elem.cansave = true;
              elem.showalertpesanterkirim = true;
              elem.simpanbuttonshow = true;
              elem.loadingshow = false;
          });
        }}
      },
      closepesanterkirim: function() {
        this.showalertpesanterkirim = false;
      },
    }
});

    </script>
@endsection
