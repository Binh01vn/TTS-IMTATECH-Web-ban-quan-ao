@extends('layouts.master')

@section('title')
    List Categories
@endsection

@section('contents')
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                @if (session('success'))
                    <div class="col-auto align-self-center">
                        <h5 class="mb-0 text-success">{{ session('success') }}</h5>
                    </div>
                @endif
                @if (session('error'))
                    <div class="col-auto align-self-center">
                        <h5 class="mb-0 text-danger">{{ session('error') }}</h5>
                    </div>
                @endif
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">List categories</h5>
                </div>
            </div>
            <hr>
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <form class="row gy-2 gx-3 align-items-center" action="{{ route('admin.categories.storeDM') }}"
                        method="POST">
                        @csrf
                        <div class="col-auto">
                            <label class="form-label" for="autoSizingInput">Name</label>
                            <input class="form-control" id="autoSizingInput" type="text" name="name" />
                            @error('name')
                                <div class="alert alert-danger border-0 d-flex align-items-center" role="alert">
                                    <div class="bg-danger me-3 icon-item">
                                        <span class="fas fa-check-circle text-white fs-6"></span>
                                    </div>
                                    <p class="mb-0 flex-1">{{ $message }}</p>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @enderror
                        </div>
                        <div class="col-auto">
                            <label class="form-label" for="autoSizingSelect">Parent item</label>
                            <select class="form-select" id="autoSizingSelect" name="parent_id">
                                <option value="" selected>Trống</option>
                                @foreach ($categoryParent as $parent)
                                    @php($each = '')
                                    @include('admin.contents.category.nested-category', [
                                        'category' => $parent,
                                    ])
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <div class="form-check mb-0">
                                <input class="form-check-input" id="autoSizingCheck" type="checkbox" value="1" checked
                                    name="is_active" />
                                <label class="form-check-label mb-0" for="autoSizingCheck">Is active</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <label class="form-label" for="basic-form-textarea">Description</label>
                            <textarea class="form-control" id="basic-form-textarea" rows="2" cols="50" name="description"></textarea>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary" type="submit">Add new</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body px-0">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-023429b2-f0b9-4091-bf3c-0936e4daf000"
                    id="dom-023429b2-f0b9-4091-bf3c-0936e4daf000">
                    <table class="table mb-0 data-table fs-10" data-datatables="data-datatables">
                        <thead class="bg-200">
                            <tr>
                                <th class="text-900 sort">Name</th>
                                <th class="text-900 sort">Slug</th>
                                <th class="text-900 sort">Description</th>
                                <th class="text-900 sort">Status</th>
                                <th class="text-900 sort text-end">Parent item</th>
                                <th class="text-900 no-sort pe-1 align-middle data-table-row-action"></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="table-simple-pagination-body">
                            @foreach ($data as $item)
                                <tr class="btn-reveal-trigger">
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->slug }}</td>
                                    <td>
                                        {!! $item->description ? $item->description : '<strong>Null description</strong>' !!}
                                    </td>
                                    <td>
                                        {!! $item->is_active == 0
                                            ? '<span class="badge badge rounded-pill badge-subtle-warning">No active</span>'
                                            : '<span class="badge badge rounded-pill badge-subtle-success">Active</span>' !!}
                                    </td>
                                    <td class="text-end">
                                        {!! $item->parent_id == 0 ? '<strong>Null parent</strong>' : '' . $item->parent?->name . '' !!}
                                    </td>
                                    <td class="align-middle white-space-nowrap text-end">
                                        <div class="dropstart font-sans-serif position-static d-inline-block">
                                            <button
                                                class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end"
                                                type="button" id="dropdown-simple-pagination-table-item-0"
                                                data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true"
                                                aria-expanded="false" data-bs-reference="parent">
                                                <span class="fas fa-ellipsis-h fs-10"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end border py-2"
                                                aria-labelledby="dropdown-simple-pagination-table-item-0">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.categories.editDM', $item->slug) }}">Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger"
                                                    href="{{ route('admin.categories.deleteDM', $item->slug) }}"
                                                    onclick="return confirm('Có chắc chắn muốn xóa không!')">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/datatables.net/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/datatables.net-fixedcolumns/dataTables.fixedColumns.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.min.css') }}"></script>
@endsection
