@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
<form action="{{ route('admin.categories.store')}}" method="post" class="row gx-2 mb-3">
@csrf
<div class="col-3">
    <input type="text" name="category_name" placeholder="Add a categpry..." class="form-control">
    @error('category_name')
    <p class="mb-0 text-danger small">{{ $message }}</p>
    @enderror
</div>
<div class="col-auto">
    <button type="submit" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Add
    </button>
</div>


</form>

<table class="table table-sm table-hover border bg-white align-middle text-center text-secondary">
    <thead class="table-warning text-secondary small text-secondary text-uppercase">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Count</th>
            <th>Last Updated</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse($all_categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td class="text-dark">{{ $category->name }}</td>
                <td>{{ $category->categoryPosts->count() }}</td>
                <td>{{ $category->updated_at }}</td>
                <td>
                    {{-- edit --}}
                    <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                    data-bs-target="#update-category{{ $category->id}}">
                        <i class="fa-solid fa-pen"></i>
                    </button>
             
                    {{-- delete --}}
                    <button class="btn btn-sm btn-outline-danger ms-1" data-bs-toggle="modal" 
                    data-bs-target="#delete-category{{ $category->id}}">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                    @include('admin.categories.modals')
                </td>
            </tr>
        @empty 
            <tr><td class="text-center" colspan="5">No categories found.</td></tr>
        @endforelse
        <tr>
            <td>0</td>
            <td>Uncategorized</td>
            <td>{{$uncategorized_count}}</td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
@endsection