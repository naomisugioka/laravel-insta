
<div class="modal fade" id="delete-category{{ $category->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="h5 text-danger modal-title"><i class="fa-solid fa-trash-can"></i> Delete Category</h3>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete {{ $category->id }} category?</p>
                <br>
                <p>This action will affect all the posts under this category.Post without a category will fall under Uncategorized</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.categories.destroy', $category->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-danger">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="update-category{{ $category->id}}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h3 class="h5 text-dark modal-title"><i class="fa-solid fa-pen-to-square"></i> Edit Category</h3>
            </div>
            <form action="{{ route('admin.categories.update', $category->id)}}" method="post">
                @csrf 
                @method('PATCH')
                <div class="modal-body text-start">
                    <input type="text" name="category_name" value="{{ $category->name }}" class="form-control">
                    @error('category_name')
                        <p class="mb-0 text-danger small">{{ $message }}</p>
                    @enderror
                </div>
                <div class="modal-footer border-0">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-warning">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
