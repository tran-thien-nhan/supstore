@extends('admin_layout')
@section('admin_content')
    <style>
        label.error {
            color: red;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/super-build/ckeditor.js"></script>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    thêm bài viết
                </header>
                <?php
                // $message = Session::get('message');
                // if ($message) {
                //     echo '<span style="color: red; text-align: center; font-size: 17px; width: 100%; font-weight: bold">' . $message . '</span>';
                //     Session::put('message', null);
                // }
                ?>
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" id="blogForm" action="{{ URL::to('/save-blog') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="blog_name">tên bài viết</label>
                                <input type="text" name="blog_title" class="form-control" id="blog_title"
                                    placeholder="tên bài viết">
                            </div>
                            <div class="form-group">
                                <label for="blog_thumbnail">hình ảnh bài viết</label>
                                <input type="file" name="blog_thumbnail" class="form-control" id="blog_thumbnail"
                                    placeholder="hình ảnh bài viết">
                            </div>
                            <div class="form-group">
                                <label for="blog_cate">danh mục bài viết</label>
                                <select name="blog_cate" class="form-control input-sm m-bot15">
                                    @foreach ($cate_blog as $key => $cate)
                                        <option value="{{ $cate->blog_category_id }}"
                                            {{ old('blog_category_id') == $cate->blog_category_id ? 'selected' : '' }}>
                                            {{ $cate->blog_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pre_blog_content">mô tả bài viết</label>
                                <textarea class="form-control" name="pre_blog_content" id="pre_blog_content" placeholder="mô tả bài viết" style="resize:none"
                                    rows="8"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="blog_content">nội dung bài viết</label>
                                <textarea class="form-control" name="blog_content" id="blog_content" placeholder="nội dung bài viết"
                                    style="resize:none" rows="8"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="blog_status">hiển thị</label>
                                <select name="blog_status" class="form-control input-sm m-bot15">
                                    <option value="0" {{ old('blog_status') == 0 ? 'selected' : '' }}>ẩn</option>
                                    <option value="1" {{ old('blog_status') == 1 ? 'selected' : '' }}>hiển thị
                                    </option>
                                </select>
                            </div>
                            <button type="submit" name="add_blog" class="btn btn-info">thêm bài viết</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/super-build/ckeditor.js"></script>
    <script>
        // This sample still does not showcase all CKEditor 5 features (!)
        // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
        CKEDITOR.ClassicEditor.create(document.getElementById("blog_content"), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                    'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
                    '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: '',
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                        '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                        '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                        '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on blogion website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                'MathType',
                // The following features are part of the blogivity Pack and require additional license.
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents'
            ]
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#blogForm").validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,
                rules: {
                    "blog_name": {
                        required: true,
                        minlength: 10,
                        maxlength: 100
                    },
                    "blog_quantity": {
                        required: true,
                        min: 0,
                        max: 200
                    },
                    "blog_flavour": {
                        required: true,
                        minlength: 5
                    },
                    "blog_price": {
                        required: true,
                        min: 200000,
                        max: 23000000
                    },
                    "blog_discount": {
                        required: true,
                        min: 0,
                        max: 100
                    },
                    "blog_image": {
                        required: true
                    },
                    "blog_desc": {
                        required: true
                    },
                    "blog_content": {
                        required: true
                    },
                },
                messages: {
                    "blog_name": {
                        required: "Bắt buộc nhập tên bài viết",
                        minlength: "Tên bài viết không được nhỏ hơn 10 ký tự",
                        maxlength: "Tên bài viết không được vượt quá 100 ký tự"
                    },
                    "blog_quantity": {
                        required: "Bắt buộc nhập số lượng bài viết",
                        min: "Số lượng bài viết phải lớn hơn 0",
                        max: "Số lượng bài viết không được vượt quá 200"
                    },
                    "blog_flavour": {
                        required: "Bắt buộc nhập hương vị bài viết",
                        minlength: "Nội dung hương vị bài viết ít nhất phải có 5 ký tự"
                    },
                    "blog_price": {
                        required: "Bắt buộc nhập giá tiền bài viết",
                        min: "Giá tiền bài viết phải ít nhất 200k VND",
                        max: "Giá tiền bài viết không được vượt quá 23tr VND"
                    },
                    "blog_discount": {
                        required: "Bắt buộc nhập % giảm giá cho bài viết",
                        min: "% giảm giá ít nhất là 0%",
                        max: "% giảm giá không được vượt quá 100%"
                    },
                    "blog_image": {
                        required: "Bắt buộc nhập hình ảnh cho bài viết"
                    },
                    "blog_desc": {
                        required: "Bắt buộc nhập mô tả cho bài viết"
                    },
                    "blog_content": {
                        required: "Bắt buộc nhập nội dung cho bài viết"
                    }
                }
            });
        });
    </script>
@endsection
