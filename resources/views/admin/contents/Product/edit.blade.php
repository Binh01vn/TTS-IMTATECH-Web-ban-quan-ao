@extends('layouts.master')

@section('title')
    Edit Product
@endsection
@section('css-libs')
    <link href="{{ asset('theme/admin/vendors/choices/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/vendors/dropzone/dropzone.css') }}" rel="stylesheet" />
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
    <form class="row g-0" action="{{ route('admin.products.updateProduct', $modelPrd->slug) }}" method="POST"
        enctype="multipart/form-data" id="productForm">
        @csrf
        @method('PUT')
        <div class="col-lg-8 pe-lg-2">
            {{-- BASIC INFORMATION --}}
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Basic information</h6>
                </div>
                <div class="card-body">
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
                        <div class="dropzone dropzone-multiple p-0" id="dropzoneMultipleFileUpload"
                            data-dropzone="data-dropzone">
                            <div class="dz-message" data-dz-message="data-dz-message">
                                <img class="me-2" src="{{ asset('theme/admin/assets/img/icons/cloud-upload.svg') }}"
                                    width="25" alt="" />
                                <span class="d-none d-lg-inline">Drag your image here<br />or, </span>
                                <span class="btn btn-link p-0 fs-10">Browse</span>
                            </div>
                            <div class="dz-preview dz-preview-multiple m-0 d-flex flex-column">
                                <div class="d-flex media align-items-center mb-3 pb-3 border-bottom btn-reveal-trigger">
                                    <img class="dz-image"
                                        src="{{ asset('theme/admin/assets/img/icons/cloud-upload.svg') }}" alt="..."
                                        data-dz-thumbnail="data-dz-thumbnail" />
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
                                                <a class="dropdown-item" href="#!"
                                                    data-dz-remove="data-dz-remove">Remove File</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="file" name="product_galleries[]" id="hidden-files" multiple style="display: none;">
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
                            <textarea class="tinymce d-none" data-tinymce="data-tinymce" name="description" id="description">
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
                                        <div class="input-group input-group-sm mb-3">
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
                                        <div class="input-group input-group-sm mb-3">
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
                                value="{!! count($modelPrd->variants) > 0 ? 'More Variants' : 'Create Variants' !!}">
                        </div>
                    </div>
                    @if (count($variantPRD) > 0)
                        <hr>
                        <div class="row gy-3 gx-2">
                            @foreach ($variantPRD as $item)
                                @foreach ($item->variantValues as $itemVRT)
                                    <div class="accordion col-lg-6 mb-3 pe-lg-12" id="container-{{ $item->id }}">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading-{{ $item->id }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse-{{ $item->id }}" aria-expanded="true"
                                                    aria-controls="collapse-{{ $item->id }}">
                                                    <div
                                                        style="width: 25px; height: 25px; background-color: {{ $itemVRT->color_value }}; margin: 3px;">
                                                    </div>
                                                    <strong> - {{ $itemVRT->color_value }}</strong>
                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse" id="collapse-{{ $item->id }}"
                                                aria-labelledby="heading-{{ $item->id }}"
                                                data-bs-parent="#container-{{ $item->id }}">
                                                <div class="accordion-body row">
                                                    <div class="col-12 mb-4">
                                                        <a href="" class="btn btn-danger">Delete Variant</a>
                                                    </div>
                                                    <div class="col-6 mb-4">
                                                        <label class="form-label" for="price_default">Price
                                                            regular:</label>
                                                        <input class="form-control" type="number" min="0"
                                                            name="updateV[{{ $item->id }}]['price_default']"
                                                            value="{{ $item->price_default }}" />
                                                    </div>
                                                    <div class="col-6 mb-4">
                                                        <label class="form-label" for="price_sale">Price sale:</label>
                                                        <input class="form-control" type="number" min="0"
                                                            name="updateV[{{ $item->id }}]['price_sale']"
                                                            value="{{ $item->price_sale }}" />
                                                    </div>
                                                    <div class="col-6 mb-4">
                                                        <label class="form-label" for="">Start date:</label>
                                                        <input class="form-control" type="date"
                                                            name="updateV[{{ $item->id }}]['start_date']"
                                                            value="{{ $item->start_date }}" />
                                                    </div>
                                                    <div class="col-6 mb-4">
                                                        <label class="form-label" for="">End date:</label>
                                                        <input class="form-control" type="date"
                                                            name="updateV[{{ $item->id }}]['end_date']"
                                                            value="{{ $item->end_date }}" />
                                                    </div>
                                                    <div class="col-12 mb-4">
                                                        <label class="form-label" for="">Quantity:</label>
                                                        <input class="form-control" type="number"
                                                            name="updateV[{{ $item->id }}]['quantity']"
                                                            value="{{ $item->quantity }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">
                {{-- CATEGORY --}}
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Categories - Image</h6>
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
                            <div class="col-12 mb-3 row">
                                <div class="col-lg-5 pe-lg-12">
                                    <label class="form-label" for="image_thumbnail">Image galleries:</label>
                                </div>
                                <div class="col-lg-7 pe-lg-12">
                                    <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                        data-bs-target="#public-images">Public images</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- TAGS --}}
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Tags</h6>
                        @error('tags')
                            <hr>
                            <h6 class="mb-0 text-danger">{{ $message }}</h6>
                        @enderror
                    </div>
                    <div class="card-body row">
                        <div class="col-12 mb-3">
                            @foreach ($modelPrd->tags as $item)
                                <span class="badge bg-info tagItem-{{ $item->id }}">{{ $item->name }}&ensp;
                                    <input class="far fa-trash-alt" type="button"
                                        onclick="removeTag(idTag={{ $item->id }}, urlTag='{{ route('admin.products.delTag', $item->id) }}')">
                                </span> &ensp;
                            @endforeach
                        </div>
                        <div class="form-group col-12 mb-3">
                            <label for="organizerMultiple">Select tags</label>
                            <select class="form-select js-choice" id="organizerMultiple" multiple="multiple"
                                size="1" name="tags[]"
                                data-options='{"removeItemButton":true,"placeholder":true}'>
                                @foreach ($dataTags as $tags)
                                    <option value="{{ $tags->id }}">{{ $tags->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
                            <input type="submit" class="btn btn-primary" value="Update product" id="submit-button">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="public-images" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Image galleries</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="mb-3 row">
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
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/choices/choices.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/dropzone/dropzone-min.js') }}"></script>
@endsection

@section('js-setting')
    <script>
        function rendFormUV(idV, vc, vs) {
            console.log(idV, vc, vs);

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
                                        Product variant: <div
                                            style="width: 25px; height: 25px; background-color: ${value}; margin: 3px;">
                                        </div>
                                        <strong> - ${v}</strong>
                                    </button>
                                </h2>
                                <div class="accordion-collapse collapse" id="collapse-${key}-${v}" aria-labelledby="heading-${key}-${v}"
                                    data-bs-parent="#container-${key}-${v}">
                                    <div class="accordion-body row">
                                        <div class="col-6 mb-4">
                                            <label class="form-label" for="price_default">Price regular:</label>
                                            <input class="form-control" type="number" min="0"
                                                name="prdV[${key}][${k}]['price_default']" />
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
                                            <input class="form-control" type="number"
                                                name="prdV[${key}][${k}]['quantity']" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="${value}" name="prdV[${key}][${k}]['color_value']" />
                            <input type="hidden" value="${v}" name="prdV[${key}][${k}]['size_value']" />
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
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone("#dropzoneMultipleFileUpload", {
            url: "#", // Không cần URL vì sẽ submit form thông thường
            autoProcessQueue: false, // Không tự động upload
            uploadMultiple: true, // Cho phép chọn nhiều file
            parallelUploads: 10, // Giới hạn số file upload đồng thời
            maxFilesize: 5, // Kích thước file tối đa
            acceptedFiles: "image/*", // Chỉ nhận file ảnh
            previewsContainer: document.querySelector(".dz-preview"),
            previewTemplate: document.querySelector(".dz-preview").innerHTML,
            clickable: true, // Cho phép người dùng click vào vùng Dropzone để chọn file
            init: function() {
                var myDropzone = this;
                document.querySelector(".dz-preview").innerHTML = "";
                // Lắng nghe sự kiện lỗi khi chọn file
                myDropzone.on("error", function(file, message) {
                    // Hiển thị thông báo lỗi
                    alert("Error: " + message);
                    // Loại bỏ file khỏi Dropzone
                    myDropzone.removeFile(file);
                });
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
