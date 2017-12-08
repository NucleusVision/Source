@extends('admin.layouts.master')

@section('content') 

<div class="content-wrapper">        
        <section class="content-header">
          <h1>View Investor</h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin::investors') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">View Investor</li>
          </ol>
        </section>        
        <section class="content">
          
          <div class="box">                  
            <div class="box-body">

                <div class="row mrb20">
                  <div class="col-md-12">
                    <div class="row mrb20">
                      <div class="col-md-5 text-right"><b>Id</b>:</div>
                      <div class="col-md-7 pdl0">
                        {{ $oInvestor->id }}
                      </div>
                    </div>
                    <div class="row mrb20">
                      <div class="col-md-5 text-right"><b>Name</b>:</div>
                      <div class="col-md-7 pdl0">
                        {{ $oInvestor->first_name." ". $oInvestor->last_name  }}
                      </div>
                    </div>
                    <div class="row mrb20">
                      <div class="col-md-5 text-right"><b>Email</b>:</div>
                      <div class="col-md-7 pdl0">
                        {{ $oInvestor->email }}
                      </div>
                    </div>
                    
                    <div class="row mrb20">
                      <div class="col-md-5 text-right"><b>DOB</b>:</div>
                      <div class="col-md-7 pdl0">
                        {{ $oInvestor->dob }}
                      </div>
                    </div>
                    <div class="row mrb20">
                      <div class="col-md-5 text-right"><b>Gender</b>:</div>
                      <div class="col-md-7 pdl0">
                        {{ $oInvestor->gender }}
                      </div>
                    </div>
                    <div class="row mrb20">
                      <div class="col-md-5 text-right"><b>Nationality</b>:</div>
                      <div class="col-md-7 pdl0">
                        {{ $oInvestor->nationality }}
                      </div>
                    </div>
                    <div class="row mrb20">
                      <div class="col-md-5 text-right"><b>Country Of Residence</b>:</div>
                      <div class="col-md-7 pdl0">
                        {{ $oInvestor->residence }}
                      </div>
                    </div>
                    <div class="row mrb20">
                      <div class="col-md-5 text-right"><b>Identification Type</b>:</div>
                      <div class="col-md-7 pdl0">
                        {{ $oInvestor->id_type }}
                      </div>
                    </div>
                    <div class="row mrb20">
                      <div class="col-md-5 text-right"><b>Identification Number</b>:</div>
                      <div class="col-md-7 pdl0">
                        {{ $oInvestor->id_num }}
                      </div>
                    </div> 
					
					<div class="row mrb20">
                      <div class="col-md-5 text-right"><b>Document1</b>:</div>
                      <div class="col-md-7 pdl0">
                         <img src="/uploads/ps/id2.jpg" >
                      </div>
                    </div> 
					
					<div class="row mrb20">
                      <div class="col-md-5 text-right"><b>Document2</b>:</div>
                      <div class="col-md-7 pdl0">
                         <img src="/uploads/ps/id1.jpg" >
                      </div>
                    </div> 
                      

                    <div class="row mrb20">
                      <div class="col-md-5 text-right"><b>Status</b>:</div>
                      <div class="col-md-7 pdl0">
                        {{ $oInvestor->status }}
                      </div>
                    </div>
                    <div class="row mrb20">
                      <div class="col-md-5 text-right"><b>Created At</b>:</div>
                      <div class="col-md-7 pdl0">
                        {{ $oInvestor->created_at }}
                      </div>
                    </div>
                  </div>
                </div>
                
                <p align="center"><a href="{{ route('admin::investorsEdit', $oInvestor->investor_id) }}" class="btn btn-primary btn-lg mrr20">Edit</a> <a href="#" class="btn btn-primary btn-lg cancel">Back</a></p>
            </div>
          </div>
        </section>
      </div>
      <script>
            $(function () {
                $(".cancel").click(function(){ 
                   location.href="{{ route('admin::investors') }}"; 
                });
            }); 
      </script>
@endsection