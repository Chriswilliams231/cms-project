@extends('admin.admin_master')
@section('admin')

@section('dashboard')
 Dashboard | Home Slide 
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
         <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <center>
                    <h4 class="card-title">Home Slide Edit Page</h4>
                    </center>
                    <form method="post" action="{{route('update.slider')}}" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="id" value="{{$homeslide->id}}">
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="title" type="text" value="{{$homeslide->title}}" id="name">
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="short_title" type="text" value="{{$homeslide->short_title}}" id="short_title">
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Video Url</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="video_url" type="text" value="{{$homeslide->video_url}}" id="video_url">
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Slider Image</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="home_slide" type="file"  id="image">
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                        <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($homeslide->home_images))? url($homeslide->home_images):url('upload/no_image.jpg') }}" alt="Card image cap">
                        </div>
                    </div>
                    <!-- end row -->
                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Slide">
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