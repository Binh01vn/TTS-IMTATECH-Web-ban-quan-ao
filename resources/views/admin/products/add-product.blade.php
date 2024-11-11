@extends('layouts.admin')
@section('title')
    Thêm mới sản phẩm
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body">
            <div class="row flex-between-center">
                <div class="col-md">
                    @if (session()->has('error'))
                        <h5 class="mb-2 mb-md-0 text-danger">{{ session('error') }}</h5>
                    @else
                        @if (session()->has('success'))
                            <h5 class="mb-2 mb-md-0 text-success">{{ session('success') }}</h5>
                        @else
                            <h5 class="mb-2 mb-md-0">Thêm một sản phẩm mới</h5>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.products.them_sp') }}" method="post" enctype="multipart/form-data" id="productForm">
        @csrf
        <div class="row g-0">
            <div class="col-lg-8 pe-lg-2">
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Thông tin cơ bản</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="product-name">Tên sản phẩm:</label>
                                <input class="form-control" id="product-name" type="text" name="product-name"
                                    value="{{ old('product-name') }}" />
                                @error('product-name')
                                    <label class="form-label text-danger" for="product-name">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="product-sku">Mã sản phẩm:</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">PRD-</span>
                                    <input class="form-control" type="text" id="product-sku" name="product-sku"
                                        value="{{ old('product-sku') }}" />
                                    <button type="button" class="input-group-text btn btn-info" onclick="generateSKU()">Tạo
                                        mã tự động</button>
                                </div>
                                @error('product-sku')
                                    <label class="form-label text-danger" for="product-name">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Thư viện ảnh sản phẩm</h6>
                    </div>
                    <div class="card-body">
                        @if ($errors->has('product-galleries.*'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('product-galleries.*') as $error)
                                    @foreach ($error as $message)
                                        <p>{{ $message }}</p>
                                    @endforeach
                                @endforeach
                            </div>
                        @endif
                        <div class="dropzone dropzone-multiple p-0" id="dropzoneMultipleFileUpload"
                            data-dropzone="data-dropzone">
                            <div class="dz-message" data-dz-message="data-dz-message">
                                <img class="me-2" src="{{ asset('theme/admin/assets/img/icons/cloud-upload.svg') }}"
                                    width="25" alt="" />
                                <span class="d-none d-lg-inline">Kéo, thả hình ảnh của bạn vào đây<br />hoặc, </span>
                                <span class="btn btn-link p-0 fs-10">Chọn ảnh</span>
                            </div>
                            <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                <div class="d-flex media align-items-center mb-3 pb-3 border-bottom btn-reveal-trigger">
                                    <img class="dz-image" src="{{ asset('theme/admin/assets/img/icons/cloud-upload.svg') }}"
                                        alt="..." data-dz-thumbnail="data-dz-thumbnail" />
                                    <div class="flex-1 d-flex flex-between-center">
                                        <div>
                                            <h6 data-dz-name="data-dz-name"></h6>
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0 fs-10 text-400 lh-1" data-dz-size="data-dz-size"></p>
                                                <div class="dz-progress">
                                                    <span class="dz-upload" data-dz-uploadprogress=""></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown font-sans-serif">
                                            <button
                                                class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none"
                                                type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <span class="fas fa-ellipsis-h"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end border py-2">
                                                <a class="dropdown-item" href="#!" data-dz-remove="data-dz-remove">Xóa
                                                    ảnh</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="product-galleries[]" id="hidden-files" multiple style="display: none;">
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Mô tả - Chất lượng - Hướng dẫn sử dụng</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="description">Mô tả sản phẩm:</label>
                                <div class="create-product-description-textarea">
                                    <textarea class="tinymce d-none" data-tinymce="data-tinymce" name="description" id="description">
                                        {{ old('description') }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-3 ps-lg-2">
                                <label class="form-label" for="material">Chất liệu sản phẩm:</label>
                                <textarea class="form-control" id="material" name="material">{{ old('material') }}</textarea>
                            </div>
                            <div class="col-lg-6 mb-3 ps-lg-2">
                                <label class="form-label" for="user_manual">Hướng dẫn sử dụng:</label>
                                <textarea class="form-control" id="user_manual" name="user_manual">{{ old('user_manual') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 mb-lg-0">
                    <div class="card-header bg-body-tertiary">
                        @if (session()->has('prdVariant'))
                            <h6 class="mb-0 text-danger">{{ session('prdVariant') }}</h6>
                        @else
                            <h6 class="mb-0">Biến thể sản phẩm</h6>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row gy-3 gx-2">
                            @if (count($colorAttr) > 0)
                                <div class="col-sm-2">
                                    <label class="form-label" for="product-description">Màu sắc:</label>
                                </div>
                                <div class="col-sm-10 row">
                                    @foreach ($colorAttr as $color)
                                        <div class="col-sm-3">
                                            <div class="input-group mb-3">
                                                <div class="input-group-text">
                                                    <input class="form-check-input colorValue" type="checkbox"
                                                        name="{{ $color->id }}" value="{{ $color->value }}"
                                                        aria-label="Checkbox for following text input" />
                                                </div>
                                                <input class="form-control form-control-color" type="color"
                                                    aria-label="Text input with checkbox" value="{{ $color->value }}"
                                                    disabled />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="col-sm-2">
                                    <label class="form-label" for="product-description">Màu sắc:</label>
                                </div>
                                <div class="col-sm-10">
                                    <label class="form-label text-warning" for="product-description">
                                        <strong>Chưa thêm giá trị cho thuộc tính này!</strong>
                                    </label>
                                </div>
                            @endif
                            @if (count($sizeAttr) > 0)
                                <div class="col-sm-2">
                                    <label class="form-label" for="product-description">Kích thước:</label>
                                </div>
                                <div class="col-sm-10 row">
                                    @foreach ($sizeAttr as $size)
                                        <div class="col-sm-3">
                                            <div class="input-group mb-3">
                                                <div class="input-group-text">
                                                    <input class="form-check-input sizeValue" type="checkbox"
                                                        name="{{ $size->id }}" value="{{ $size->value }}"
                                                        aria-label="Checkbox for following text input" />
                                                </div>
                                                <input class="form-control" type="text"
                                                    aria-label="Text input with checkbox" value="{{ $size->value }}"
                                                    disabled />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="col-sm-2">
                                    <label class="form-label" for="product-description">Kích thước:</label>
                                </div>
                                <div class="col-sm-10">
                                    <label class="form-label text-warning" for="product-description">
                                        <strong>Chưa thêm giá trị cho thuộc tính này!</strong>
                                    </label>
                                </div>
                            @endif
                            <div class="col-12 mb-3 row loadVariants"></div>
                            <div class="col-12 mb-3">
                                <input type="button" onclick="rendFormVariants()" class="btn btn-success btnCrtVariants"
                                    value="Tạo biến thể">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 ps-lg-2">
                <div class="sticky-sidebar">
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Phân loại - Danh mục</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-2">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="product-pl">Chọn loại:</label>
                                    <select class="form-select" id="product-pl" name="product-pl">
                                        <option value="" selected>Chọn</option>
                                        @foreach ($categorizations as $ctgz)
                                            <option value="{{ $ctgz->id }}">{{ $ctgz->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 rendCategories">
                                    <label class="form-label" for="product-category">Chọn danh mục:</label>
                                    <select class="form-select" name="product-category" id="product-category">
                                        <option value="" selected>Danh mục trống</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Tags - Ảnh đại diện</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-2">
                                <div class="col-12 mb-3">
                                    <label for="product-tags">Chọn thẻ:</label>
                                    <select class="form-select js-choice" id="product-tags" multiple="multiple"
                                        size="1" name="product-tags[]" data-options='{"removeItemButton":true}'>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="product-avatar">Chọn ảnh đại diện:</label>
                                    <input type="file" name="product-avatar" id="product-avatar"
                                        class="form-control">
                                    @error('product-avatar')
                                        <label class="form-label text-danger" for="product-name">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12" id="preview-container"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Giá sản phẩm</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-2">
                                <div class="col-12 mb-4">
                                    <label class="form-label" for="price_default">Giá mặc định:</label>
                                    <input class="form-control" id="price_default" type="number" min="0"
                                        name="price_default" value="{{ old('price_default') }}" />
                                    @error('price_default')
                                        <label for="" class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="sale_percent">Giá khuyến mại phần trăm (%):</label>
                                    <input class="form-control" id="sale_percent" type="number" max="100"
                                        min="0" name="sale_percent" value="{{ old('sale_percent') }}" />
                                    @error('sale_percent')
                                        <label for="" class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="price_sale">Giá khuyến mại:</label>
                                    <input class="form-control" id="price_sale" type="number" min="0"
                                        name="price_sale" value="{{ old('price_sale') }}" />
                                    @error('price_sale')
                                        <label for="" class="form-label text-danger">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label">Ngày bắt đầu:</label>
                                    <input type="date" class="form-control"
                                        name="start_date"value="{{ old('start_date') }}">
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label">Ngày kết thúc:</label>
                                    <input type="date" class="form-control"
                                        name="end_date"value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <label class="form-label text-danger" for="product-name">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-body-tertiary">
                            <h6 class="mb-0">Trạng thái - Số lượng</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input class="form-check-input" id="flexSwitchCheckDefault" type="checkbox"
                                    name="status" value="1" {!! old('status') == 1 ? 'checked' : '' !!} />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Xuất bản</label>
                            </div>
                            <div class="row gx-2">
                                <div class="col-12 mb-4">
                                    <label class="form-label" for="quantity">Số lượng sản phẩm:</label>
                                    <input class="form-control" id="quantity" type="number" min="0"
                                        name="quantity" value="{{ old('quantity') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row justify-content-between align-items-center">
                    <div class="col-md">
                        <h5 class="mb-2 mb-md-0">Bạn đã hoàn thành nhập thông tin cho sản phẩm?</h5>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" role="button" id="submit-button">
                            Tạo mới
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('css-libs')
    <link href="{{ asset('theme/admin/vendors/choices/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme/admin/vendors/dropzone/dropzone.css') }}">
@endsection
@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/jquery/jquery.min.js') }}"></script>
@endsection
@section('js-setting')
    <script>
        function generateSKU() {
            const lettersPart = Math.random().toString(36).substr(2, 6).toUpperCase();
            const numbersPart = Math.floor(100000 + Math.random() * 900000);
            const sku = lettersPart + '-' + numbersPart;
            document.getElementById('product-sku').value = sku;
        }

        function rendFormVariants() {
            let getCheckedValues = (selector) => {
                return [...document.querySelectorAll(selector)]
                    .filter(checkbox => checkbox.checked)
                    .reduce((acc, checkbox) => {
                        acc[checkbox.name] = checkbox.value;
                        return acc;
                    }, {});
            };

            let sizes = getCheckedValues('input.form-check-input.sizeValue[type="checkbox"]');
            let colors = getCheckedValues('input.form-check-input.colorValue[type="checkbox"]');
            let countS = Object.keys(sizes).length;
            let countC = Object.keys(colors).length;
            let showForm = document.querySelector('div.col-12.mb-3.row.loadVariants');
            let html;
            if (countS > 0 && countC > 0) {
                $(showForm).empty();
                Object.entries(colors).forEach(([key, value]) => {
                    Object.entries(sizes).forEach(([k, v]) => {
                        html = `
                        <div class="accordion col-lg-12 mb-3" id="container-${key}-${v}">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-${key}-${v}">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-${key}-${v}" aria-expanded="true"
                                        aria-controls="collapse-${key}-${v}">
                                        Biến thể: <div
                                            style="width: 25px; height: 25px; background-color: ${value}; margin: 3px;">
                                        </div>
                                        <strong> - ${v}</strong>
                                    </button>
                                </h2>
                                <div class="accordion-collapse collapse" id="collapse-${key}-${v}" aria-labelledby="heading-${value}-${v}"
                                    data-bs-parent="#container-${key}-${v}">
                                    <div class="accordion-body row">
                                        <div class="col-12 mb-4">
                                            <button type="button" onclick="removeVariant(id_color=${key}, size_value='${v}')"
                                                class="btn btn-danger">Xóa biến thể</button>
                                        </div>
                                        <div class="col-6 mb-4">
                                            <label class="form-label" for="price_default">Giá mặc định:</label>
                                            <input class="form-control" type="number" min="0"
                                                name="prdV[${key}][${k}]['price_default']" />
                                        </div>
                                        <div class="col-6 mb-4">
                                            <label class="form-label" for="price_sale">Giá khuyến mại:</label>
                                            <input class="form-control" type="number" min="0"
                                                name="prdV[${key}][${k}]['price_sale']" />
                                        </div>
                                        <div class="col-6 mb-4">
                                            <label class="form-label" for="">Ngày bắt đầu:</label>
                                            <input class="form-control" type="date"
                                                name="prdV[${key}][${k}]['start_date']" />
                                        </div>
                                        <div class="col-6 mb-4">
                                            <label class="form-label" for="">Ngày kết thúc:</label>
                                            <input class="form-control" type="date"
                                                name="prdV[${key}][${k}]['end_date']" />
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label class="form-label" for="">Số lượng:</label>
                                            <input class="form-control" type="number"
                                                name="prdV[${key}][${k}]['quantity']" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                        $(showForm).append(html);
                    });
                });
            } else {
                $(showForm).empty();
                alert("Yêu cầu chọn giá trị hợp thệ!");
            }
        }

        function removeVariant(id_color, size_value) {
            if (confirm("Chắc chắn muốn xóa biến thể này?")) {
                let variant_item = document.querySelector(
                    `div.accordion.col-lg-12.mb-3#container-${id_color}-${size_value}`);
                $(variant_item).remove();
            }
        }
        document.getElementById('product-avatar').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('preview-container');
            // Xóa ảnh hiện tại nếu có
            previewContainer.innerHTML = '';
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100%'; // Set chiều rộng ảnh là 100%
                    img.style.height = 'auto'; // Đảm bảo ảnh giữ tỉ lệ
                    img.alt = 'Ảnh xem trước';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.innerHTML = 'File không phải là hình ảnh!';
            }
        });
        const selectElement = document.querySelector('select[name="product-pl"].form-select#product-pl')
        selectElement.addEventListener('change', function() {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const label = document.querySelector('label[for="product-category"]');
            if (selectedOption.text != 'Chọn') {
                let urlAJAX = `{{ route('admin.ajax.rendCtg', ':value') }}`.replace(':value', encodeURIComponent(
                    selectedOption.value));
                // Cập nhật text của label với text của option đã chọn
                if (label && selectedOption.text != 'Chọn') {
                    label.textContent = `Danh mục phân loại ${selectedOption.text}:`;
                } else {
                    label.textContent = 'Chọn danh mục:';
                }
                $.ajax({
                    url: urlAJAX,
                    method: "GET",
                    success: function(res) {
                        if (Array.isArray(res.categories)) {
                            let selectCTG = document.querySelector(
                                'select[name="product-category"].form-select#product-category');
                            $(selectCTG).empty();
                            res.categories.forEach(category => {
                                let opt =
                                    `<option value="${category.id}">${category.name}</option>`;
                                $(selectCTG).append(opt);
                            });
                        } else {
                            alert("Không tìm thấy danh mục nào hoặc định dạng phản hồi không đúng!");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error:", error);
                    }
                });
            }
        });
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#dropzoneMultipleFileUpload", {
            url: "#", // Không cần URL vì sẽ submit form thông thường
            autoProcessQueue: false, // Không tự động upload
            // paramName: "product-galleries", // Tên của input trong request
            uploadMultiple: true, // Cho phép chọn nhiều file
            parallelUploads: 10, // Giới hạn số file upload đồng thời
            maxFilesize: 5, // Kích thước file tối đa
            acceptedFiles: "image/*", // Chỉ nhận file ảnh
            previewsContainer: document.querySelector(".dz-preview"),
            previewTemplate: document.querySelector(".dz-preview").innerHTML,
            clickable: true, // Cho phép người dùng click vào vùng Dropzone để chọn file
            // dictDefaultMessage: 'Drag your image here or, Browse',
            init: function() {
                var myDropzone = this;
                document.querySelector(".dz-preview").innerHTML = "";
                // Khi nhấn nút submit
                document.getElementById("submit-button").addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    // Nếu có file trong Dropzone
                    if (myDropzone.getAcceptedFiles().length > 0) {
                        var hiddenFilesInput = document.getElementById('hidden-files');
                        var dataTransfer =
                            new DataTransfer(); // Sử dụng DataTransfer để chứa nhiều file
                        // Thêm từng file từ Dropzone vào DataTransfer
                        myDropzone.getAcceptedFiles().forEach(function(file) {
                            dataTransfer.items.add(file);
                        });
                        // Gán danh sách file vào input file ẩn
                        hiddenFilesInput.files = dataTransfer.files;
                        // Sau đó submit form bình thường
                        document.getElementById("productForm").submit();
                    } else {
                        // Nếu không có file trong Dropzone, submit form ngay lập tức
                        document.getElementById("productForm").submit();
                    }
                });
            }
        });

        function initTinyMCE(selector, plugins, toolbar, menubar = false, height = null) {
            tinymce.init({
                selector: selector,
                plugins: plugins,
                toolbar: toolbar,
                menubar: menubar,
                height: height
            });
        }
        initTinyMCE(
            '#material',
            'lists link image table code',
            'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
            false, 200);
        initTinyMCE(
            '#user_manual',
            'lists link image table code',
            'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
            false, 200);
    </script>
@endsection
