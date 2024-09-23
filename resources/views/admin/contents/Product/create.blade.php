@extends('layouts.master')

@section('title')
    Add new Product
@endsection
@section('css-libs')
    <link href="{{ asset('theme/admin/vendors/choices/choices.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet">

    <link href="{{ asset('theme/admin/vendors/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/admin/vendors/select2-bootstrap-5-theme/select2-bootstrap-5-theme.min.css') }}"
        rel="stylesheet">
@endsection
@section('css-setting')
    <style>

    </style>
@endsection
@section('contents')
    <form class="row g-0" action="{{ route('admin.products.storePrd') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12 pe-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row flex-between-center">
                        @if (session('success'))
                            <div class="col-md">
                                <h5 class="mb-0 text-success">{{ session('success') }}</h5>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="col-md">
                                <h5 class="mb-0 text-danger">{{ session('error') }}</h5>
                            </div>
                        @endif
                        <div class="col-md">
                            <h5 class="mb-2 mb-md-0">Add a product</h5>
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
                                <input class="form-control" id="productName" type="text" name="name"
                                    value="{{ old('name') }}" />
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
                            @error('sku')
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
                            <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="product-description">Product material:</label>
                            <textarea class="form-control" id="material" name="material">{{ old('material') }}</textarea>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label" for="product-description">User manual:</label>
                            <textarea class="form-control" id="user_manual" name="user_manual">{{ old('user_manual') }}</textarea>
                        </div>
                        {{-- <div class="col-sm-12 mb-3">
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
                        </div> --}}
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
            {{-- PRODUCT VARIANT --}}
            <div class="card mb-3 mb-lg-0">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Product Variant</h6>
                </div>
                <div class="card-body">
                    <div class="row gy-3 gx-2">
                        @foreach ($dataAttr as $itemAttr)
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <input class="form-check-input" id="attr-select{{ $itemAttr->id }}" type="checkbox"
                                        name="attrID[]" value="{{ $itemAttr->id }}" onclick="getAttrValue(this)">
                                    <label class="form-check-label"><strong>{{ $itemAttr->name }}</strong></label>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-md-4 row" id="attrValue-select{{ $itemAttr->id }}"></div>
                                    <div class="col-md-8 row" id="select-variant{{ $itemAttr->id }}"></div>
                                    <div class="col-sm-12 mb-3 naf-{{ $itemAttr->id }}">No attributes found</div>
                                </div>
                            </div>
                        @endforeach
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
                            <div class="col-12 mb-3">
                                <label class="form-label" for="image_thumbnail">Image thumbnail:</label>
                                <input type="file" class="form-control" name="image_thumbnail" id="image_thumbnail">
                            </div>
                            @error('image_thumbnail')
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label text-danger">{{ $message }}</label>
                                </div>
                            @enderror
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
                            <label for="multiple-select">Select tags</label>
                            <select class="form-select selectpicker" id="tags-select" multiple="multiple" name="tags[]"
                                data-options='{"placeholder":"Select your tags"}'>
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
                            <div class="col-12 mb-4">
                                <label class="form-label" for="price_default">Price regular:</label>
                                <input class="form-control" id="price_default" type="number" min="0"
                                    name="price_default" value="{{ old('price_default') }}" />
                            </div>
                            <div class="row gx-2 loadP"></div>
                            <div class="row gx-2 loadD"></div>
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
                        <div class="row gx-2">
                            <div class="col-12 mb-4">
                                <label class="form-label" for="quantity">Product quantity:</label>
                                <input class="form-control" id="quantity" type="number" min="0"
                                    name="quantity" value="{{ old('quantity') }}" />
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
                    <div class="col-12 mb-4">
                        <label class="form-label" for="sale_percent">Discount in percentage:</label>
                        <input class="form-control" id="sale_percent" type="number" max="100"
                            min="0" name="sale_percent" />
                    </div>
                    <div class="col-12">
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
            // Lắng nghe sự kiện khi người dùng thay đổi giá trị trong input
            priceDefaultInput.addEventListener('input', debounce(updateFormP, 500));
        });

        function getAttrValue(checkbox) {
            let urlAttrValue = `{{ route('admin.products.attrValue') }}`;
            let inputType = document.querySelector('input[type="submit"].btn.btn-primary');
            let formAction = document.querySelector('form[method="POST"].row.g-0');
            let attributeId = checkbox.value;
            let divToRemove = document.querySelector(`.col-sm-12.mb-3.naf-${attributeId}`);

            if (checkbox.checked == true && attributeId > 0) {
                $.ajax({
                    url: urlAttrValue,
                    type: 'GET',
                    data: {
                        attribute_id: attributeId
                    },
                    success: function(response) {
                        if (divToRemove && response.length > 0) {
                            divToRemove.remove();
                        }
                        response.forEach(function(item) {
                            let isColor = /^#[0-9A-F]{6}$/i.test(item.value);
                            let html;
                            if (isColor == true) {
                                html = `
                                        <div class="col-sm-4" name="item_${attributeId}">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="attrValue[${attributeId}][${item.id}]" value="${item.value}" onclick="modalPrdV(this)">
                                                <label class="form-check-label">
                                                    <div style="width: 18px; height: 18px; margin: 5px; background-color: ${item.value}; border-radius: 3px;"></div>
                                                </label>
                                            </div>
                                        </div>
                                    `;
                            } else {
                                html = `
                                        <div class="col-sm-4" name="item_${attributeId}">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="attrValue[${attributeId}][${item.id}]" value="${item.value}" onclick="modalPrdV(this)">
                                                <label class="form-check-label"><strong class="strong-values">${item.value}</strong></label>
                                            </div>
                                        </div>
                                    `;
                            }
                            $(`#attrValue-select${attributeId}`).append(html);
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
            if (checkbox.checked == false && divToRemove == null) {
                $(`div[name="item_${attributeId}"]`).remove();
                $(`#attrValue-select${attributeId}`).append(`
                    <div class="col-sm-12 mb-3 naf-${attributeId}">No attributes found</div>
                `);
                $(`.accordion.col-sm-12.prdV-${attributeId}`).remove();
            }
        }

        function modalPrdV(checkbox) {
            let inputValue = checkbox.value;
            let [_, attributeId, itemId] = checkbox.name.match(/\[(\d+)\]\[(\d+)\]/) || [];
            let isColor = /^#[0-9A-F]{6}$/i.test(inputValue);
            let modalHTML;
            if (checkbox.checked == true) {
                if (isColor == true) {
                    modalHTML = `
                    <div class="accordion col-sm-12 prdV-${attributeId}" style="margin-bottom: 5px;" id="prdVariant-${itemId}">
                        <div class="accordion-item" style="">
                            <h2 class="accordion-header" id="heading${itemId}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#variant${itemId}" aria-expanded="true" aria-controls="variant${itemId}">Variant - <div style="width: 18px; height: 18px; margin: 5px; background-color: ${inputValue}; border-radius: 3px;"></div></button>
                            </h2>
                            <div class="accordion-collapse collapse" id="variant${itemId}" aria-labelledby="heading${itemId}"
                                data-bs-parent="#prdVariant-${itemId}">
                                <div class="accordion-body row">
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="price_default">Price regular:</label>
                                        <input class="form-control" id="price_default" type="number" min="0"
                                            name="prdV[${attributeId}][${itemId}]['price_dafault']" />
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="price_sale">Price sale:</label>
                                        <input class="form-control" id="price_sale" type="number" min="0"
                                            name="prdV[${attributeId}][${itemId}]['price_sale']" />
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label class="form-label" for="price_default">Start date:</label>
                                        <input class="form-control" id="price_default" type="date"
                                            name="prdV[${attributeId}][${itemId}]['start_date']" />
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label class="form-label" for="price_default">End date:</label>
                                        <input class="form-control" id="price_default" type="date"
                                            name="prdV[${attributeId}][${itemId}]['end_date']" />
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="price_sale">Quantity:</label>
                                        <input class="form-control" id="price_sale" type="number" value="0"
                                            name="prdV[${attributeId}][${itemId}]['quantity']" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                } else {
                    modalHTML = `
                    <div class="accordion col-sm-12 prdV-${attributeId}" style="margin-top: 5px;" id="prdVariant-${itemId}">
                        <div class="accordion-item" style="">
                            <h2 class="accordion-header" id="heading${itemId}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#variant${itemId}" aria-expanded="true" aria-controls="variant${itemId}">Variant - ${inputValue}</button>
                            </h2>
                            <div class="accordion-collapse collapse" id="variant${itemId}" aria-labelledby="heading${itemId}"
                                data-bs-parent="#prdVariant-${itemId}">
                                <div class="accordion-body row">
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="price_default">Price regular:</label>
                                        <input class="form-control" id="price_default" type="number" min="0"
                                            name="prdV[${attributeId}][${itemId}]['price_dafault']" />
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="price_sale">Price sale:</label>
                                        <input class="form-control" id="price_sale" type="number" min="0"
                                            name="prdV[${attributeId}][${itemId}]['price_sale']" />
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label class="form-label" for="price_default">Start date:</label>
                                        <input class="form-control" id="price_default" type="date"
                                            name="prdV[${attributeId}][${itemId}]['start_date']" />
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label class="form-label" for="price_default">End date:</label>
                                        <input class="form-control" id="price_default" type="date"
                                            name="prdV[${attributeId}][${itemId}]['end_date']" />
                                    </div>
                                    <div class="col-12 mb-4">
                                        <label class="form-label" for="price_sale">Quantity:</label>
                                        <input class="form-control" id="price_sale" type="number" value="0"
                                            name="prdV[${attributeId}][${itemId}]['quantity']" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                }
                $(`#select-variant${attributeId}`).append(modalHTML);
            }
            if (checkbox.checked == false) {
                $(`#prdVariant-${itemId}`).remove();
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
            $('#' + id).remove();
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
