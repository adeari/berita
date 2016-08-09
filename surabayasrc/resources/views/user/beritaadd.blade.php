@extends('layout')
@section('title', 'Surabaya Berita Populer')
@section('content')
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><i class="fa fa-plus"></i> Tambah Berita</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    {!! Form::open(['class' => 'form-horizontal form-label-left', 'novalidate' => 'novalidate', '@submit.prevent' => 'onsubmit', 'id' => 'formdata'])  !!}
                    <div class="item form-group">
                        {!! Form::label('kategori', 'Kategori', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::select('kategori', ['Berita' => 'Berita', 'Acara' => 'Acara', 'Pengaduan' => 'Pengaduan', ],'', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'judulberita', 'required' => 'required', 'v-model' => 'kategori']) !!}
                        </div>
                      </div>                    
                    <div class="item form-group">
                        {!! Form::label('imageberita', 'Gambar', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="imageberita" type="file" id="imageberita" @change="onchangeimage">
                          <div v-show="imageberitashow"><br><img src="" id="imagepict" width="260px" height="200px" class="pointer"></div>
                        </div>
                      </div>
                      <div class="item form-group">
                        {!! Form::label('judulberita', 'Judul Berita', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          {!! Form::text('judulberita', '', ['class' => 'form-control col-md-7 col-xs-12', 'id' => 'judulberita', 'required' => 'required', 'v-model' => 'judul']) !!}
                        </div>
                      </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                  <h2>Deskripsi</h2>
                <div class="x_content">
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
                  <div id="editor" class="editor-wrapper"></div>
                  {!! Form::textarea('descr', '',['id' => 'descr', 'style' => 'display:none;'])  !!}
                  <br />
                  <div class="ln_solid"></div>
                </div>
              </div>
            </div>
                      
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Batal</button>
                          <button id="send" type="submit" class="btn btn-success">Simpan</button>
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
      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      
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

        

        var vue = new Vue({
			el: '#appcontent',
			data: {
				imageberitashow: false,
				judul: '',
				kategori: '',
			},
			methods:{
				onchangeimage: function(evue) {
					thefile = evue.target.files[0];
					if (thefile.size < 2000000) {
						var readImg = new FileReader();
				    	readImg.readAsDataURL(evue.target.files[0]);
				    	readImg.onload = function(e) {
				    		$('#imagepict').attr('src',e.target.result);
				    	}
				    	this.imageberitashow = true;
				    	validator.unmark( $('#imageberita'));
					} else {
						this.imageberitashow = false;
						validator.mark( $('#imageberita'), 'Gambar Maksimal 2MB');
					}
				},
				onsubmit: function(evue) {
					elem = this;
					csrf = '{!! csrf_token() !!}';
					if (validator.checkAll($('#formdata'))) {
						var form = document.querySelector('#imageberita');
				        var file = form.files[0];
						var oData = new FormData();
				        oData.append('image', file);
				        oData.append('_token', csrf);
				        oData.append('judul', this.judul);
				        oData.append('deskripsi', $('#editor').html());
				        oData.append('kategori', this.kategori);
				        elem.$http.post('{{ URL::to('addberita') }}',oData).then(function(response){
					        jsonresponse = JSON.parse(response.body);
							if (jsonresponse.msg == 'ErrorException') {
								window.location.assign('{{ URL::to('/') }}')
							} else {
								location = '/';
							}
				        });
					}
				}
			}
        });
        appcontent
    </script>
@endsection