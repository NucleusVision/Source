@extends('admin.layouts.master')

@section('content') 

<div class="content-wrapper">        
    <section class="content-header">
        <h1>Edit Investor</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin::investors') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Edit Investor</li>
        </ol>
    </section>        
    <section class="content"> 
          <div class="box">                   
            <div class="box-body">
                @if (count($errors) > 0)
                <div class="row mrb10 center-align"> 
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                @if (session('status'))
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('status') }}
                </div>
                @endif
                {!! Form::model($oInvestor, array('route' => 'admin::investorsUpdate', 'class' => 'form-horizontal')) !!}  
                {!! Form::hidden('investor_id') !!} 
                <div class="row mrb20">
                  <div class="col-md-12">
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Id</label>
                      <div class="col-md-4">
                          <input class="form-control" tabindex="3" name="id" type="text" value="{{ $oInvestor->id }}" disabled="disabled">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">First Name</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="3" name="first_name" type="text" value="{{ $oInvestor->first_name }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Last Name</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="3" name="last_name" type="text" value="{{ $oInvestor->last_name }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Email</label>
                      <div class="col-md-4">
                        {!! Form::text('email', null, ['class'=>'form-control', 'tabindex'=>'5']) !!}
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">DOB</label>
                      <div class="col-md-4">
                        {!! Form::text('dob', null, ['class'=>'form-control', 'tabindex'=>'5']) !!}
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Nationality</label>
                      <div class="col-md-4">
                        {!! Form::text('nationality', null, ['class'=>'form-control', 'tabindex'=>'5']) !!}
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Gender</label>
                      <div class="col-md-4">
                        {!! Form::text('gender', null, ['class'=>'form-control', 'tabindex'=>'5']) !!}
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Country Of Residence</label>
                      <div class="col-md-4">
                        {!! Form::text('residence', null, ['class'=>'form-control', 'tabindex'=>'5']) !!}
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Identification Type</label>
                      <div class="col-md-4">
                        {!! Form::text('id_type', null, ['class'=>'form-control', 'tabindex'=>'5']) !!}
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Identification Number</label>
                      <div class="col-md-4">
                        {!! Form::text('id_num', null, ['class'=>'form-control', 'tabindex'=>'5']) !!}
                      </div>
                    </div>  
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Status</label>
                      <div class="col-md-4">
                          <label style="margin-top: 5px;">{{ $oInvestor->status }}</label>
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Created At</label>
                      <div class="col-md-4">
                        <label style="margin-top: 5px;">{{ $oInvestor->created_at }}</label>
                      </div>
                    </div>
                      
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Document1</label>
                      <div class="col-md-4"> 
                        <img src="http://13.56.240.73:8000/uploads/{{ $oInvestor->doc1 }}">
                      </div>
                    </div>
                      
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Document2</label>
                      <div class="col-md-4">
                        <img src="http://13.56.240.73:8000/uploads/{{ $oInvestor->doc2 }}">
                      </div>
                    </div>   
                      
                  </div>
                </div>
                <p align="center">
                    <input class="btn btn-success btn-lg mrr20" type="submit" name="status" value="Approve"> 
                    <input class="btn btn-danger btn-lg mrr20" type="submit" name="status" value="Reject"> 
                    <a href="javascript:void(0);" class="btn btn-primary btn-lg cancel">Cancel</a>
                </p>
                <br/>
                <div class="col-md-12">
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Text/Comments</label>
                      <div class="col-md-7">
                          <textarea rows="4" cols="40" name="message"></textarea>
                      </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5"></label>
                      <div class="col-md-7">
                          <input class="btn btn-info btn-lg mrr20" type="submit" name="status" value="Send Mail">
                      </div>
                    </div>
                </div>  
                
              {!! Form::close() !!}
            </div>
          </div>
        </section>
        <script>
            $(function () {
                $(".cancel").click(function(){ 
                   location.href="{{ route('admin::investors') }}"; 
                });
            }); 
        </script>
</div>
@endsection