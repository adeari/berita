@extends('layout')
@section('title', 'Surabaya Berita Populer')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-building"></i> Berikut alamat kantor kami</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
                    <h2>Surabaya</h2>
                    <div class="clearfix"></div>
                </div>
                  <div class="x_content">
                    Jl. Ketintang no 334<br>
                    <i class="fa fa-phone-square"></i> 045446464<br>
                    <i class="fa fa-envelope-square"></i> cs@surabayadigitalcity.net
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
	    usernamenik: '',
	    email: '',
	    password: '',
	    repassword: '',
    },
    methods:{
	    onsubmit: function(evue) {
	    elem = this;
	      csrf = '{!! csrf_token() !!}';
	      if (validator.checkAll($('#formdata'))) {
		if (this.cansave) {
		validator.unmark( $('#usernamenik'));
		validator.unmark( $('#password'));
		validator.unmark( $('#email'));

		elem.cansave = false;
		var oData = new FormData();
		oData.append('usernamenik', elem.usernamenik);
		oData.append('password', elem.password);
		oData.append('email', elem.email);
		oData.append('_token', csrf);
		elem.simpanbuttonshow = false;
		elem.loadingshow = true;
		  elem.$http.post('{{ URL::to('mendaftar') }}',oData).then(function(response){
		  jsonresponse = JSON.parse(response.body);
		  if (jsonresponse.success == 1) {
		    location = 'login?loginonly=1';
		  } else {
		    validator.mark( $('#' + jsonresponse.idelement), jsonresponse.msg);
		  }

		    elem.simpanbuttonshow = true;
		    elem.loadingshow = false;
		    elem.cansave = true;
		  });
		}
	      }
	    }
    }
});
        appcontent
    </script>
@endsection
