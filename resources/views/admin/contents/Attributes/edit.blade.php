@extends('layouts.master')

@section('title')
    Attributes Edit
@endsection

@section('contents')
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <a href="{{ route('admin.attributes.list') }}" class="btn btn-dark">Back</a>
                </div>
                @if (session('error'))
                    <div class="col-auto align-self-center">
                        <h5 class="mb-0 text-danger">{{ session('error') }}</h5>
                    </div>
                @else
                    @if (session('success'))
                        <div class="col-auto align-self-center">
                            <h5 class="mb-0 text-success">{{ session('success') }}</h5>
                        </div>
                    @else
                        <div class="col-auto align-self-center">
                            <h5 class="mb-0">Aategories Edit</h5>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="card-body p-0 pb-3">
            <form class="table-responsive scrollbar"
                action="{{ route('admin.attributes.update', $attrName == 'Size Attribute' ? 'size' : 'color') }}"
                method="POST">
                @csrf
                <table class="table mb-0">
                    <thead class="bg-200">
                        <tr>
                            <th class="text-black dark__text-white align-middle" style="width: 300px;">Name</th>
                            <th class="text-black dark__text-white align-middle">Attribute Value</th>
                            <th class="text-black dark__text-white align-middle" style="width: 250px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">
                                {{ $attrName }}
                            </td>
                            <td>
                                <div class="row" id="moreValue">
                                    @if (count($dataAttr))
                                        @if ($attrName == 'Color Attribute')
                                            @foreach ($dataAttr as $value)
                                                <div class="col-sm-4 mb-3 d-flex" id="valueID-{{ $value->id }}">
                                                    <input type="color" class="form-control form-control-color inputColor"
                                                        name="update[{{ $value->id }}]" value="{{ $value->colorValue }}">
                                                </div>
                                            @endforeach
                                        @endif
                                        @if ($attrName == 'Size Attribute')
                                            @foreach ($dataAttr as $value)
                                                <div class="col-sm-4 mb-3 d-flex" id="valueID-{{ $value->id }}">
                                                    <input type="text" class="form-control inputText"
                                                        name="update[{{ $value->id }}]"
                                                        value="{{ $value->sizeValue }}">
                                                </div>
                                            @endforeach
                                        @endif
                                    @else
                                        <div class="col-12 text-warning">Chưa thêm giá trị cho thuộc tính này!</div>
                                    @endif
                                </div>
                            </td>
                            <td class="align-middle">
                                <a class="btn btn-primary" id="btnMore" onclick="{!! $attrName == 'Size Attribute' ? 'addMore()' : 'addMoreColor()' !!}">More value</a>
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
    </script>
@endsection
