@extends('admin.layouts.master')

@section('content') 
  <div class="content-wrapper">        
    <section class="content-header">
      <h1>Whitelisted/Public Investors</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Whitelisted/Public Investors</li>
      </ol>
    </section>        
    <section class="content">      
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List of Whitelisted/Public Investors</h3>
        </div>
          <div class="row" style="margin-left: 3px;">  
        <form name="form1" id="form1" method="get">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="call_status">Type</label>
                    <select class="form-control" id="type" name="type" style="width:200px;">
                        <option value="" selected="selected">Select Type</option>
                        <option value="whitelisted">White Listed</option>
                        <option value="public">Public</option>
                    </select>
                </div>
            </div>
        </form>   
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
                
				
				var investors_table = $('#investors-list').DataTable({
					processing: true,
					serverSide: true,
					ajax: {
						url: "{{ route('admin::investorsWpList') }}",
						data: function (d) {
							d.type = $('#type').val();
						}
					},
					"columns": [
							{data: 'doc1', name: 'doc1'},
							{data: 'doc2', name: 'doc2'},
							{data: 'name', name: 'name'},
							{data: 'nationality', name: 'nationality'},
							{data: 'status', name: 'status'},
							{data: 'prflag', name: 'prflag'},
							{data: 'action', name: 'action', orderable: false, searchable: false}
						]
				});
				

                $('#type').on('change', function() {
                    investors_table.draw();
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
                                    url: "/admin/investors-all/status/change",
                                    data: {investor_id: id, status:investor_status},
                                    success: function(data){
                                        swal("Canceled!", "Investor was successfully "+investor_status_message+"!", "success");
                                        investors_table.draw();
                                    }
                                }
                        )
                      .done(function(data) {
                        swal(investor_status_message, "Investor was successfully "+investor_status_message+"!", "success");
						investors_table.draw();
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