@extends('admin.layouts.master')

@section('content') 
  <div class="content-wrapper">        
    <section class="content-header">
      <h1>Investors</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Investors</li>
      </ol>
    </section>        
    <section class="content">      
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List of Investors</h3>
        </div>
        <div class="box-body">  
          <table id="investors-list" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Actions</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
  </div>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/dataTables.bootstrap.min.js"></script>
    <script src="/assets/js/dataTables.alphabetSearch.js"></script>
      <script> 
            $(document).ready(function() { 
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });
                
                $('#investors-list').DataTable({
                    "ordering": false,
                  "ajax": {
                        "processing": true,
                         "serverSide": true,
                         "url": "{{ route('admin::investorsList') }}", 
                         "dataSrc": ""
                    },
                    "columns": [
                        { "data": "name",
                            "render": function(data, type, row, meta) {     
                                return row.first_name+" "+row.last_name;
                            } 
                        },
                        { "data": "email" },
                        { "data": "status" },
                        { "data": "created_at" },
                        { "data": "investor_id",
                            "render": function(data, type, row, meta) {     
                                var out='<a href="/admin/investors/' + row.investor_id + '/edit" class="btn btn-default btn-sm">Edit</a>&nbsp';
                                out+='<a href="/admin/investors/' + row.investor_id + '/view" class="btn btn-default btn-sm">View</a>&nbsp'; 
                                return out;
                            }
                        }
                    ]
                });
                
    });
                
        </script>
@endsection