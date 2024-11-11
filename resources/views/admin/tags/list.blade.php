@extends('layouts.admin')
@section('title')
    Quản lý thẻ
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
                            <h5 class="mb-2 mb-md-0">Thẻ</h5>
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
                    <h6 class="mb-0">Danh sách thẻ</h6>
                </div>
                <div class="card-body">
                    <div id="tableExample3" data-list='{"valueNames":["stt","dm"]}'>
                        <div class="table-responsive scrollbar">
                            <table class="table table-bordered table-striped fs-10 mb-0">
                                <thead class="bg-200">
                                    <tr>
                                        <th class="text-900 sort text-center" data-sort="stt" style="width: 50px;">#</th>
                                        <th class="text-900 sort" data-sort="dm">Tên thẻ</th>
                                        <th class="text-900">slug</th>
                                        <th class="text-900"></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (isset($data) && count($data) > 0)
                                        @php $index = 1; @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td class="stt">{{ $index }}</td>
                                                <td class="dm">
                                                    <strong>{{ $item->name }}</strong>
                                                </td>
                                                <td>
                                                    <h6 class="text-center">{{ $item->slug }}</h6>
                                                </td>
                                                <td class="text-end">
                                                    <form action="{{ route('admin.tags.xoa_tag', $item) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Có chắc chắn muốn xóa không!')">Xóa</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @php $index++; @endphp
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
                    <div class="row gx-0">
                        <div class="col-lg-12">
                            {{ $data->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">
                <div class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Tạo mới thẻ</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <form action="{{ route('admin.tags.them_tag') }}" method="post">
                                @csrf
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="name">Nhập tên thẻ:</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                        value="{{ old('name') }}">
                                    @error('name')
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
