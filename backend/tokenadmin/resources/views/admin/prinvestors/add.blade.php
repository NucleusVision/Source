@extends('admin.layouts.master')

@section('content') 
<div class="content-wrapper">        
        <section class="content-header">
          <h1>Add Warehouse</h1>
          <ol class="breadcrumb">
            <li><a href="{{ route('admin::warehouse') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Add Warehouse</li>
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
                {!! Form::open(array('route' => 'admin::warehouseStore', 'class' => 'form-horizontal')) !!} 
                <div class="row mrb20">
                  <div class="col-md-6">
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-4">Warehouse code</label>
                      <div class="col-md-8">
                          {!! Form::text('code', null, ['class'=>'form-control', 'tabindex'=>'1']) !!}
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-4">Warehouse location</label>
                      <div class="col-md-8">
                        {!! Form::text('location', null, ['class'=>'form-control', 'tabindex'=>'3']) !!}
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-4">City</label>
                      <div class="col-md-8">
                        {!! Form::text('city', null, ['class'=>'form-control', 'tabindex'=>'5']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-4">Warehouse name</label>
                      <div class="col-md-8">
                        {!! Form::text('name', null, ['class'=>'form-control', 'tabindex'=>'2']) !!}
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-4">Address</label>
                      <div class="col-md-8">
                        {!! Form::text('address', null, ['class'=>'form-control', 'tabindex'=>'4']) !!}
                      </div>
                    </div>
                  </div>
                </div>
                <p align="center"><input class="btn btn-primary btn-lg mrr20" type="submit" value="Submit"> <a href="javascript:void(0);" class="btn btn-primary btn-lg cancel">Cancel</a></p>
              {!! Form::close() !!}
            </div>
          </div>
        </section>
      </div>
      <script>
            $(function () {
                $(".cancel").click(function(){ 
                   location.href="{{ route('admin::warehouse') }}"; 
                });
            }); 
      </script>
@endsection