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
@section('contents')
    <form class="row g-0" action="{{ route('admin.products.storePrd') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12 pe-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row flex-between-center">
                        <div class="col-md">
                            <h5 class="mb-2 mb-md-0">Add a product</h5>
                        </div>
                        <div class="col-auto">
                            {{-- <a class="btn btn-info" id="normal" onclick="addProductNormal()" hidden>Normal</a> --}}
                            <a class="btn btn-info" id="changeProduct" onclick="addProductVariant()">Variant</a>
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
                            <div class="col-12 mb-3">
                                <label class="form-label" for="manufacturar-name">SKU Product:</label>
                                <input class="form-control" id="skuProduct" type="text" name="sku" readonly />
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
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="import-status">Import Status:</label>
                            <select class="form-select" id="import-status" name="import-status">
                                <option value="imported">Imported</option>
                                <option value="processing">Processing </option>
                                <option value="validating">Validating </option>
                                <option value="draft">Draft</option>
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
                        </div>
                    </div>
                </div>
            </div>
            {{-- PRODUCT VARIANT --}}
            <div class="card mb-3 mb-lg-0">
                <div id="showFormVariant"></div>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">
                {{-- CATEGORY --}}
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Type</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-3">
                                <label class="form-label" for="product-category">Select category:</label>
                                <select class="form-select" id="product-category" name="product-category">
                                    <option value="computerAccessories">Computer & Accessories</option>
                                    <option>Class, Training, or Workshop</option>
                                    <option>Concert or Performance</option>
                                    <option>Conference</option>
                                    <option>Convention</option>
                                    <option>Dinner or Gala</option>
                                    <option>Festival or Fair</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="product-subcategory">Select sub-category:</label>
                                <select class="form-select" id="product-subcategory" name="product-subcategory">
                                    <option value="laptop">Laptop</option>
                                    <option>Class, Training, or Workshop</option>
                                    <option>Concert or Performance</option>
                                    <option>Conference</option>
                                    <option>Convention</option>
                                    <option>Dinner or Gala</option>
                                    <option>Festival or Fair</option>
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
                            <div class="col-8 mb-3">
                                <label class="form-label" for="base-price">Base Price:
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Product regular price">
                                        <span class="fas fa-question-circle text-primary fs-10 ms-1"></span>
                                    </span>
                                </label>
                                <input class="form-control" id="base-price" type="text" />
                            </div>
                            <div class="col-4">
                                <label class="form-label" for="price-currency">Currency:</label>
                                <select class="form-select" id="price-currency" name="price-currency">
                                    <option value="usd">USD</option>
                                    <option value="eur">EUR</option>
                                    <option value="gbp">GBP</option>
                                    <option value="cad">CAD</option>
                                </select>
                            </div>
                            <div class="col-12 mb-4">
                                <label class="form-label" for="discount-percentage">Discount in
                                    percentage:</label>
                                <input class="form-control" id="discount-percentage" type="text" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="final-price">Final price:
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Product final price">
                                        <span class="fas fa-question-circle text-primary fs-10 ms-1"></span>
                                    </span>
                                </label>
                                <input class="form-control" id="final-price" type="text" />
                            </div>
                        </div>
                    </div>
                </div>
                {{-- SHIPPING METHOD --}}
                <div class="card mb-3">
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
                </div>
                {{-- STATUS --}}
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Stock status</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input p-2" id="in-stock" type="radio" name="stock-status" />
                            <label class="form-check-label fs-9 fw-normal text-700" for="in-stock">In
                                stock</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input p-2" id="unavailable" type="radio" name="stock-status" />
                            <label class="form-check-label fs-9 fw-normal text-700" for="unavailable">Unavailable</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input p-2" id="to-be-announced" type="radio"
                                name="stock-status" />
                            <label class="form-check-label fs-9 fw-normal text-700" for="to-be-announced">To be
                                announced</label>
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
                            <button class="btn btn-link text-secondary p-0 me-3 fw-medium" type="reset">Discard</button>
                            <button class="btn btn-primary" type="submit">Create product</button>
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
        $(document).ready(function() {
            $('#productName').on('input', function() {
                var text = $(this).val();
                var slug = convertToSlug(text);
                $('#skuProduct').val(slug);
            });

            function convertToSlug(text) {
                // Chuyển đổi ký tự tiếng Việt thành ký tự không dấu
                var slug = text.toLowerCase();
                slug = slug.replace(/á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|ä|æ/g, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë/g, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị|ï/g, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ö|œ/g, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|ü/g, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ|ÿ/g, 'y');
                slug = slug.replace(/đ/g, 'd');

                // Thay thế các ký tự không phải chữ cái và số bằng dấu gạch ngang
                slug = slug.replace(/[^a-z0-9]/g, '-');

                // Loại bỏ các dấu gạch ngang dư thừa và đầu/ cuối
                slug = slug.replace(/-+/g, '-');
                slug = slug.replace(/^-+/, '');
                slug = slug.replace(/-+$/, '');
                slug = slug.toUpperCase();
                return slug;
            }
        });
    </script>
    <script>
        var changeProduct = document.getElementById('changeProduct');

        function addProductVariant() {
            let html = `
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Specifications</h6>
                </div>
                <div class="card-body">
                    <div class="row gx-2 flex-between-center mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0 text-600">Processor</h6>
                        </div>
                        <div class="col-sm-9">
                            <div class="d-flex flex-between-center">
                                <h6 class="mb-0 text-700">2.3GHz quad-core Intel Core i5</h6>
                                <a class="btn btn-sm btn-link text-danger" href="#!" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Remove">
                                    <span class="fs-10 fas fa-trash-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-2 flex-between-center mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0 text-600">Memory</h6>
                        </div>
                        <div class="col-sm-9">
                            <div class="d-flex flex-between-center">
                                <h6 class="mb-0 text-700">8GB of 2133MHz LPDDR3 onboard memory</h6>
                                <a class="btn btn-sm btn-link text-danger" href="#!" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Remove">
                                    <span class="fs-10 fas fa-trash-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-2 flex-between-center mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0 text-600">Brand name</h6>
                        </div>
                        <div class="col-sm-9">
                            <div class="d-flex flex-between-center">
                                <h6 class="mb-0 text-700">Apple</h6>
                                <a class="btn btn-sm btn-link text-danger" href="#!" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Remove">
                                    <span class="fs-10 fas fa-trash-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3 gx-2">
                        <div class="col-sm-3">
                            <input class="form-control form-control-sm" id="specification-label" type="text"
                                placeholder="Label" />
                        </div>
                        <div class="col-sm-9">
                            <div class="d-flex gap-2 flex-between-center">
                                <input class="form-control form-control-sm" id="specification-property" type="text"
                                    placeholder="Property" />
                                <button class="btn btn-sm btn-falcon-default">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('#showFormVariant').append(html);
            changeProduct.innerText = 'Normal';
            changeProduct.setAttribute('onclick', 'addProductNormal()');
        }
        function addProductNormal() {
            $('#showFormVariant').remove();
            changeProduct.innerText = 'Variant';
            changeProduct.setAttribute('onclick', 'addProductVariant()');
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
    </script>
@endsection
