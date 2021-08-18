@extends('layouts.website')
@section('style')
{{--    <script src="{{asset('assets/plugins/ckeditor4/ckeditor.js')}}"></script>--}}
<script type="text/javascript" src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
@endsection


@section('content')
    <div class="main-page second py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @include('parts.provider_sidebar')
                </div>
                <div class="col-lg-8 right">

                    <div class="p-4 bg-white rounded shadow-sm mb-3">
                        <h5 class="mb-4 font-weight-bold text-center">{{__('Create Live Book')}}
                        </h5>
                        <div class="row ">
                            <div class="col-md-12  ">
                                <form method="post" action="{{route('provider.store_live_book_page',$liveBook->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="live_book_id" value="{{$liveBook->id}}">
                                    <div class="form-group">
                                        <label for="">Book Description</label>
                                        <textarea name="content" class="form-control" id="editor" cols="30" rows="20" ></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary form-control" type="submit">Create </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
{{--    <script type="text/javascript" src="{{asset('assets/plugins/ckeditor4/ckeditor.js')}}"></script>--}}

    <script>

        /**
         * Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
         * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
         */



          function initSample(){

             var editor =  CKEDITOR.replace( 'editor' ,{
                  extraPlugins: 'print,format,font,colorbutton,justify,uploadimage,flash,html5video,html5audio',
                  uploadUrl:"{{route('provider.upload_live')}}?_token={{csrf_token()}}",
                  // filebrowserImageBrowseUrl: '/apps/ckfinder/3.4.5/ckfinder.html?type=Images',
                  filebrowserUploadUrl: "{{route('provider.upload_live')}}?_token={{csrf_token()}}",
                  filebrowserImageUploadUrl:"{{route('provider.upload_live')}}?_token={{csrf_token()}}",
                    allowedContent : true,
              });
            CKEDITOR.plugins.addExternal( 'html5video', "{{asset('assets/plugins/ckeditor4/plugins/html5video/plugin.js')}}" );
            CKEDITOR.plugins.addExternal( 'html5audio', "{{asset('assets/plugins/ckeditor4/plugins/html5audio/plugin.js')}}" );
              CKEDITOR.editorConfig = function( config ) {
                  // Define changes to default configuration here. For example:

                      config.toolbar=[
                      { name: 'document', items: [ 'Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates' ] },
                      { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                      { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
                      { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
                      '/',
                      { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
                      { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
                      { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                      { name: 'insert', items: [ 'UploadImage','Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
                      '/',
                      { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                      { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                      { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },

                  ];

              };
          }



        initSample();
    </script>
@endsection
