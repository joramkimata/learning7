<form role="form" id="updateCategoryForm" novalidate="">
    {{csrf_field()}}
    <input type="hidden" name="categoryId" id="categoryId" value="{{$category->id}}"/>
    <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">Name<span
                class="text-danger">*</span></label>
        <div class="col-sm-7">
            <input type="text" required="" class="form-control validate[required]"
                   value="{{$category->name}}"
                   data-errormessage-value-missing="Name is required!" name="name" id="name"
                   placeholder="Enter Name">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-8 offset-sm-4">
            <button type="button" id="updateCategory"
                    class="btn btn-primary waves-effect waves-light mr-1">
                Save
            </button>
            <button type="reset" class="btn btn-secondary waves-effect waves-light">
                Cancel
            </button>
        </div>
    </div>
</form>
