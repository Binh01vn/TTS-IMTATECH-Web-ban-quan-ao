@extends('layouts.master')

@section('title')
    Tag manager
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
                @error('name')
                    <div class="alert alert-danger border-0 d-flex align-items-center" role="alert">
                        <div class="bg-danger me-3 icon-item">
                            <span class="fas fa-check-circle text-white fs-6"></span>
                        </div>
                        <p class="mb-0 flex-1">{{ $message }}</p>
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">List tags</h5>
                </div>
                <div class="col-auto align-self-center">
                    <button class="btn btn-primary mb-0" type="button" data-bs-toggle="modal"
                        data-bs-target="#addTag-modal">Add new</button>
                    <div class="modal fade" id="addTag-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
                            <form action="{{ route('admin.tags.createTag') }}" class="modal-content position-relative"
                                method="POST">
                                @csrf
                                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                                    <a class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                        data-bs-dismiss="modal" aria-label="Close"></a>
                                </div>
                                <div class="modal-body p-0">
                                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                                        <h4 class="mb-1" id="modalExampleDemoLabel">Add a new tag</h4>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <div class="mb-3">
                                            <label class="col-form-label" for="recipient-name">Name:</label>
                                            <input class="form-control" id="recipient-name" type="text" name="name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" type="submit">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body px-0">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-023429b2-f0b9-4091-bf3c-0936e4daf000"
                    id="dom-023429b2-f0b9-4091-bf3c-0936e4daf000">
                    <table class="table mb-0 data-table fs-10" data-datatables="data-datatables">
                        <thead class="bg-200">
                            <tr>
                                <th class="text-900 sort">#</th>
                                <th class="text-900 sort">Name</th>
                                <th class="text-900 no-sort pe-1 align-middle data-table-row-action"></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="table-simple-pagination-body">
                            @foreach ($data as $item)
                                <tr class="btn-reveal-trigger">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="align-middle white-space-nowrap text-end">
                                        <a class="btn btn-danger" href="{{ route('admin.tags.deleteTag', $item->id) }}"
                                            onclick="return confirm('Có chắc chắn muốn xóa không!')">Delete</a>
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
