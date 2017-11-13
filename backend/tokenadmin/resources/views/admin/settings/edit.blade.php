@extends('admin.layouts.master')

@section('content') 

<div class="content-wrapper">        
    <section class="content-header">
        <h1>Edit Settings</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin::investors') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Edit Settings</li>
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
                
                
                <form method="POST" action="http://dev.nucleus.vision/admin/investors/update" accept-charset="UTF-8" class="form-horizontal"><input name="_token" type="hidden" value="r5nCKIrPwIWfk97EtVxlLCAznRoOgL0ubq2kMgFM">  
                <input name="investor_id" type="hidden" value="2"> 
                <div class="row mrb20">
                  <div class="col-md-12">
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Date/Time for start sales for whitelisted users </label>
                      <div class="col-md-4">
                          <input class="form-control" tabindex="3" name="id" type="text" value="1" disabled="disabled">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Date/Time for start sales for public (any user)</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="3" name="first_name" type="text" value="John">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Bonus % for first buyers</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="3" name="last_name" type="text" value="Smith">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Number of first buyers that are awarded</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="email" type="text" value="test@gmail.com">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Token price</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="dob" type="text" value="2017-10-17">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Min amount of either to invest</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="nationality" type="text" value="ASCENSION">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Audit-period days (how many days until nCash tokens become transferrable post ICO)</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="gender" type="text" value="Male">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Maximum limit</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="residence" type="text" value="ALAND ISLANDS">
                      </div>
                    </div>
                       
                      
                  </div>
                </div>
                <p align="center">
                    <input class="btn btn-success btn-lg mrr20" type="submit" name="status" value="Approve"> 
                    <input class="btn btn-danger btn-lg mrr20" type="submit" name="status" value="Reject"> 
                    <a href="javascript:void(0);" class="btn btn-primary btn-lg cancel">Cancel</a>
                </p>
                <br>
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
                
              </form>
                
                
            </div>
          </div>
        </section>
        <script>
            $(function () {
                $(".cancel").click(function(){ 
                   location.href="{{ route('admin::settings') }}"; 
                });
            }); 
        </script>
</div>
@endsection