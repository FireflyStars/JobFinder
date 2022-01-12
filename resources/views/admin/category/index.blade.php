@extends('layouts.admin.index')

@section('title', 'List of Category')

@section('content_header', 'List of Category')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header">
                    @include('admin.category.partial.addButton')
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                        <table id="list-table" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if(!empty($categories))
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>@if($category->active == true) active @else inactive @endif</td>
                                        <td>
                                            <a href="{{url('admin/category/'. $category->id . '/edit')}}"
                                               class="btn btn-xs btn-primary mb-2">
                                                <i class="ace-icon fa fa-pencil bigger-130"></i> Edit
                                            </a>

                                            <form action="{{url('admin/category', ['id'=>$category->id])}}" method="POST"
                                                  onsubmit="return confirm('Are you sure?')"
                                                  style="display: inline-block;">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-xs">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('/admin_assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('/admin_assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>

    <script type="text/javascript">
        jQuery(function ($) {

            let table = $('#list-table').DataTable({
                "responsive": true,
                "pageLength": 50
            });

            // Sort by datatable desc
            table.order([0, 'desc'])
                .draw();

        })
    </script>
@endsection
