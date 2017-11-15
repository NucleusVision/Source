@extends('admin.layouts.master')

@section('content') 
  <div class="content-wrapper">        
    <section class="content-header">
      <h1>PR Investors</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">PR Investors</li>
      </ol>
    </section>        
    <section class="content">      
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List of PR Investors</h3>
        </div>
        <div class="box-body">
        
          <table id="investors-list" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="100px;">ID</th>
                <th width="100px;">Selfie with ID</th>
                <th>Name</th>
                <th>Country</th>
                <th>Status</th>
                <th>PR Flag</th>
                <th style="width:70px;">Bonus %</th>
                <th>Lock-in period</th>
                <th>Actions</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
      <!-- Trigger the Modal -->
      
<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Image preview</h4>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
      
      
  </div>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/dataTables.bootstrap.min.js"></script>
    <script src="/assets/js/dataTables.alphabetSearch.js"></script>
      <script> 
            
           $(document).on('click', '.content .imageId', function (e) {               
                $('#imagepreview').attr('src', $(this).attr('src')); // here asign the image to the modal when the user click the enlarge link
                $('#imagemodal').modal('show');
            });
       
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
                         "url": "{{ route('admin::prInvestorsList') }}", 
                         "dataSrc": ""
                    },
                    "columns": [
                        { "data": "doc1",
                            "render": function(data, type, row, meta) {  
                               return '<img src="http://tokensale.enterstargate.com/uploads/' + row.doc1 + '" alt="' + row.email + '" class="imageId" style="cursor:pointer;"/>';  
                           }
                       },
					   { "data": "doc2",
                            "render": function(data, type, row, meta) {  
                               return '<img src="http://tokensale.enterstargate.com/uploads/' + row.doc2 + '" alt="' + row.email + '" class="imageId" style="cursor:pointer;"/>';  
                           }
                       },
                        { "data": "name",
                            "render": function(data, type, row, meta) {     
                                return row.first_name+" "+row.last_name;
                            } 
                        },
                        { "data": "nationality" },
                        { "data": "status" },
                        { "data": "prflag",
                            "render": function(data, type, row, meta) {
                                if(row.prflag == 1)
                                    return 'Yes';
                                else if(row.prflag == 0)
                                    return 'No';
                                else
                                    return '';
                            }
                        },
                        { "data": "bonus_per" },
                        { "data": "lock_in_period" },
                        { "data": "investor_id",
                            "render": function(data, type, row, meta) {     
                                var out='<a id="' + row.investor_id + '" data-status="Approve"  class="btn btn-success btn-sm investor-status" style="margin-bottom:10px;width:70px;">Approve</a>&nbsp';
                                out+='<a id="' + row.investor_id + '" data-status="Reject"  class="btn btn-danger btn-sm investor-status" style="margin-bottom:10px;width:70px;">Reject</a>&nbsp';
                                out+='<a href="/admin/pr-investors/' + row.investor_id + '/edit" class="btn btn-primary btn-sm" style="margin-bottom:10px;width:70px;">Edit</a>&nbsp';
                                return out;
                            }
                        }
                    ]
                });
                
                
                $(document).on('click', '.content .investor-status', function (e) {
                    
                    e.preventDefault();
                    
                    id = $(this).attr('id');
                    investor_status = $(this).attr('data-status');
                    
                    investor_status_message = "";
                    
                    if(investor_status == 'Approve'){
                        investor_status_message = 'Approved';
                    }else{
                        investor_status_message = 'Rejected';
                    }

                    swal({
                    title: "Are you sure?", 
                        text: "Are you sure that you want to "+investor_status+" this investor?", 
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, "+investor_status+" it!",
                        confirmButtonColor: "#ec6c62",
                    showLoaderOnConfirm: true,
                    preConfirm: function() {
                      return new Promise(function(resolve) {
                           $.ajax(
                                {
                                    type: "post",
                                    url: "/admin/investors-new/status/change",
                                    data: {investor_id: id, status:investor_status},
                                    success: function(data){
                                        swal("Canceled!", "Investor was successfully "+investor_status_message+"!", "success");
                                        $('#investors-list').dataTable()._fnAjaxUpdate();
                                    }
                                }
                        )
                      .done(function(data) {
                        swal(investor_status_message, "Investor was successfully "+investor_status_message+"!", "success");
                        $('#investors-list').dataTable()._fnAjaxUpdate();
                      })
                      .error(function(data) {
                        swal("Oops", "We couldn't connect to the server!", "error");
                      });
                      });
                    }
                  }).then(function(result) {
                        //swal('Ajax request finished!');
                  }, function(dismiss) {
                        // dismiss can be "cancel" | "close" | "outside"
                    });                                       
        });         
});
                
</script>
@endsection