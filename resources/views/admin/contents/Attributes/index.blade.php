@extends('layouts.master')

@section('title')
    Attributes Manager
@endsection

@section('contents')
    <div class="row g-0">
        <div class="col-lg-12 pe-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row flex-between-center">
                        <div class="col-md">
                            @if (session('error'))
                                <h5 class="mb-2 mb-md-0 text-danger">{{ session('error') }}</h5>
                            @else
                                @if (session('success'))
                                    <h5 class="mb-2 mb-md-0 text-success">{{ session('success') }}</h5>
                                @else
                                    <h5 class="mb-2 mb-md-0">Attributes Manager</h5>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 pe-lg-2">
            <div class="card shadow-none">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">List Attribute</h6>
                </div>
                <div class="card-body p-0 pb-3">
                    <div class="table-responsive scrollbar">
                        <table class="table mb-0">
                            <thead class="bg-200">
                                <tr>
                                    <th class="text-black dark__text-white align-middle">Name</th>
                                    <th class="text-black dark__text-white align-middle">Attribute Value</th>
                                    <th class="text-black dark__text-white align-middle white-space-nowrap pe-3"
                                        colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <th class="align-middle">{{ $item->name }}</th>
                                        <td class="align-middle">
                                            <div class="row">
                                                @foreach ($item->values as $value)
                                                    @if (preg_match('/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/', $value->value) ||
                                                            preg_match('/^rgb\(\s*(\d{1,3}%?\s*,\s*){2}\d{1,3}%?\s*\)$/', $value->value) ||
                                                            preg_match('/^hsl\(\s*\d{1,3}\s*,\s*\d{1,3}%\s*,\s*\d{1,3}%\s*\)$/', $value->value))
                                                        <div class="col-sm-4 mb-3">
                                                            <input type="color" class="form-control form-control-color"
                                                                value="{{ $value->value }}" disabled>
                                                        </div>
                                                    @else
                                                        <li>{{ $value->value }}</li>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="align-middle white-space-nowrap text-end pe-3">
                                            <a class="btn btn-warning"
                                                href="{{ route('admin.attributes.editAttr', $item->id) }}">Edit</a>

                                        </td>
                                        <td class="align-middle white-space-nowrap text-end pe-3">
                                            <a class="btn btn-danger"
                                                href="{{ route('admin.attributes.destroyAttr', $item->id) }}"
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
        <div class="col-lg-4 ps-lg-2">
            {{-- NAME ATTRIBUTE --}}
            <form class="card mb-3" action="{{ route('admin.attributes.storeAttr') }}" method="POST">
                @csrf
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0" id="titleAttr">Attribute</h6>
                </div>
                <div class="card-body">
                    <div class="row gx-2">
                        <div class="col-12 mb-4">
                            <label class="form-label" for="base-price">Name attribute:</label>
                            <input class="form-control" id="name" type="text" name="name"
                                value="{{ old('name') }}" />
                        </div>
                        <div class="col-12 mb-4">
                            <label for="values" class="form-label">Value Attribute:</label>
                            <div id="moreValue" class="row">
                                @php
                                    $ids = old('ids', []);
                                    $values = old('values', []);
                                    $typeName = old('typeName', 'text');
                                @endphp
                                @foreach ($values as $index => $value)
                                    @php
                                        $id = $ids[$index] ?? $index;
                                    @endphp
                                    <div class="d-flex" id="{{ $id }}_item" style="margin-top: 10px;">
                                        <input type="hidden" name="ids[]" value="{{ $id }}">
                                        <input type="hidden" name="typeName" value="{{ $typeName }}">
                                        <input type="{{ $typeName }}" class="form-control" name="values[]"
                                            value="{{ $value }}" id="{{ $id }}" />
                                        <button type="button" class="btn btn-danger"
                                            onclick="removeValue('{{ $id }}_item')">
                                            <span class="far fa-trash-alt"></span>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            @if ($errors->any())
                                <hr>
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-6 mb-3">
                            <a class="btn btn-info" id="btnChangeAttr" onclick="colorAttribute()">Color Attribute</a>
                        </div>
                        <div class="col-6 mb-3">
                            <a class="btn btn-primary" id="btnMore" onclick="addMore()">More value</a>
                        </div>
                        <hr>
                        <div class="col-6 mb-3">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/jquery/jquery.min.js') }}"></script>
@endsection
@section('js-setting')
    <script>
        var titleAttr = document.getElementById('titleAttr');
        var btnChangeAttr = document.getElementById('btnChangeAttr');
        var btnChange = document.getElementById('btnMore');

        function addMore() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
            <div class="col-sm-4 md-3 d-flex" id="${id}_item" style="margin-top: 10px;">
                <input type="hidden" name="ids[]" value="${id}">
                <input type="hidden" name="typeName" value="text">
                <input type="text" class="form-control" name="values[]" id="${id}">
                <button type="button" class="btn btn-danger" onclick="removeValue('${id}_item')">
                    <span class="far fa-trash-alt"></span>
                </button>
            </div>
            `;
            $('#moreValue').append(html);
        }

        function addMoreColor() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let color = `
            <div class="col-sm-4 md-3 d-flex" id="${id}_item" style="margin-top: 10px;">
                <input type="hidden" name="ids[]" value="${id}">
                <input type="hidden" name="typeName" value="color">
                <input type="color" class="form-control form-control-color" name="values[]" id="${id}">
                <button type="button" class="btn btn-danger" onclick="removeValue('${id}_item')">
                    <span class="far fa-trash-alt"></span>
                </button>
            </div>
            `;
            $('#moreValue').append(color);
        }

        function removeValue(id) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }

        function colorAttribute() {
            let inputs = document.querySelectorAll('input[name="values[]"]');
            let typeName = document.querySelectorAll('input[name="typeName"]');
            $('#name').val('Color');
            titleAttr.innerText = "Color Attribute";
            btnChangeAttr.innerText = "Other Attribute";
            btnChangeAttr.setAttribute('onclick', 'ortherAttribute()');
            btnChange.setAttribute('onclick', 'addMoreColor()');
            inputs.forEach(input => {
                input.value = null;
                input.type = 'color';
            });
            typeName.forEach(input => {
                input.value = 'color';
            });

        }

        function ortherAttribute() {
            let inputs = document.querySelectorAll('input[name="values[]"]');
            let typeName = document.querySelectorAll('input[name="typeName"]');
            $('#name').val(null);
            titleAttr.innerText = "Attribute";
            btnChangeAttr.innerText = "Color Attribute";
            btnChangeAttr.setAttribute('onclick', 'colorAttribute()');
            btnChange.setAttribute('onclick', 'addMore()');
            inputs.forEach(input => {
                input.type = 'text';
                input.value = null;
            });
            typeName.forEach(input => {
                input.value = 'text';
            });
        }
    </script>
@endsection
