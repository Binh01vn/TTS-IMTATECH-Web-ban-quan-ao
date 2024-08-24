@extends('layouts.master')

@section('title')
    Update Category
@endsection

@section('contents')
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <a href="{{ route('admin.categories.listDM') }}" class="btn btn-dark">Back</a>
                </div>
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">Edit categories</h5>
                </div>
            </div>
        </div>
        <div class="card-body px-0">
            <form class="table-responsive scrollbar" action="{{ route('admin.categories.updateDM', $data->slug) }}"
                method="POST">
                @csrf
                @method('PUT')
                <table class="table">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Parent item</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="col-auto">
                                <input class="form-control" id="autoSizingInput" type="text" name="name"
                                    value="{{ $data->name }}" />
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
                        </td>
                        <td>
                            <div class="col-auto">
                                <select class="form-select" id="autoSizingSelect" name="parent_id">
                                    <option value="" {!! isset($data->parent_id) && $data->parent_id == null ? 'selected' : '' !!}>Trống</option>
                                    @foreach ($categoryParent as $parent)
                                        @php($each = '')
                                        @include('admin.contents.category.nested-category', [
                                            'category' => $parent,
                                        ])
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="col-auto">
                                <textarea class="form-control" id="basic-form-textarea" rows="2" cols="30" name="description">{{ $data->description }}</textarea>
                            </div>
                        </td>
                        <td>
                            <div class="col-auto">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" id="autoSizingCheck" type="checkbox" value="1"
                                        name="is_active" {!! $data->is_active == 1 ? 'checked' : '' !!} />
                                    <label class="form-check-label mb-0" for="autoSizingCheck">Is active</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" colspan="2">
                            <div class="col-auto">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </th>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection
