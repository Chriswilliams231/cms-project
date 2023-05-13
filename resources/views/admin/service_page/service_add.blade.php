@extends('admin.admin_master')
@section('admin')

@section('dashboard')
 Dashboard | Add Services
@endsection



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
         <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <center>
                    <h4 class="card-title">Service Page</h4>
                    </center>
                    <form method="post" action="{{route('store.service')}}" enctype="multipart/form-data">

                        @csrf
                        
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Service Title</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="title" type="text"  id="name">
                            @error('title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="short_title" type="text"  id="short_title">
                            @error('short_title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Service Points</label>
                        <div class="col-sm-10">
                            <textarea  required="" name="serice_points" class="form-control" rows="5"> </textarea>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                        <div class="col-sm-10">
                            <textarea  required="" name="short_description" class="form-control" rows="5"> </textarea>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                        <div class="col-sm-10">
                        <textarea id="elm1" name="long_description"> </textarea>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Service Image</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="service_image" type="file"  id="image">
                            @error('service_image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                        <img id="showImage" class="rounded avatar-lg" src="{{ url('upload/no_image.jpg') }}" alt="Card image cap">
                        </div>
                    </div>
                    <!-- end row -->
                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Insert Service Data">
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    </div>

</div>

<script type="text/javascript">
    // This helps to display a image you select for your profile
    $(document).ready(function(){
        $('#image').change(function(event){
            var reader = new FileReader();
            reader.onload = function(event){
                $('#showImage').attr('src', event.target.result);
            }
            reader.readAsDataURL(event.target.files['0']);
        })
    })


</script>
@endsection