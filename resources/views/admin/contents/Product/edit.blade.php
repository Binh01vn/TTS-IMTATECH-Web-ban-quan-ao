@extends('layouts.master')

@section('title')
    Edit Product
@endsection
@section('css-libs')
    <link href="{{ asset('theme/admin/vendors/choices/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
@endsection
@section('css-setting')
    <style>
        .image-container {
            position: relative;
            display: inline-block;
        }

        .image-container .remove-btn {
            position: absolute;
            top: 0px;
            right: 15px;
            background-color: #ff4d4f;
            border: none;
            padding: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .image-container .remove-btn .far {
            color: white;
        }

        .image {
            display: block;
            width: 150px;
            height: auto;
            border-radius: 5px;
        }
    </style>
@endsection
@section('contents')
    <form class="row g-0" action="{{ route('admin.products.updateProduct', $modelPrd->slug) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-lg-12 pe-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row flex-between-center">
                        @if (session('success'))
                            <div class="col-md">
                                <h5 class="mb-0 text-success">{{ session('success') }}</h5>
                            </div>
                        @else
                            @if (session('error'))
                                <div class="col-md">
                                    <h5 class="mb-0 text-danger">{{ session('error') }}</h5>
                                </div>
                            @else
                                <div class="col-md">
                                    <h5 class="mb-2 mb-md-0">Update a product</h5>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 pe-lg-2">
            {{-- BASIC INFORMATION --}}
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Basic information</h6>
                </div>
                <div class="card-body">
                    <div>
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="product-name">Product name:</label>
                                <input class="form-control" id="productName" type="text" name="name"
                                    value="{!! old('name') ? old('name') : $modelPrd->name !!}" />
                            </div>
                            @error('name')
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label text-danger">{{ $message }}</label>
                                </div>
                            @enderror
                            @error('slug')
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label text-danger">{{ $message }}</label>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            {{-- ADD IMAGE GALLERY --}}
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Add images</h6>
                </div>
                <div class="card-body">
                    <div class="row gx-2" id="gallery_list">
                        @if ($errors->has('product_galleries.*'))
                            <div class="alert alert-danger">
                                @foreach ($errors->get('product_galleries.*') as $error)
                                    @foreach ($error as $message)
                                        <p>{{ $message }}</p>
                                    @endforeach
                                @endforeach
                            </div>
                        @endif
                        @if (session('product_galleries'))
                            <div class="alert alert-danger">{{ session('product_galleries') }}</div>
                        @endif
                        <div class="col-12 mb-4">
                            <div class="row">
                                @foreach ($modelPrd->galleries as $imageG)
                                    <div
                                        class="col-auto mb-3 position-relative image-container imageGallery-{{ $imageG->id }}">
                                        <img src="{{ \Storage::url($imageG->image) }}" alt="....." width="150px"
                                            class="image">
                                        <button type="button" class="btn btn-danger remove-btn"
                                            onclick="removeImage(idImageG={{ $imageG->id }}, urlI='{{ route('admin.products.delImageG', $imageG->id) }}')">
                                            <span class="far fa-trash-alt"></span>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <button type="button" class="btn btn-success" onclick="addImageGallery()">Thêm ảnh</button>
                        </div>
                        <div class="col-12 mb-4" id="gallery_default_item">
                            <label for="gallery_default" class="form-label">Image gallery:</label>
                            <div class="d-flex">
                                <input type="file" class="form-control" name="product_galleries[]" id="gallery_default">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- DETAIL PRODUCT --}}
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Details</h6>
                </div>
                <div class="card-body">
                    <div class="row gx-2">
                        <div class="col-12 mb-3">
                            <label class="form-label" for="product-description">Product description:</label>
                            <textarea class="form-control" id="description" name="description">
                                {!! old('description') ? old('description') : $modelPrd->description !!}
                            </textarea>
                        </div>
                        <div class="col-lg-6 mb-3 ps-lg-2">
                            <label class="form-label" for="product-description">Product material:</label>
                            <textarea class="form-control" id="material" name="material">
                                {!! old('material') ? old('material') : $modelPrd->material !!}
                            </textarea>
                        </div>
                        <div class="col-lg-6 mb-3 ps-lg-2">
                            <label class="form-label" for="product-description">User manual:</label>
                            <textarea class="form-control" id="user_manual" name="user_manual">
                                {!! old('user_manual') ? old('user_manual') : $modelPrd->user_manual !!}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            {{-- PRODUCT VARIANT --}}
            <div class="card mb-3 mb-lg-0">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Product Variant</h6>
                </div>
                <div class="card-body">
                    <div class="row gy-3 gx-2">
                        @if (count($colorAttr) > 0)
                            <div class="col-sm-2">
                                <label class="form-label" for="product-description">Color Attribute:</label>
                            </div>
                            <div class="col-sm-10 row">
                                @foreach ($colorAttr as $color)
                                    <div class="col-sm-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-text">
                                                <input class="form-check-input colorValue" type="checkbox"
                                                    name="{{ $color->id }}" value="{{ $color->colorValue }}"
                                                    aria-label="Checkbox for following text input" />
                                            </div>
                                            <input class="form-control form-control-color" type="color"
                                                aria-label="Text input with checkbox" value="{{ $color->colorValue }}"
                                                disabled />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="col-sm-2">
                                <label class="form-label" for="product-description">Color Attribute:</label>
                            </div>
                            <div class="col-sm-10">
                                <label class="form-label text-warning" for="product-description">
                                    <strong>Chưa thêm giá trị cho thuộc tính này!</strong>
                                </label>
                            </div>
                        @endif
                        @if (count($sizeAttr) > 0)
                            <div class="col-sm-2">
                                <label class="form-label" for="product-description">Size Attribute:</label>
                            </div>
                            <div class="col-sm-10 row">
                                @foreach ($sizeAttr as $size)
                                    <div class="col-sm-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-text">
                                                <input class="form-check-input sizeValue" type="checkbox"
                                                    name="{{ $size->id }}" value="{{ $size->sizeValue }}"
                                                    aria-label="Checkbox for following text input" />
                                            </div>
                                            <input class="form-control" type="text"
                                                aria-label="Text input with checkbox" value="{{ $size->sizeValue }}"
                                                disabled />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="col-sm-2">
                                <label class="form-label" for="product-description">Size Attribute:</label>
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
                                value="Create Variants">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">
                {{-- CATEGORY --}}
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Categories - Image thumbnail</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="category_id">Select category:
                                    {!! $modelPrd->category['name'] !!}</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="nullSlt">Chọn danh mục</option>
                                    @foreach ($categories as $parent)
                                        @php($each = '')
                                        @include('admin.contents.Product.nested-category', [
                                            'category' => $parent,
                                        ])
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="image_thumbnail">Image thumbnail:</label>
                                <input type="file" class="form-control" name="image_thumbnail" id="image_thumbnail">
                            </div>
                            <div class="col-12 mb-3">
                                <img src="{{ \Storage::url($modelPrd->image_thumbnail) }}" alt="....."
                                    width="364px">
                            </div>
                            @error('image_thumbnail')
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label text-danger">{{ $message }}</label>
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- TAGS --}}
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0 d-flex">Tags:&ensp;
                            @foreach ($modelPrd->tags as $item)
                                <span class="badge bg-info tagItem-{{ $item->id }}">{{ $item->name }}&ensp;
                                    <input class="far fa-trash-alt" type="button"
                                        onclick="removeTag(idTag={{ $item->id }}, urlTag='{{ route('admin.products.delTag', $item->id) }}')">
                                </span> &ensp;
                            @endforeach
                        </h6>
                        @error('tags')
                            <hr>
                            <h6 class="mb-0 d-flex text-danger">{{ $message }}</h6>
                        @enderror
                    </div>
                    <div class="card-body">
                        <label for="organizerMultiple">Select tags</label>
                        <select class="form-select js-choice" id="organizerMultiple" multiple="multiple" size="1"
                            name="tags[]" data-options='{"removeItemButton":true,"placeholder":true}'>
                            @foreach ($dataTags as $tags)
                                <option value="{{ $tags->id }}">{{ $tags->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- PRICE --}}
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Pricing</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            @error('price_default')
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label text-danger">{{ $message }}</label>
                                </div>
                            @enderror
                            @error('sale_percent')
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label text-danger">{{ $message }}</label>
                                </div>
                            @enderror
                            @error('price_sale')
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label text-danger">{{ $message }}</label>
                                </div>
                            @enderror
                            <div class="col-12 mb-3">
                                <label class="form-label" for="price_default">Price regular:</label>
                                <input class="form-control" id="price_default" type="number" min="0"
                                    name="price_default" value="{!! old('price_default') ? old('price_default') : $modelPrd->price_default !!}" />
                            </div>
                            <div class="row gx-2 loadP">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="sale_percent">Discount in percentage:</label>
                                    <input class="form-control" id="sale_percent" type="number" max="100"
                                        min="0" name="sale_percent" value="{!! old('sale_percent') ? old('sale_percent') : $modelPrd->sale_percent !!}" />
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="price_sale">Price sale:</label>
                                    <input class="form-control" id="price_sale" type="number" min="0"
                                        name="price_sale" value="{!! old('price_sale') ? old('price_sale') : $modelPrd->price_sale !!}" />
                                </div>
                            </div>
                            <div class="row gx-2 loadD">
                                <div class="col-6">
                                    <label for="" class="form-label">Start date:</label>
                                    <input type="date" class="form-control" name="start_date"
                                        value="{!! old('start_date') ? old('start_date') : $modelPrd->start_date !!}">
                                </div>
                                <div class="col-6">
                                    <label for="" class="form-label">End date:</label>
                                    <input type="date" class="form-control" name="end_date"
                                        value="{!! old('end_date') ? old('end_date') : $modelPrd->end_date !!}">
                                    {!! isset($warningDate) ? "<label class='form-label text-warning'>$warningDate</label>" : '' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- STATUS --}}
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Product status</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <input class="form-check-input" id="flexSwitchCheckDefault" type="checkbox" name="is_active"
                                value="1" {!! $modelPrd->is_active == 1 ? 'checked' : '' !!} />
                            <label class="form-check-label" for="flexSwitchCheckDefault">Is Active</label>
                        </div>
                        <div class="row gx-2">
                            <div class="col-12 mb-4">
                                <label class="form-label" for="quantity">Product quantity:</label>
                                <input class="form-control" id="quantity" type="number" min="0"
                                    name="quantity" value="{!! old('quantity') ? old('quantity') : $modelPrd->quantity !!}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mt-3">
                <div class="card-footer">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md">
                            <h5 class="mb-2 mb-md-0">You're almost done!</h5>
                        </div>
                        <div class="col-auto">
                            <input type="submit" class="btn btn-primary" value="Update product">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/jquery/jquery.min.js') }}"></script>
@endsection

@section('js-setting')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let priceDefaultInput = document.getElementById('price_default');
            let priceSaleInput, salePercentInput;
            let debounceTimeout;
            let priceRangeContainer = document.querySelector('.row.gx-2.loadP');
            let dateRangeContainer = document.querySelector('.row.gx-2.loadD');

            function updateFormP() {
                let priceDefaultValue = parseFloat(priceDefaultInput.value) || 0;
                if (priceDefaultValue > 0) {
                    priceRangeContainer.innerHTML = `
                    <div class="col-12 mb-3">
                        <label class="form-label" for="sale_percent">Discount in percentage:</label>
                        <input class="form-control" id="sale_percent" type="number" max="100"
                            min="0" name="sale_percent" />
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label" for="price_sale">Price sale:</label>
                        <input class="form-control" id="price_sale" type="number" min="0"
                            name="price_sale" />
                    </div>
                `;
                    priceSaleInput = document.getElementById('price_sale');
                    salePercentInput = document.getElementById('sale_percent');
                    priceSaleInput.addEventListener('input', debounce(
                        () => priceSaleChange(priceDefaultValue, salePercentInput.value),
                        500));
                    salePercentInput.addEventListener('input', debounce(salePercentChange, 500));
                } else {
                    priceRangeContainer.innerHTML = '';
                }
            }

            function debounce(func, delay) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), delay);
                };
            }

            function salePercentChange() {
                let priceSaleV = parseFloat(document.getElementById('price_sale').value);
                let salePercentValue = parseFloat(salePercentInput.value);
                if (salePercentValue > 0) {
                    if (salePercentValue >= 100) {
                        salePercentInput.value = null;
                        salePercentValue = parseFloat(salePercentInput.value);
                        if ((!isNaN(priceSaleV) && priceSaleV > 0) && dateRangeContainer.innerHTML != '') {
                            return alert('Giá khuyến mại % phải nhỏ hơn 100%!');
                        } else {
                            dateRangeContainer.innerHTML = '';
                            return alert('Giá khuyến mại % phải nhỏ hơn 100%!');
                        }
                    } else {
                        dateRangeContainer.innerHTML = `
                        <div class="col-6">
                            <label for="" class="form-label">Start date:</label>
                            <input type="date" class="form-control" name="start_date">
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">End date:</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                    `;
                    }
                } else {
                    if ((!isNaN(priceSaleV) && priceSaleV > 0) && dateRangeContainer.innerHTML != '') {
                        return;
                    } else {
                        dateRangeContainer.innerHTML = '';
                    }
                }
            }

            function priceSaleChange(priceDefaultValue, salePercentValue) {
                let salePercentV = parseFloat(salePercentValue);
                let priceSaleValue = parseFloat(priceSaleInput.value);
                if (priceSaleValue > 0) {
                    if (priceSaleValue >= priceDefaultValue) {
                        priceSaleInput.value = null;
                        priceSaleValue = parseFloat(priceSaleInput.value);
                        if ((!isNaN(salePercentV) && salePercentV > 0) && dateRangeContainer.innerHTML != '') {
                            return alert('Giá khuyến mại phải nhỏ hơn giá gốc!');
                        } else {
                            dateRangeContainer.innerHTML = '';
                            return alert('Giá khuyến mại phải nhỏ hơn giá gốc!');
                        }
                    } else {
                        dateRangeContainer.innerHTML = `
                        <div class="col-6">
                            <label for="" class="form-label">Start date:</label>
                            <input type="date" class="form-control" name="start_date">
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label">End date:</label>
                            <input type="date" class="form-control" name="end_date">
                        </div>
                    `;
                    }
                } else {
                    if ((!isNaN(salePercentV) && salePercentV > 0) && dateRangeContainer.innerHTML != '') {
                        return;
                    } else {
                        dateRangeContainer.innerHTML = '';
                    }
                }
            }
            priceDefaultInput.addEventListener('input', debounce(updateFormP, 500));
        });

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
                                        Product variant: <div
                                            style="width: 25px; height: 25px; background-color: ${value}; margin: 3px;">
                                        </div>
                                        <strong> - ${v}</strong>
                                    </button>
                                </h2>
                                <div class="accordion-collapse collapse" id="collapse-${key}-${v}" aria-labelledby="heading-${value}-${v}"
                                    data-bs-parent="#container-${key}-${v}">
                                    <div class="accordion-body row">
                                        <div class="col-6 mb-4">
                                            <label class="form-label" for="price_default">Price regular:</label>
                                            <input class="form-control" type="number" min="0"
                                                name="prdV[${key}][${k}]['price_dafault']" />
                                        </div>
                                        <div class="col-6 mb-4">
                                            <label class="form-label" for="price_sale">Price sale:</label>
                                            <input class="form-control" type="number" min="0"
                                                name="prdV[${key}][${k}]['price_sale']" />
                                        </div>
                                        <div class="col-6 mb-4">
                                            <label class="form-label" for="">Start date:</label>
                                            <input class="form-control" type="date"
                                                name="prdV[${key}][${k}]['start_date']" />
                                        </div>
                                        <div class="col-6 mb-4">
                                            <label class="form-label" for="">End date:</label>
                                            <input class="form-control" type="date"
                                                name="prdV[${key}][${k}]['end_date']" />
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label class="form-label" for="">Quantity:</label>
                                            <input class="form-control" type="number" value="0"
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

        function removeImage(idImageG, urlI) {
            if (confirm("Chắc chắn muốn xóa ảnh này?")) {
                let elementImage = document.querySelector(
                    `div.col-auto.mb-3.position-relative.image-container.imageGallery-${idImageG}`);
                $.ajax({
                    url: urlI,
                    method: "GET",
                    dataType: "JSON",
                    success: function(res) {
                        $(elementImage).remove();
                        alert(res.success);
                    },
                    error: function(res) {
                        alert(res.error);
                    }
                });
            }
        }

        function removeTag(idTag, urlTag) {
            if (confirm("Chắc chắn muốn xóa tags này?")) {
                let elementTag = document.querySelector(
                    `span.badge.bg-info.tagItem-${idTag}`);
                $.ajax({
                    url: urlTag,
                    method: "GET",
                    dataType: "JSON",
                    success: function(res) {
                        $(elementTag).remove();
                        alert(res.success);
                    },
                    error: function(res) {
                        alert(res.error);
                    }
                });
            }
        }

        function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-12 mb-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image gallery:</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" name="product_galleries[]" id="${id}">
                        <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                            <span class="far fa-trash-alt"></span>
                        </button>
                    </div>
                </div>
            `;
            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            $('#' + id).remove();
        }

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
            '#description',
            [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
                'media', 'table', 'emoticons', 'help'
            ],
            'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
            'forecolor backcolor emoticons | help',
            'favs file edit view insert format tools table help');
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
