@extends('admin.layout')
@section('title', 'Admin - SurabayaDigitalCity')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main" id="pagevue" style="display:none;" v-show="firsttime">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-check"></i> Ganti Password</h3>
              </div>
            </div>
            <div class="clearfix"></div>

<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
    <div class="x_content">
      <div class="row" v-show="showalertpesanterkirim"><div class="col-md-12"><div class="x_panel text-center"><h2>Password berganti <span class="text-right red pointer" style="font-weight:bold;" @click="closepesanterkirim">X</span></h2></div></div></div>
		{!! Form::open(['class' => 'form-horizontal form-label-left', '@submit.prevent' => "gantipassword", 'id' => 'formdata'])  !!}
    <div class="item form-group">
      {!! Form::password('cpassword', ['style' => 'display:none;', 'class' => 'form-control col-md-7 col-xs-12', 'id' => 'cpassword', 'required' => 'required', 'v-model' => 'cpassword', 'autocomplete' => 'smartystreets']) !!}
      {!! Form::label('cpassword', 'Password', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
      <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::password('cpassword', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'cpassword', 'required' => 'required', 'v-model' => 'cpassword', 'autocomplete' => 'smartystreets']) !!}
      </div>
    </div>
    <div class="item form-group">
      {!! Form::label('repassword', 'Re - Password', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
      <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::password('repassword', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'repassword', 'required' => 'required', 'v-model' => 'repassword']) !!}
      </div>
    </div>
    <div class="demo" v-show="loadingshowpesan">
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
      <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
          {!! Form::submit('Ganti Password', ['class' => 'btn btn-warning']) !!}
        </div>
      </div>
		{!! Form::close() !!}
		</div>
	</div>
</div></div>

    </div>
</div>
        <!-- /page content -->
@endsection
@section('javascript')
<script>
function initToolbarBootstrapBindings() {
    var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
        'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
        'Times New Roman', 'Verdana'
      ],
      fontTarget = $('[title=Font]').siblings('.dropdown-menu');
    $.each(fonts, function(idx, fontName) {
      fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
    });
    $('a[title]').tooltip({
      container: 'body'
    });
    $('.dropdown-menu input').click(function() {
        return false;
      })
      .change(function() {
        $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
      })
      .keydown('esc', function() {
        this.value = '';
        $(this).change();
      });

    $('[data-role=magic-overlay]').each(function() {
      var overlay = $(this),
        target = $(overlay.data('target'));
      overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
    });

    if ("onwebkitspeechchange" in document.createElement("input")) {
      var editorOffset = $('#editor').offset();

      $('.voiceBtn').css('position', 'absolute').offset({
        top: editorOffset.top,
        left: editorOffset.left + $('#editor').innerWidth() - 35
      });
    } else {
      $('.voiceBtn').hide();
    }
  }
  function showErrorAlert(reason, detail) {
    var msg = '';
    if (reason === 'unsupported-file-type') {
      msg = "Unsupported format " + detail;
    } else {
      console.log("error uploading file", reason, detail);
    }
    $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
      '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
  }
  initToolbarBootstrapBindings();
  $('#editor').wysiwyg({
    fileUploadError: showErrorAlert
  });
  window.prettyPrint;
  prettyPrint();

canajaxprocess = true;
vm = new Vue({
  el:'#pagevue',
  data: {
    firsttime: true,
    loadingshowpesan: false,
    showalertpesanterkirim: false,
  },
  methods: {
    closepesanterkirim: function() {
      this.showalertpesanterkirim = false;
    },
    gantipassword: function() {
      validator.unmark( $('#repassword'));
      if (validator.checkAll($('#formdata'))) {
        if (this.cpassword != this.repassword) {
  	         validator.mark( $('#repassword'), 'Samakan Password');
        } else if (canajaxprocess) {
          canajaxprocess = false;
          elem = this;
          elem.loadingshowpesan = true;
          elem.$http.post('{{ URL::to('admin-gantipassword-do') }}' , {_token: '{!! csrf_token() !!}', passwordchange: elem.cpassword}).then(function(response){
            elem.loadingshowpesan =false;
            elem.showalertpesanterkirim = true;
            canajaxprocess = true;
          });
      }
    }
    }
  }
});
</script>
@endsection
