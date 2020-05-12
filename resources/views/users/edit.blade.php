<form role="form" id="updateUserForm" novalidate="">
    {{csrf_field()}}

    <input type="hidden" name="userId" id="userId" value="{{$user->id}}"/>

    <div class="form-group row">
        <label for="name" class="col-sm-4 col-form-label">Name<span
                class="text-danger">*</span></label>
        <div class="col-sm-7">
            <input type="text" required="" class="form-control validate[required]"
                   data-errormessage-value-missing="Name is required!" name="name" id="name" value="{{$user->name}}"
                   placeholder="Enter Name">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Username<span
                class="text-danger">*</span></label>
        <div class="col-sm-7">
            <input type="text" required="" class="form-control validate[required]"
                   data-errormessage-value-missing="Username is required!" name="username"
                   id="username"
                   value="{{$user->email}}"
                   placeholder="Enter Username">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Role<span
                class="text-danger">*</span></label>
        <div class="col-sm-7">
            <select class="form-control validate[required]"
                    data-errormessage-value-missing="Role is required!" name="role" id="role">
                @if($user->role == "admin")
                    <option value="admin">ADMINISTRATOR</option>
                    <option value="user">END-USER</option>
                @else
                    <option value="user">END-USER</option>
                    <option value="admin">ADMINISTRATOR</option>
                @endif
            </select>
        </div>
    </div>
    <hr/>

    <hr/>
    <div class="form-group row">
        <div class="col-sm-8 offset-sm-4">
            <button type="button" id="updateUser"
                    class="btn btn-primary waves-effect waves-light mr-1">
                Save
            </button>
            <button type="reset" class="btn btn-secondary waves-effect waves-light">
                Cancel
            </button>
        </div>
    </div>
</form>

