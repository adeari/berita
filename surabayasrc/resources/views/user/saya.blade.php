@extends('layout')
@section('title', 'Surabaya Berita Populer')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-user"></i> Saya</h3>
              </div>
            </div>
            <div class="clearfix"></div>


<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
    <div class="x_title"><h2>Profile</h2><div class="clearfix"></div></div>
      <div class="x_content">
      <div class="row" style="text-align:center;">
	<img src="public/imagesystem/user.png" style="width:300px;margin:0 0 0 -40px;" class="img-circle profile_img">
      </div>
      <br>
<p v-show="alert" class="bg bg-success text-center">Password berhasil diubah.<br></p>
	{!! Form::open(['class' => 'form-horizontal form-label-left', 'novalidate' => 'novalidate', '@submit.prevent' => 'onsubmit', 'id' => 'formdata'])  !!}
  <div class="item form-group">
    {!! Form::label('name', 'Name', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::text('name', $profile->name, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'name', 'required' => 'required', 'v-model' => 'name']) !!}
    </div>
  </div>
  <div class="item form-group">
    {!! Form::label('nik', 'N I K', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::text('nik', $profile->nik, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'nik', 'required' => 'required', 'v-model' => 'nik']) !!}
    </div>
  </div>
  <div class="item form-group">
    {!! Form::label('email', 'Email', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::text('email', $profile->email, ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'email', 'required' => 'required', 'v-model' => 'email']) !!}
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-6 col-md-offset-3">
      <button id="send" type="submit" class="btn btn-success">Simpan</button>
    </div>
  </div>
	{!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


<div class="row" id="gantipassword">
  <div class="col-md-12">
    <div class="x_panel">
    <div class="x_title"><h2>Ganti Password</h2><div class="clearfix"></div></div>
      <div class="x_content">
<p v-show="alert" class="bg bg-success text-center">Password berhasil diubah.</p>
	{!! Form::open(['class' => 'form-horizontal form-label-left', 'novalidate' => 'novalidate', '@submit.prevent' => 'changepassword', 'autocomplete' => 'off', 'id' => 'formdata', 'autocomplete' => 'smartystreets'])  !!}
    {!! Form::password('cpassword', ['style' => 'display:none;', 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'cpassword', 'required' => 'required', 'v-model' => 'cpassword', 'autocomplete' => 'smartystreets']) !!}
  <div class="item form-group">
    {!! Form::label('cpassword', 'Password', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::password('cpassword', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'cpassword', 'required' => 'required', 'v-model' => 'cpassword', 'autocomplete' => 'smartystreets']) !!}
    </div>
  </div>
  
<div class="demo" style="display:none;" v-show="loadingshow">
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
    {!! Form::label('repassword', 'Re - Password', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
      {!! Form::password('repassword', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'repassword', 'required' => 'required', 'v-model' => 'repassword']) !!}
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-6 col-md-offset-3">
      <button id="send" type="submit" class="btn btn-warning">Ganti Password</button>
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
cansave = true;
$('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });
vuepassword = new Vue({
  el: '#gantipassword',
  data: {
  cpassword:'',
  repassword:'',
  loadingshow:false,
  alert:false,
  },
  methods:{
    changepassword:function() {
      if (this.cpassword != this.repassword) {
	validator.mark( $('#repassword'), 'Samakan Password');
      } else if (cansave) {
      cansave = false;
      elem = this;
      elem.loadingshow = true;
	elem.$http.post('{{ URL::to('changepassword') }}', {password:this.password, _token: '{!! csrf_token() !!}'}).then(function(response){
	  cansave = true;
	  elem.loadingshow = false;
	  elem.alert = true;
	});
      }
    }
  }
});
</script>
@endsection