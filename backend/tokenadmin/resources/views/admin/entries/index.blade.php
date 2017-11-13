@extends('admin.layouts.master')

@section('content') 
  <div class="content-wrapper">        
    <section class="content-header">
      <h1>Entries</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Total Entries</li>
      </ol>
    </section>        
    <section class="content">      
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List of Entries</h3>
        </div>
        <div class="box-body">  
          <table id="investors-list" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Email</th>
                <th>Email Activated</th>
                <th>KYC Completed</th>
                <th>Created At</th>
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
                         "url": "{{ route('admin::entriesList') }}", 
                         "dataSrc": ""
                    },
                    "columns": [
                        { "data": "email" },
                        { "data": "email_activated",
                            "render": function(data, type, row, meta) {
                                if(row.email_activated == 1)
                                    return 'Yes';
                                else
                                    return 'No';
                            }
                        },
                        { "data": "kyc_completed",
                            "render": function(data, type, row, meta) {
                                if(row.kyc_completed == 1)
                                    return 'Yes';
                                else
                                    return 'No';
                            }
                        },
                        { "data": "created_at" }
                    ]
                });
                
            });
        </script>
@endsection