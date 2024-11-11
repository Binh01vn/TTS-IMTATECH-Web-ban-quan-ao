@extends('layouts.admin')
@section('title')
    Quản lý danh mục - phân loại
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
                            <h5 class="mb-2 mb-md-0">Danh mục - Phân loại</h5>
                        @endif
                    @endif
                </div>
                {{-- <div class="col-auto">
                    <button class="btn btn-primary" role="button">Add product </button>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="row g-0">
        <div class="col-lg-8 pe-lg-2">
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Phân loại</h6>
                </div>
                <div class="card-body">
                    <div id="tableExample3" data-list='{"valueNames":["stt","dm"]}'>
                        <div class="table-responsive scrollbar">
                            <table class="table table-bordered table-striped fs-10 mb-0">
                                <thead class="bg-200">
                                    <tr>
                                        <th class="text-900 sort text-center" data-sort="stt" style="width: 50px;">#</th>
                                        <th class="text-900 sort" data-sort="dm">Tên loại</th>
                                        <th class="text-900">Mô tả</th>
                                        <th class="text-900"></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (isset($data) && count($data) > 0)
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="stt">{{ $item->id }}</td>
                                                <td class="dm">
                                                    <strong>{{ $item->name }}</strong><br>
                                                    {{ $item->slug }}
                                                </td>
                                                <td>
                                                    <h6 class="text-center">{{ $item->description }}</h6>
                                                </td>
                                                <td class="text-end">
                                                    <button class="btn btn-warning"
                                                        onclick="rendForm(urlink='{{ route('admin.categories.edit_pl', $item->slug) }}')">
                                                        Sửa
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="4">
                                                <strong class="text-warning">Danh sách trống!</strong>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">Danh mục</h6>
                </div>
                <div class="card-body">
                    <div id="tableExample3" data-list='{"valueNames":["stt","dm"]}'>
                        <div class="table-responsive scrollbar">
                            <table class="table table-bordered table-striped fs-10 mb-0">
                                <thead class="bg-200">
                                    <tr>
                                        <th class="text-900 sort text-center" data-sort="stt" style="width: 50px;">#</th>
                                        <th class="text-900 sort" data-sort="dm">Tên danh mục</th>
                                        <th class="text-900">Mô tả</th>
                                        <th class="text-900"></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (isset($data2) && count($data2) > 0)
                                        @foreach ($data2 as $item)
                                            <tr>
                                                <td class="stt">{{ $item->id }}</td>
                                                <td class="dm">
                                                    <strong>{{ $item->name }}</strong><br>
                                                    {{ $item->slug }}
                                                </td>
                                                <td>
                                                    <h6 class="text-center">{{ $item->description }}</h6>
                                                </td>
                                                <td class="text-end">
                                                    <button
                                                        onclick="rendForm(urlink='{{ route('admin.categories.edit_dm', $item->slug) }}')"
                                                        class="btn btn-warning">Sửa</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="4">
                                                <strong class="text-warning">Danh sách trống!</strong>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            {{ $data2->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">
                <div class="card mb-3 rendFormEdit"></div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Tạo mới Phân loại</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <form action="{{ route('admin.categories.them_pl') }}" method="post">
                                @csrf
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="name">Nhập tên loại:</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <label class="form-label text-danger" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="description">Mô tả ngắn:</label>
                                    <textarea class="form-control" name="description" id="description">
                                        {{ old('description') }}
                                    </textarea>
                                    @error('description')
                                        <label class="form-label text-danger" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success">Tạo mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Tạo mới Danh mục</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <form action="{{ route('admin.categories.them_dm') }}" method="post">
                                @csrf
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="id_phan_loai">Chọn phân loại:</label>
                                        <select class="form-select selectpicker" id="id_phan_loai" multiple="multiple"
                                            data-options='{"placeholder":"Chọn phân loại danh mục"}'
                                            name="id_phan_loai[]">
                                            @foreach ($categorization as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="name">Nhập tên danh mục:</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <label class="form-label text-danger" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="description">Mô tả ngắn:</label>
                                    <textarea class="form-control" name="description" id="description">
                                    {{ old('description') }}
                                </textarea>
                                    @error('description')
                                        <label class="form-label text-danger" for="name">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success">Tạo mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css-libs')
    <link rel="stylesheet" href="{{ asset('theme/admin/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('theme/admin/vendors/select2-bootstrap-5-theme/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/select2/select2.full.min.js') }}"></script>
@endsection
@section('js-setting')
    <script>
        function rendForm(urlink) {
            if (urlink) {
                $.ajax({
                    url: urlink,
                    method: "GET",
                    success: function(res) {
                        let rend = document.querySelector('div.card.mb-3.rendFormEdit');
                        let html_form = `
                        <div class="card-header bg-warning">
                            <h6 class="mb-0">Cập nhật thông tin</h6>
                        </div>
                        <div class="card-body bg-light">
                            <div class="row gx-2">
                                <form action="${res.url_update}" method="post">
                                    @csrf
                                    @method('PUT') 
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="name">Tên:</label>
                                        <input class="form-control" type="text" name="name" id="name"
                                            value="${res.data.name}">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="form-label" for="description">Mô tả ngắn:</label>
                                        <textarea class="form-control" name="description" id="description">
                                            ${res.data.description == null ? '' : res.data.description}
                                        </textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-info">Cập nhật</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        `;
                        $(rend).empty();
                        $(rend).append(html_form);
                    },
                    error: function(res) {
                        alert(res.error);
                    }
                });
            } else {
                alert('Lỗi, không thể thực hiện được!');
            }
        }
    </script>
@endsection
