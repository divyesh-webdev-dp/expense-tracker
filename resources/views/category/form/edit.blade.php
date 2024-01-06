<form id="editCategory">
    <div class="mb-3">
        <label for="name" class="form-label">Name <span class="text-sm text-danger">*</span></label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
        <span class="text-sm text-danger"></span>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select cursor-pointer">
            <option {{ $category->getRawOriginal('status') ? 'selected' : '' }} value="1">Active</option>
            <option {{ $category->getRawOriginal('status') ? '' : 'selected' }} value="0">Inactive</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description">
            {{ $category->description }}
        </textarea>
    </div>
    <button type="button" class="btn btn-primary" onclick="updateHandler('{{ $category->id }}')">Submit</button>
</form>
