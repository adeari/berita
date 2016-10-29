@extends('admin.layout')
@section('title', 'Surabaya Berita Populer')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main" id="pagevue" style="display:none;" v-show="firsttime">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-envelope-o"></i> Mengirim Pesan ke semua User</h3>
                <h3><small>Pesan akan tampil di halaman Awal Setelah user Login</small></h3>
              </div>
            </div>
            <div class="clearfix"></div>

<div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
    <div class="x_content">
      <div class="row" v-show="showalertpesanterkirim"><div class="col-md-12"><div class="x_panel text-center"><h2>Pesan terkirim <span class="text-right red pointer" style="font-weight:bold;" @click="closepesanterkirim">X</span></h2></div></div></div>
		{!! Form::open(['class' => 'form-horizontal form-label-left', '@submit.prevent' => "kirim"])  !!}
    <div id="alerts"></div>
    <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
        <ul class="dropdown-menu">
        </ul>
      </div>

      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li>
            <a data-edit="fontSize 5">
              <p style="font-size:17px">Huge</p>
            </a>
          </li>
          <li>
            <a data-edit="fontSize 3">
              <p style="font-size:14px">Normal</p>
            </a>
          </li>
          <li>
            <a data-edit="fontSize 1">
              <p style="font-size:11px">Small</p>
            </a>
          </li>
        </ul>
      </div>

      <div class="btn-group">
        <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
        <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
        <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
        <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
      </div>

      <div class="btn-group">
        <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
        <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
        <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
        <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
      </div>

      <div class="btn-group">
        <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
        <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
        <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
        <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
      </div>

      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
        <div class="dropdown-menu input-append">
          <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
          <button class="btn" type="button">Add</button>
        </div>
        <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
      </div>

      <div class="btn-group">
        <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
        <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
      </div>
    </div>
    <div id="editor" class="editor-wrapper">{!! $pesan->pesan !!}</div>
      {!! Form::textarea('descr', $pesan->pesan,['id' => 'descr', 'style' => 'display:none;'])  !!}
      <div class="row loadernaikup" v-show="loadingshowpesan">
      <div class="demo">
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
    <br />
    <div class="ln_solid"></div>
    {{ Form::submit('Kirim', array('class' => 'btn btn-lg btn-success', 'v-show' => '!loadingshowpesan')) }}
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
    kirim: function() {
      if (canajaxprocess) {
        canajaxprocess = false;
        elem = this;
        elem.loadingshowpesan = true;
        elem.$http.post('{{ URL::to('admin-kirimbroadcastpesan') }}' , {_token: '{!! csrf_token() !!}', pesan: $('#editor').html()}).then(function(response){
          elem.loadingshowpesan =false;
          elem.showalertpesanterkirim = true;
          canajaxprocess = true;
        });
      }
    }
  }
});
</script>
@endsection
