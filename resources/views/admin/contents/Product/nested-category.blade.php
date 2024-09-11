@if ($category->is_active == 1)
    <option value="{{ $category->id }}">{{ $each }}{{ $category->name }}</option>
@endif

{{-- danh mục con thuộc danh mục cha --}}
@if ($category->children)

    @php($each .= '-')

    @foreach ($category->children as $child)
        @include('admin.contents.category.nested-category', ['category' => $child])
    @endforeach

@endif
