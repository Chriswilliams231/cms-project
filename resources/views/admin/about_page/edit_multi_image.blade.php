@extends('admin.admin_master')
@section('admin')

@section('dashboard')
 Dashboard | Update Image 
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
         <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <center>
                    <h4 class="card-title">Update Multi Image</h4><br><br>
                    </center>
                    <form method="post" action="{{route('update.multi.image')}}" enctype="multipart/form-data">
                        @csrf
                        
                        <input type="hidden" name="id" value="{{$multiImage->id}}">
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Multi Image</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="multi_image" type="file"  id="image" >
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                        <img id="showImage" class="rounded avatar-lg" src="{{ asset($multiImage->multi_image) }}" alt="Card image cap">
                        </div>
                    </div>
                    <!-- end row -->
                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Multi Image">
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