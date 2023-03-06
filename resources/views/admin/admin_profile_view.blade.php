@extends('admin.admin_master')
@section('admin')
<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6">

                <!-- Simple card -->
                <div class="card">
                    <br>
                     <center>
                    <img class="rounded-circle avatar-xl" src="{{asset('assets/images/small/img-1.jpg')}}" alt="Card image cap">
                    </center>
                    <div class="card-body">
                        <h4 class="card-title">Name : {{ $adminData->name }}</h4>
                        <hr>
                        <h4 class="card-title">Email : {{ $adminData->email }}</h4>
                        <hr>
                        <a href="" class="btn btn-info btn-rounded waves-effect waves-light">Edit Profile</a>
                    </div>
                </div>

            </div><!-- end col -->
        </div>
        <!-- end row -->

    </div>

</div>

@endsection