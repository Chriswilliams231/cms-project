@extends('admin.admin_master')
@section('admin')

@section('dashboard')
 Dashboard | All Blog Data 
@endsection

<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <h4 class="card-title">All Blog Data</h4><br><br>
                         </center>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Blog Category</th>
                                <th>Blog Title</th>
                                <th>Blog Tags</th>
                                <th>Blog Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                                
                                @foreach($blogs as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item['category']['blog_category']}}</td>
                                <td>{{$item->blog_title}}</td>
                                <td>{{$item->blog_tags}}</td>
                                <td><img src="{{asset($item->blog_image)}}" style="width: 60px; height: 60px;" ></td>
                                <td>
                                    <a href="{{route('edit.blog', $item->id)}}" class="btn btn-info sm" title="Edit Data"> <i class="fas fa-edit"></i> </a>
                                    <a href="{{route('delete.blog', $item->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete"> <i class="fas fa-trash-alt"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->  
    </div> <!-- container-fluid -->
</div>
@endsection