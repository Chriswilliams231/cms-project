
@extends('admin.admin_master')
@section('admin')

@section('dashboard')
 Dashboard | Add Category 
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
         <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <center>
                    <h4 class="card-title">Add Blog Category Page</h4> <br> <br>
                    </center>
                    <form method="post" action="{{route('store.blog.category')}}" >

                        @csrf
                        
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="blog_category" type="text"  id="name">
                            @error('blog_category')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- end row -->
                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Insert Blog Category">
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    </div>

</div>


@endsection
