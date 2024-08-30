@if ($category->is_active == 1)
    <option value="{{ $category->id }}"
        @php
        if (isset($model) && $category->parent_id == null && $category->id == $model->id) {
            echo 'selected';
        }
        if (isset($model) && $model->parent_id == $category->id) {
            echo 'selected';
        }
        @endphp>
        {{ $each }}{{ $category->name }}
    </option>
@endif

{{-- danh mục con thuộc danh mục cha --}}
@if ($category->children)

    @php($each .= '-')

    @foreach ($category->children as $child)
        @include('admin.contents.category.nested-category', ['category' => $child])
    @endforeach

@endif
