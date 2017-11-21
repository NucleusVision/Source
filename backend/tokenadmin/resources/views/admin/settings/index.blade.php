@extends('admin.layouts.master')

@section('content') 
  <div class="content-wrapper">        
    <section class="content-header">
      <h1>Settings</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Settings</li>
      </ol>
    </section>        
    <section class="content">      
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Settings</h3>
        </div>
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="box-body">  
          <form method="POST" action="/admin/settings/store" accept-charset="UTF-8" class="form-horizontal">  
              {{ csrf_field() }}
                <div class="row mrb20">
                  <div class="col-md-12">
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Date/Time for start sales for whitelisted users </label>
                      <div class="col-md-4">
                          <input class="form-control" tabindex="3" name="dt_sales_users" id="dt_sales_users" type="text" value="{{  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $oSetting->dt_sales_users)->format('m/d/Y h:i a') }}">
                      </div>
                      <div class="col-md-2">
                        <a href="#" id="load-ico-link" onclick="loadIcoSettings(); return false;"> Load ICO Settings</a>
                        | 
                        <a href="#" id="get-stats-link" onclick="getStats(); return false;"> get Stats</a>
                        <div id="loading-ico-cnt" style="display:none">Loading...</div>
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Date/Time for start sales for public (any user)</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="3" name="dt_sales_public" id="dt_sales_public" type="text" value="{{  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $oSetting->dt_sales_public)->format('m/d/Y h:i a') }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Bonus % for first buyers</label>
                      <div class="col-md-4">
                          <input class="form-control" tabindex="3" name="bonus_percentage" type="text" value="{{ $oSetting->bonus_percentage }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Number of first buyers that are awarded</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="no_first_buyers" type="text" value="{{ $oSetting->no_first_buyers }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Token price</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="token_price" type="text" value="{{ $oSetting->token_price }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Min amount of ether to invest</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="min_amount" type="text" value="{{ $oSetting->min_amount }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Audit-period days (how many days until nCash tokens become transferrable post ICO)</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="audit_period_days" type="text" value="{{ $oSetting->audit_period_days }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Maximum limit</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="max_limit" type="text" value="{{ $oSetting->max_limit }}">
                      </div>
                    </div>
                    <br>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Min Gas</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="minGas" type="text" value="{{ $oSetting->minGas }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Max Gas</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="maxGas" type="text" value="{{ $oSetting->MaxGas }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Min Gas Price</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="minGasPrice" type="text" value="{{ $oSetting->minGasPrice }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Max Gas Price</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="maxGasPrice" type="text" value="{{ $oSetting->maxGasPrice }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Token price in BTC</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="bPrice" type="text" value="{{ $oSetting->bPrice }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">softCap</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="softCap" type="text" value="{{ $oSetting->softCap }}">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">hardCap</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="hardCap" type="text" value="{{ $oSetting->hardCap }}">
                      </div>
                    </div>
                    
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">sale End Time</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="3" name="endTime" id="dt_end_time" type="text" value="">
                      </div>
                    </div>
                    
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">lock Time</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="3" name="lockTime" id="dt_lock_time" type="text" value="">
                      </div>
                    </div>
                      
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5"></label>
                      <div class="col-md-4">
                        <input class="btn btn-success btn-lg mrr20" type="submit" name="status" value="Submit"> 
                        <a href="javascript:void(0);" class="btn btn-primary btn-lg cancel">Cancel</a>
                      </div>
                    </div> 
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/dataTables.bootstrap.min.js"></script>
    <script src="/assets/js/dataTables.alphabetSearch.js"></script>
      <script>
          
          function getStats(){

            $("#get-stats-link").hide();
            $("#loading-ico-cnt").show();
            $.ajax({
                url: 'http://54.215.211.34:8080/admin/settings/get-stats',
                type: 'GET',
                dataType : 'JSON',
                data: {},
                success: function(data) {
                    $("#get-stats-link").show();
                    $("#loading-ico-cnt").hide();
                    if(data.status != "ok"){
                        console.log(data);
                        alert("empty response " + data.message);
                        return false;
                    }
                    
                    var cntToShow = "";
                    if(typeof data.data.totalEthRaised !== 'undefined'){
                         if(data.data.totalEthRaised != '-'){
                             cntToShow += "totalEthRaised: "+totalEthRaised+"\r\n";
                         }
                    }
                    if(typeof data.data.totalTokensSold !== 'undefined'){
                         if(data.data.totalTokensSold != '-'){
                             cntToShow += "totalTokensSold: "+totalTokensSold+"\r\n";
                         }
                    }
                    if(typeof data.data.buyersCount !== 'undefined'){
                         if(data.data.buyersCount != '-'){
                             cntToShow += "buyersCount: "+buyersCount+"\r\n";
                         }
                    }
                    
                    if(cntToShow == ""){
                        alert("no data found");
                    }else{
                        alert(cntToShow);
                    }
                },
                error: function(data) {
                     //console.log(data);
                    $("#get-stats-link").show();
                    $("#loading-ico-cnt").hide();
                    var show = (typeof data.responseJSON !== 'undefined')?data.responseJSON.message:"request failed";
                    alert(show);
                    return false;
                },
             });

          }
          
          function loadIcoSettings(){

            var autoFields = ['minGas', 'maxGas', 'minGasPrice', 'maxGasPrice', 'maxGasPrice', 'bPrice', 'softCap', 'hardCap', 'endTime'];
            $("#load-ico-link").hide();
            $("#loading-ico-cnt").show();
            $.ajax({
                url: 'http://54.215.211.34:8080/admin/settings/load-ico-settings',
                type: 'GET',
                dataType : 'JSON',
                data: {},
                success: function(data) {
                    $("#load-ico-link").show();
                    $("#loading-ico-cnt").hide();
                    if(data.status != "ok"){
                        console.log(data);
                        alert("empty response " + data.message);
                        return false;
                    }
                    
                    if(typeof data.data.whiteTime !== 'undefined'){
                         if(data.data.whiteTime != '-'){
                             document.getElementsByName("dt_sales_users")[0].value = data.data.whiteTime;
                         }
                    }

                    if(typeof data.data.publicTime !== 'undefined'){
                         if(data.data.publicTime != '-'){
                             document.getElementsByName("dt_sales_public")[0].value = data.data.publicTime;
                         }
                    }
                    
                    if(typeof data.data.endTime !== 'undefined'){
                         if(data.data.endTime != '-'){
                             document.getElementsByName("dt_end_time")[0].value = data.data.endTime;
                         }
                    }
                    
                    if(typeof data.data.lockTime !== 'undefined'){
                         if(data.data.lockTime != '-'){
                             document.getElementsByName("dt_lock_time")[0].value = data.data.lockTime;
                         }
                    }
                    
                    if(typeof data.data.bonus !== 'undefined'){
                         if(data.data.bonus != '-'){
                             document.getElementsByName("bonus_percentage")[0].value = data.data.bonus;
                         }
                    }
                    
                    if(typeof data.data.bonusBuyers !== 'undefined'){
                         if(data.data.bonusBuyers != '-'){
                             document.getElementsByName("no_first_buyers")[0].value = data.data.bonusBuyers;
                         }
                    }
                    
                    if(typeof data.data.ePrice !== 'undefined'){
                         if(data.data.ePrice != '-'){
                             document.getElementsByName("token_price")[0].value = data.data.ePrice;
                         }
                    }
                    
                    if(typeof data.data.minEth !== 'undefined'){
                         if(data.data.minEth != '-'){
                             document.getElementsByName("min_amount")[0].value = data.data.minEth;
                         }
                    }
                    
                    
                    for(var c = 0; typeof autoFields[c] !== 'undefined'; c++){
                        if(typeof data.data[autoFields[c]] !== 'undefined'){
                         if(data.data[autoFields[c]] != '-'){
                             document.getElementsByName(autoFields[c])[0].value = data.data[autoFields[c]];
                         }
                        }
                    }
                    
                    
                },
                error: function(data) {
                     //console.log(data);
                    $("#load-ico-link").show();
                    $("#loading-ico-cnt").hide();
                    var show = (typeof data.responseJSON !== 'undefined')?data.responseJSON.message:"request failed";
                    alert(show);
                    return false;
                },
             });

          }
          /*
            $(document).ready(function() { 
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });
                
                $('#investors-list').DataTable({
                  "ajax": {
                        "processing": true,
                         "serverSide": true,
                         "url": "{{ route('admin::investorsList') }}", 
                         "dataSrc": ""
                    },
                    "columns": [
                        { "data": "id",
                            "render": function(data, type, row, meta) {
                                var out='<a href="/admin/investors/' + row.investor_id + '/view" class="">' + row.id + '</a>&nbsp';  
                                return out;
                            }  
                        },
                        { "data": "name",
                            "render": function(data, type, row, meta) {     
                                return row.first_name+row.last_name;
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
            */
           
           $(function () {
                $('#dt_sales_users, #dt_sales_public').datetimepicker();
                loadIcoSettings();
            });
           
        </script>
@endsection