@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">        
    <section class="content-header">
      <h1>Dashboard</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route("admin::dashboard") }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>        
    <section class="content">
      <div class="row">
        
        <div class="col-md-3">          
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>{{ $iEntries }}</h3>
              <p>Total Entries</p>
            </div>
            <div class="icon">
              <i class="ion icon-users"></i>
            </div>
          </div>
        </div>   
          
        <div class="col-md-3">          
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>{{ $iInvestors }}</h3>
              <p>Total Investors</p>
            </div>
            <div class="icon">
              <i class="ion icon-users"></i>
            </div>
          </div>
        </div>
	
          
		<!--
		<div class="col-md-3">          
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>04</h3>
              <p>Total Orders</p>
            </div>
            <div class="icon">
              <i class="ion icon-basket"></i>
            </div>
          </div>
        </div>
		
        <div class="col-md-3">          
          <div class="small-box bg-teal">
            <div class="inner">
              <h3>10</h3>
              <p>Total clients</p>
            </div>
            <div class="icon">
              <i class="ion icon-users"></i>
            </div>
          </div>
        </div>
        <div class="col-md-3">              
          <div class="small-box bg-red">
            <div class="inner">
              <h3>44</h3>
              <p>Total products</p>
            </div>
            <div class="icon">
              <i class="ion icon-grid"></i>
            </div>
          </div>
        </div>
      </div> 
	  
	  -->
      <!--  
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Recent Activities</h3>
        </div>
        <div class="box-body">
          <ul class="nav nav-pills nav-stacked">
            <li><a href="#"></a></li>
          </ul>
        </div>
      </div>
      -->  
    </section>
  </div>

@endsection
