@extends('admin.admin_master')
@section('admin')

@section('dashboard')
 Dashboard | All Service Data
@endsection

<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <h4 class="card-title">All Service Information</h4><br><br>
                         </center>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Service Title</th>
                                <th>Short Title</th>
                                <th>Service Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                                
                                @foreach($services as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->short_title}}</td>
                                <td><img src="{{asset($item->service_image)}}" style="width: 60px; height: 60px;" ></td>
                                <td>
                                    <a href="" class="btn btn-info sm" title="Edit Data"> <i class="fas fa-edit"></i> </a>
                                    <a href="" class="btn btn-danger sm" title="Delete Data" id="delete"> <i class="fas fa-trash-alt"></i> </a>
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