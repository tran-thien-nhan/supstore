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
                    thêm sản phẩm
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
                        <form role="form" id="productForm" action="{{ URL::to('/save-product') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input type="text" name="product_name" class="form-control" id="product_name"
                                    placeholder="produuct name">
                                @error('product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_quantity">Product quantity</label>
                                <input type="number" name="product_quantity" class="form-control" id="product_quantity"
                                    placeholder="Product quantity">
                                @error('product_quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_flavour">Product flavour</label>
                                <input type="text" name="product_flavour" class="form-control" id="product_flavour"
                                    placeholder="flavour">
                                @error('product_flavour')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_price">Product Price</label>
                                <input type="text" name="product_price" class="form-control" id="product_price"
                                    placeholder="product price">
                                @error('product_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_discount">Discount Of Product</label>
                                <input type="text" name="product_discount" class="form-control" id="product_discount"
                                    placeholder="product discount">
                                @error('product_discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_image">Product Image</label>
                                <input type="file" name="product_image" class="form-control" id="product_image"
                                    placeholder="product image">
                                @error('product_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_desc">Product Description</label>
                                <textarea class="form-control" name="product_desc" id="product_desc" placeholder="Product Description" style="resize:none"
                                    rows="8"></textarea>
                                @error('product_desc')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_content">Product Content</label>
                                <textarea class="form-control" name="product_content" id="product_content" placeholder="Product Content"
                                    style="resize:none" rows="8"></textarea>
                                @error('product_content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_cate">Product Category</label>
                                <select name="product_cate" class="form-control input-sm m-bot15">
                                    @foreach ($cate_product as $key => $cate)
                                        <option value="{{ $cate->category_id }}"
                                            {{ old('category_id') == $cate->category_id ? 'selected' : '' }}>
                                            {{ $cate->category_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_brand">Product Brand</label>
                                <select name="product_brand" class="form-control input-sm m-bot15">
                                    @foreach ($brand_product as $key => $brand)
                                        <option value="{{ $brand->brand_id }}"
                                            {{ old('brand_id') == $brand->brand_id ? 'selected' : '' }}>
                                            {{ $brand->brand_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_status">Visibility</label>
                                <select name="product_status" class="form-control input-sm m-bot15">
                                    <option value="0" {{ old('product_status') == 0 ? 'selected' : '' }}>Hide</option>
                                    <option value="1" {{ old('product_status') == 1 ? 'selected' : '' }}>Show
                                    </option>
                                </select>
                            </div>
                            <button type="submit" name="add_product" class="btn btn-info">Add Product</button>
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
        CKEDITOR.ClassicEditor.create(document.getElementById("product_content"), {
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
                // Replace it on production website with other solutions:
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
                // The following features are part of the Productivity Pack and require additional license.
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents'
            ]
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $("#productForm").validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,
                rules: {
                    "product_name": {
                        required: true,
                        minlength: 10,
                        maxlength: 100
                    },
                    "product_quantity": {
                        required: true,
                        min: 0,
                        max: 200
                    },
                    "product_flavour": {
                        required: true,
                        minlength: 5
                    },
                    "product_price": {
                        required: true,
                        min: 200000,
                        max: 23000000
                    },
                    "product_discount": {
                        required: true,
                        min: 0,
                        max: 100
                    },
                    "product_image": {
                        required: true
                    },
                    "product_desc": {
                        required: true
                    },
                    "product_content": {
                        required: true
                    },
                },
                messages: {
                    "product_name": {
                        required: "Bắt buộc nhập tên sản phẩm",
                        minlength: "Tên sản phẩm không được nhỏ hơn 10 ký tự",
                        maxlength: "Tên sản phẩm không được vượt quá 100 ký tự"
                    },
                    "product_quantity": {
                        required: "Bắt buộc nhập số lượng sản phẩm",
                        min: "Số lượng sản phẩm phải lớn hơn 0",
                        max: "Số lượng sản phẩm không được vượt quá 200"
                    },
                    "product_flavour": {
                        required: "Bắt buộc nhập hương vị sản phẩm",
                        minlength: "Nội dung hương vị sản phẩm ít nhất phải có 5 ký tự"
                    },
                    "product_price": {
                        required: "Bắt buộc nhập giá tiền sản phẩm",
                        min: "Giá tiền sản phẩm phải ít nhất 200k VND",
                        max: "Giá tiền sản phẩm không được vượt quá 23tr VND"
                    },
                    "product_discount": {
                        required: "Bắt buộc nhập % giảm giá cho sản phẩm",
                        min: "% giảm giá ít nhất là 0%",
                        max: "% giảm giá không được vượt quá 100%"
                    },
                    "product_image": {
                        required: "Bắt buộc nhập hình ảnh cho sản phẩm"
                    },
                    "product_desc": {
                        required: "Bắt buộc nhập mô tả cho sản phẩm"
                    },
                    "product_content": {
                        required: "Bắt buộc nhập nội dung cho sản phẩm"
                    }
                }
            });
        });
    </script> --}}
@endsection
