<option value="{{ $category->id }}" {!! isset($data->parent_id) && $data->parent_id == $category->id ? 'selected' : '' !!}>{{ $each }}{{ $category->name }}</option>

@if ($category->children)

    @php($each .= '-')

    @foreach ($category->children as $child)
        @include('admin.contents.category.nested-category', ['category' => $child])
    @endforeach

@endif
