@extends('layouts.master')

@section('title')
    Attributes Edit
@endsection

@section('contents')
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <a href="{{ route('admin.attributes.listAttr') }}" class="btn btn-dark">Back</a>
                </div>
                @if (session('error'))
                    <div class="col-auto align-self-center">
                        <h5 class="mb-0 text-danger">{{ session('error') }}</h5>
                    </div>
                @else
                    <div class="col-auto align-self-center">
                        <h5 class="mb-0">Aategories Edit</h5>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body p-0 pb-3">
            <form class="table-responsive scrollbar" action="{{ route('admin.attributes.addOrCreate', $model->id) }}"
                method="POST">
                @csrf
                <table class="table mb-0">
                    <thead class="bg-200">
                        <tr>
                            <th class="text-black dark__text-white align-middle" style="width: 300px;">Name</th>
                            <th class="text-black dark__text-white align-middle">Attribute Value</th>
                            <th class="text-black dark__text-white align-middle" style="width: 250px;">
                                <a class="btn btn-primary" id="btnMore" onclick="addMore()">More value</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">
                                <input type="text" class="form-control" name="name" value="{{ $model->name }}">
                            </td>
                            <td>
                                <div class="row" id="moreValue">
                                    @foreach ($model->values as $value)
                                        @if (preg_match('/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/', $value->value) ||
                                                preg_match('/^rgb\(\s*(\d{1,3}%?\s*,\s*){2}\d{1,3}%?\s*\)$/', $value->value) ||
                                                preg_match('/^hsl\(\s*\d{1,3}\s*,\s*\d{1,3}%\s*,\s*\d{1,3}%\s*\)$/', $value->value))
                                            <div class="col-sm-4 mb-3 d-flex" id="valueID-{{ $value->id }}">
                                                <input type="color" class="form-control inputColor"
                                                    name="update[{{ $value->id }}]" value="{{ $value->value }}">
                                            </div>
                                        @else
                                            <div class="col-sm-4 mb-3 d-flex" id="valueID-{{ $value->id }}">
                                                <input type="text" class="form-control inputText"
                                                    name="update[{{ $value->id }}]" value="{{ $value->value }}">
                                            </div>
                                        @endif
                                    @endforeach
                                    @php
                                        $ids = old('ids', []);
                                        $values = old('values', []);
                                        $typeName = old('typeName', 'text');
                                    @endphp
                                    @foreach ($values as $index => $value)
                                        @php
                                            $id = $ids[$index] ?? $index;
                                        @endphp
                                        <div class="col-sm-4 mb-3 d-flex" id="{{ $id }}_item"
                                            style="margin-top: 10px;">
                                            <input type="hidden" name="ids[]" value="{{ $id }}">
                                            <input type="hidden" name="typeName" value="{{ $typeName }}">
                                            <input type="{{ $typeName }}" class="form-control{!! $typeName == 'color' ? ' form-control-color' : '' !!}"
                                                name="values[]" value="{{ $value }}" id="{{ $id }}" />
                                            <button type="button" class="btn btn-danger"
                                                onclick="removeValue('{{ $id }}_item')">
                                                <span class="far fa-trash-alt"></span>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="align-middle">
                                <a class="btn btn-info" id="btnChangeAttr" onclick="colorAttribute()">Change new input</a>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <button type="submit" class="btn btn-success">Update Attribute</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
        @if ($errors->any())
            <div class="card-footer">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/jquery/jquery.min.js') }}"></script>
@endsection
@section('js-setting')
    <script>
        var btnChangeAttr = document.getElementById('btnChangeAttr');
        var btnChange = document.getElementById('btnMore');

        function addMore() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
            <div class="col-sm-4 mb-3 d-flex" id="${id}_item">
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
            <div class="col-sm-4 mb-3 d-flex" id="${id}_item">
                <input type="color" class="form-control form-control-color" name="values[]" id="${id}">
                <button type="button" class="btn btn-danger" onclick="removeValue('${id}_item')">
                    <span class="far fa-trash-alt"></span>
                </button>
            </div>
            `;
            $('#moreValue').append(color);
        }

        function removeValue(id) {
            $('#' + id).remove();
        }

        function colorAttribute() {
            let inputs = document.querySelectorAll('input[name="values[]"]');
            btnChangeAttr.setAttribute('onclick', 'ortherAttribute()');
            btnChange.setAttribute('onclick', 'addMoreColor()');
            inputs.forEach(input => {
                input.value = null;
                input.type = 'color';
                input.classList.add("form-control-color");
            });

        }

        function ortherAttribute() {
            let inputs = document.querySelectorAll('input[name="values[]"]');
            btnChangeAttr.setAttribute('onclick', 'colorAttribute()');
            btnChange.setAttribute('onclick', 'addMore()');
            inputs.forEach(input => {
                input.type = 'text';
                input.value = null;
                input.classList.remove("form-control-color");
            });
        }
    </script>
@endsection
