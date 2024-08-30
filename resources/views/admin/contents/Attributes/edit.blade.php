@extends('layouts.master')

@section('title')
    Attributes Edit
@endsection

@section('contents')
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
                            <h5 class="mb-2 mb-md-0">Attributes Edit</h5>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body p-0 pb-3">
            <div class="table-responsive scrollbar">
                <table class="table mb-0">
                    <thead class="bg-200">
                        <tr>
                            <th class="text-black dark__text-white align-middle">Name</th>
                            <th class="text-black dark__text-white align-middle">Attribute Value</th>
                            <th class="text-black dark__text-white align-middle">
                                <a class="btn btn-primary" id="btnMore" onclick="addMore()">More value</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">
                                <input type="text" class="form-control" name="name" value="{{ $model->name }}">
                            </td>
                            <td class="align-middle">
                                <div class="row" id="moreValue">
                                    @foreach ($model->values as $value)
                                        @if (preg_match('/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/', $value->value) ||
                                                preg_match('/^rgb\(\s*(\d{1,3}%?\s*,\s*){2}\d{1,3}%?\s*\)$/', $value->value) ||
                                                preg_match('/^hsl\(\s*\d{1,3}\s*,\s*\d{1,3}%\s*,\s*\d{1,3}%\s*\)$/', $value->value))
                                            <div class="col-sm-4 mb-3 d-flex">
                                                <input type="color" class="form-control inputColor"
                                                    name="update[{{ $value->value }}]" value="{{ $value->value }}">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removeValue({{ $value->id }})">
                                                    <span class="far fa-trash-alt"></span>
                                                </button>
                                            </div>
                                        @else
                                            <div class="col-sm-4 mb-3 d-flex">
                                                <input type="text" class="form-control inputText"
                                                    name="update[{{ $value->value }}]" value="{{ $value->value }}">
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removeValue({{ $value->id }})">
                                                    <span class="far fa-trash-alt"></span>
                                                </button>
                                            </div>
                                        @endif
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
                            <td colspan="2">
                                <a class="btn btn-success">Update Attribute</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
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
            <div class="col-sm-4 mb-3 d-flex" id="${id}_item" style="margin-top: 10px;">
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
            <div class="col-sm-4 mb-3 d-flex" id="${id}_item" style="margin-top: 10px;">
                <input type="color" class="form-control" name="values[]" id="${id}">
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
            btnChangeAttr.setAttribute('onclick', 'ortherAttribute()');
            btnChange.setAttribute('onclick', 'addMoreColor()');
            inputs.forEach(input => {
                input.value = null;
                input.type = 'color';
            });

        }

        function ortherAttribute() {
            let inputs = document.querySelectorAll('input[name="values[]"]');
            btnChangeAttr.setAttribute('onclick', 'colorAttribute()');
            btnChange.setAttribute('onclick', 'addMore()');
            inputs.forEach(input => {
                input.type = 'text';
                input.value = null;
            });
        }
    </script>
@endsection
