@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
         <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <center>
                    <h4 class="card-title">Edit Profile Page</h4>
                    </center>
                    <form>
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="name" type="text" value="{{$editData->name}}" id="name">
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">UserName</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="username" type="text" value="{{$editData->username}}" id="name">
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">User Email</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="email" type="email" value="{{$editData->email}}" id="name">
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="profile_image" type="file" value="{{$editData->email}}" id="name">
                        </div>
                    </div>
                    <!-- end row -->
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    </div>

</div>

@endsection