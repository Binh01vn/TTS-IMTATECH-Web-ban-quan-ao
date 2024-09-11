@extends('layouts.master')

@section('title')
    Product Variant
@endsection
@section('css-libs')
    <link href="{{ asset('theme/admin/vendors/choices/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet">

    <link href="{{ asset('theme/admin/vendors/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/vendors/select2-bootstrap-5-theme/select2-bootstrap-5-theme.min.css') }}"
        rel="stylesheet">
@endsection
@section('contents')
    <form class="row g-0" action="{{ route('admin.products.storePrd') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12 pe-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row flex-between-center">
                        <div class="col-md">
                            <h5 class="mb-2 mb-md-0">Product Variant</h5>
                        </div>
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
                                <input class="form-control" id="productName" type="text" name="name" />
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="slug">Product slug:</label>
                                <input class="form-control" id="slug" type="text" name="slug" />
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="sku">Product sku:</label>
                                <input class="form-control" id="sku" type="text" name="sku" />
                            </div>
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
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="product-description">Product material:</label>
                            <textarea class="form-control" id="material" name="material"></textarea>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="product-description">User manual:</label>
                            <textarea class="form-control" id="user_manual" name="user_manual"></textarea>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label class="form-label" for="import-status">Product Attribute:</label>
                            <select class="form-select" id="nameAttr" name="nameAttr"
                                onchange="getAttrValue(urlAttrValue='{{ route('admin.products.attrValue') }}')">
                                <option value="" selected>Trống</option>
                                @foreach ($dataAttr as $itemAttr)
                                    <option value="{{ $itemAttr->id }}">{{ $itemAttr->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <div class="row gx-2 flex-between-center mb-3" id="showItemAttr">No product attribute found
                            </div>
                        </div>
                        {{-- <div class="col-sm-6 mb-3">
                            <label class="form-label" for="origin-country">Country of Origin:</label>
                            <select class="form-select" id="origin-country" name="origin-country">
                                <option value="">Select </option>
                                <option value="China">China</option>
                                <option value="India">India</option>
                                <option value="United States">United States</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Russia">Russia</option>
                                <option value="Japan">Japan</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Egypt">Egypt</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="DR Congo">DR Congo</option>
                                <option value="Iran">Iran</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Germany">Germany</option>
                                <option value="France">France</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="origin-country">Country of Origin:</label>
                            <select class="form-select" id="origin-country" name="origin-country">
                                <option value="">Select </option>
                                <option value="China">China</option>
                                <option value="India">India</option>
                                <option value="United States">United States</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Russia">Russia</option>
                                <option value="Japan">Japan</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Egypt">Egypt</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="DR Congo">DR Congo</option>
                                <option value="Iran">Iran</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Germany">Germany</option>
                                <option value="France">France</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="release-date">Release Date:</label>
                            <input class="form-control datetimepicker" id="release-date" type="text"
                                data-options='{"dateFormat":"d/m/y","disableMobile":true}' />
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="warranty-length">Warranty Lenght:</label>
                            <input class="form-control" id="warranty-length" type="text" />
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="warranty-policy">Warranty Policy:</label>
                            <input class="form-control" id="warranty-policy" type="text" />
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">
                {{-- CATEGORY --}}
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Categories</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="category_id">Select category:</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    @foreach ($categoryParent as $parent)
                                        @php($each = '')
                                        @include('admin.contents.Product.nested-category', [
                                            'category' => $parent,
                                        ])
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- TAG --}}
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Tags</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="multiple-select">Select options</label>
                            <select class="form-select selectpicker" id="multiple-select" multiple="multiple"
                                name="tags[]" data-options='{"placeholder":"Select your options"}'>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                                <option>American Samoa</option>
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
                            <div class="col-12 mb-4">
                                <label class="form-label" for="price_default">Price regular:</label>
                                <input class="form-control" id="price_default" type="number" min="0"
                                    name="price_default" />
                            </div>
                            <div class="col-12 mb-4">
                                <label class="form-label" for="sale_percent">Discount in percentage:</label>
                                <input class="form-control" id="sale_percent" type="number" max="100"
                                    min="0" name="sale_percent" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="price_sale">Price final:</label>
                                <input class="form-control" id="price_sale" type="number" min="0"
                                    name="price_sale" />
                            </div>
                        </div>
                    </div>
                </div>
                {{-- SHIPPING METHOD --}}
                {{-- <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Shipping</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input p-2" id="vendor-delivery" type="radio"
                                name="product-shipping" />
                            <label class="form-check-label fs-9 fw-normal text-700" for="vendor-delivery">Delivered by
                                vendor (you)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input p-2" id="falcon-delivery" type="radio"
                                name="product-shipping" />
                            <label class="form-check-label fs-9 fw-normal text-700" for="falcon-delivery">Delivered by
                                FALCON <span class="badge badge-subtle-warning rounded-pill ms-2">Recommended</span>
                            </label>
                        </div>
                    </div>
                </div> --}}
                {{-- STATUS --}}
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Product status</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <input class="form-check-input" id="flexSwitchCheckDefault" type="checkbox" name="is_active"
                                value="1" checked />
                            <label class="form-check-label" for="flexSwitchCheckDefault">Is Active</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" id="flexSwitchCheckChecked" type="checkbox" name="is_new"
                                value="1" checked />
                            <label class="form-check-label" for="flexSwitchCheckChecked">Is Product New</label>
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
                            <input type="reset" class="btn btn-link text-secondary p-0 me-3 fw-medium" value="Discard">
                            <input type="submit" class="btn btn-primary" value="Create product">
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

    <script src="{{ asset('theme/admin/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/select2/select2.full.min.js') }}"></script>
@endsection

@section('js-setting')
    <script>
        function getAttrValue(urlAttrValue) {
            let attributeId = document.getElementById('nameAttr').value;
            let inputType = document.querySelector('input[type="submit"].btn.btn-primary');
            let formAction = document.querySelector('form[method="POST"].row.g-0');
            if (attributeId != '') {
                inputType.value = "Next";
                formAction.action = "{{ route('admin.products.variantPrd') }}";
                $.ajax({
                    url: urlAttrValue,
                    type: 'GET',
                    data: {
                        attribute_id: attributeId
                    },
                    success: function(response) {
                        $('#showItemAttr').empty();
                        response.forEach(function(item) {
                            let isColor = /^#[0-9A-F]{6}$/i.test(item.value);
                            let htmlColor = `
                                <div class="col-sm-4 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="AttrValues[]" value="${item.id}" />
                                        <label class="form-check-label" for="inlineCheckbox">
                                            <input class="form-control form-control-color" type="color" value="${item.value}" disabled/>
                                        </label>
                                    </div>
                                </div>
                            `;
                            let html = `
                                <div class="col-sm-4 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="AttrValues[]" value="${item.id}" />
                                        <label class="form-check-label" for="inlineCheckbox">${item.value}</label>
                                    </div>
                                </div>
                            `;
                            if (isColor) {
                                $('#showItemAttr').append(htmlColor);
                            } else {
                                $('#showItemAttr').append(html);
                            }
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            } else {
                inputType.value = "Create product";
                $('#showItemAttr').empty();
                $('#showItemAttr').append(`
                    <div class="col-12 mb-3">
                        <label class="form-label" for="">No attributes found</label>
                    </div>
                `);
                formAction.action = "{{ route('admin.products.storePrd') }}";
            }
        }
    </script>
    <script>
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
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }
    </script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#description',
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen',
                'insertdatetime',
                'media', 'table', 'emoticons', 'help'
            ],
            toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                'forecolor backcolor emoticons | help',
            menu: {
                favs: {
                    title: 'My Favorites',
                    items: 'code visualaid | searchreplace | emoticons'
                }
            },
            menubar: 'favs file edit view insert format tools table help',
        });
        tinymce.init({
            selector: '#material',
            plugins: 'lists link image table code',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
            menubar: false,
            height: 200,
        });
        tinymce.init({
            selector: '#user_manual',
            plugins: 'lists link image table code',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
            menubar: false,
            height: 200,
        });
    </script>
@endsection
