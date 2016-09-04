@extends('layout')
@section('title', 'Surabaya Berita Populer')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-key"></i> Login</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    {!! Form::open(['class' => 'form-horizontal form-label-left', 'novalidate' => 'novalidate', '@submit.prevent' => 'onsubmit', 'id' => 'formdata'])  !!}
                    <div class="item form-group">
		      {!! Form::label('usernamenik', 'NIK / User Name', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
			  {!! Form::text('usernamenik','', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'usernamenik', 'required' => 'required', 'v-model' => 'usernamenik']) !!}
                        </div>
                      </div>
                    <div class="item form-group">
		      {!! Form::label('password', 'Password', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        <div class="col-md-6 col-sm-6 col-xs-12">
			  {!! Form::password('password',['class' => 'form-control', 'id' => 'password', 'required' => 'required', 'v-model' => 'password']) !!}
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
                      <div class="ln_solid"></div>
                      <div class="form-group" v-show="simpanbuttonshow">
                        <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success">Login</button>
@if ($viewdaftar)                        
                        <a href="{{ URL::to('daftar') }}" class="btn btn-warning">Daftar</a>
@endif
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
menuvue.isloginactive = true;
var vue = new Vue({
    el: '#appcontent',
    data: {
	    loadingshow: false,
	    simpanbuttonshow: true,
	    usernamenik: '',
    },
    methods:{
	    onsubmit: function(evue) {
	      elem = this;
	      
	      if (validator.checkAll($('#formdata'))) {
	      validator.unmark( $('#usernamenik'));
	      validator.unmark( $('#password'));
	      elem.simpanbuttonshow = false;
		elem.loadingshow = true;
		var oData = new FormData();
		  oData.append('usernamenik', elem.usernamenik);
		  oData.append('password', elem.password);
		  oData.append('_token', '{!! csrf_token() !!}');
		  elem.$http.post('{{ URL::to('ceklogin') }}',oData).then(function(response){
		    if (response.body == 1) {
		      location = '/';
		    } else {
		      validator.mark( $('#usernamenik'), 'Tidak sesuai');
		      validator.mark( $('#password'), 'Tidak sesuai');
		    }
		    elem.simpanbuttonshow = true;
		    elem.loadingshow = false;
		  });
	      }
	    }
    }
});
        appcontent
    </script>
@endsection