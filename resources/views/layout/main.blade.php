@include('incs.header')
<body>
<header id="topnav">
    @include('partials._topbar')
    @include('partials._navbar')
</header>
<div class="wrapper">
    <div class="container-fluid">

        <div class="modal fade change-password-modal" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myCenterModalLabel"><i class="fa fa-key"></i> Change Password</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="changePassForm" novalidate="">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="password" class="col-sm-4 col-form-label">Password<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <input type="password" required="" class="form-control validate[required]" data-errormessage-value-missing="Password is required!" name="password" id="password" placeholder="Enter New Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cpassword" class="col-sm-4 col-form-label">Confirm Password<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <input type="password" required="" class="form-control validate[required,equals[password]]" data-errormessage-value-missing="Confirm Password is required!" name="cpassword" id="cpassword" placeholder="Enter Confirm Password">
                                </div>
                            </div>
                            <hr />
                            <div class="form-group row">
                                <div class="col-sm-8 offset-sm-4">
                                    <button type="button" id="changePassword" class="btn btn-primary waves-effect waves-light mr-1">
                                        Change Password
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect waves-light">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div class="modal fade add-todo-modal" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myCenterModalLabel"><i class="fa fa-plus"></i> Create New Todo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="addTodoForm" novalidate="">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="title" class="col-sm-4 col-form-label">Title<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <input type="text" required="" class="form-control validate[required]" data-errormessage-value-missing="Title is required!" name="title" id="title" placeholder="Enter Title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-4 col-form-label">Description</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="description" id="description" placeholder="Enter Description"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">Category<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <select class="form-control validate[required]" data-errormessage-value-missing="Category is required!" name="category" id="category">
                                        <option value="">--SELECT CATEROGY--</option>
                                        @foreach(\App\Models\Category::where('status', 1)->get() as $c)
                                            <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-sm-4 col-form-label">Start Date<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <input type="text" class="form-control validate[required]" data-errormessage-value-missing="Start Date is required!" id="startDate" name="startDate" data-provide="datepicker" data-date-autoclose="true">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-sm-4 col-form-label ">End Date<span class="text-danger">*</span></label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <input type="text" class="form-control validate[required]" id="endDate" data-errormessage-value-missing="End Date is required!" name="endDate" data-provide="datepicker" data-date-autoclose="true">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr />
                            <div class="form-group row">
                                <div class="col-sm-8 offset-sm-4">
                                    <button type="button" id="saveTodo" class="btn btn-primary waves-effect waves-light mr-1">
                                        Save
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect waves-light">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <div class="modal fade edit-todo-modal" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myCenterModalLabel"><i class="fa fa-edit"></i> Edit Todo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div id="loader-todo-edit" style="display: none">
                                <center>
                                    <img src="{{url('assets/images/loader.gif')}}" />
                                </center>
                            </div>

                            <div id="editor-todo-edit"></div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <div class="modal fade view-todo-modal" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myCenterModalLabel"><i class="fa fa-search"></i> View Todo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div id="loader-todo-view" style="display: none">
                                <center>
                                    <img src="{{url('assets/images/loader.gif')}}" />
                                </center>
                            </div>

                            <div id="editor-todo-view"></div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>


        @yield('content')


    </div> <!-- end container -->
</div>
<!-- end wrapper -->
@include('incs.footer')
