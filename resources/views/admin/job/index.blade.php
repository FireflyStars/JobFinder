@extends('layouts.admin.index')

@section('title', 'List of Jobs')

@section('content_header', 'List of Jobs')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header">
                    @include('admin.job.partial.addButton')
                </div>

                <div class="widget-body">
                    <div class="widget-main">

                        <table id="list-table" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Job Type</th>
                                <th>Location</th>
                                <th>Apply</th>
                                <th>Premium</th>
                                <th>Category</th>
                                <th>Company</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
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
            // DataTable
            $('#list-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('admin.load-jobs')}}",
                columns: [
                    { data: 'id' },
                    { data: 'title' },
                    { data: 'jobType' },
                    { data: 'location' },
                    { data: 'apply' },
                    { data: 'premium' },
                    { data: 'category' },
                    { data: 'company' },
                    { data: 'action' }
                ]
            });
        })
        $(document).on("ready", function() {
            $("#list-table").on("click", ".deleteJobButton", function() {
                if (window.confirm("Are you sure?")) {
                    var id = $(this).data("jobid");
                    var token = $("meta[name='csrf-token']").attr("content");
                    var url = "{{ URL('admin/job') }}";
                    $.ajax(
                    {
                        url: url+"/"+id,
                        type: "DELETE",
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function (data) {
                            var dataResult = JSON.parse(data);
                            alert(dataResult.message)
                            if(dataResult.status == 1) {
                                window.location.reload();
                            }
                        }
                    });
                }
            });

            $("#list-table").on("click", ".makeJobPremium", function() {
                if (window.confirm("Are you sure?")) {
                    var id = $(this).data("jobid");
                    var token = $("meta[name='csrf-token']").attr("content");
                    var url = "{{ URL('admin/make-premium') }}";
                    $.ajax(
                    {
                        url: url,
                        type: "POST",
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function (data) {
                            var dataResult = JSON.parse(data);
                            alert(dataResult.message)
                            if(dataResult.status == 1) {
                                window.location.reload();
                            }
                        }
                    });
                }
            });

            $("#list-table").on("click", ".removeJobPremium", function() {
                if (window.confirm("Are you sure?")) {
                    var id = $(this).data("jobid");
                    var token = $("meta[name='csrf-token']").attr("content");
                    var url = "{{ URL('admin/remove-premium') }}";
                    $.ajax(
                    {
                        url: url,
                        type: "POST",
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function (data) {
                            var dataResult = JSON.parse(data);
                            alert(dataResult.message)
                            if(dataResult.status == 1) {
                                window.location.reload();
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
