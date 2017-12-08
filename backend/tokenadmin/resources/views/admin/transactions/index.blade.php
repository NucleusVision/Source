@extends('admin.layouts.master')

@section('content') 
  <div class="content-wrapper">        
    <section class="content-header">
      <h1>Show Transactions</h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin::dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Show Transactions</li>
      </ol>
    </section>        
    <section class="content">      
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Show Transactions</h3>
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
        <div class="box tr-form-container">   
              {{ csrf_field() }}
              <div class="row tr-form-wrapper">  
                    <div>
                            <form id="tr-search-form1" method="post" action="{{ route('admin::trSearchForm1') }}">
                                {{ csrf_field() }}
                                <div class="sel-type">
                                    <label for="">Investor Type</label>
                                    <select class="form-control" id="investor_type" name="investor_type">
                                        <option value="" selected="selected">All</option>
                                        <option value="whitelisted">White Listed</option>
                                        <option value="public">Public</option>
                                        <option value="private">Private</option>
                                    </select>
                                </div>
                                <div class="sel-investor">
                                    <label for="">Investor</label>
                                    <select class="form-control" id="investor_name" name="investor_name">
                                        <option value="" selected="selected">Select Investor</option>
                                        @foreach($investors as $investor)
                                        <option value="{{ $investor->investor_id }}">{{ $investor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-btn">
                                    <input class="btn btn-success btn-sm" type="submit" name="status" value="Submit">
                                </div>
                            </form>
                            <div class="txt">
                                (or)
                            </div>
                            <form id="tr-search-form2" method="post" action="{{ route('admin::trSearchForm2') }}">
                                {{ csrf_field() }}
                                <div class="sel-investor">
                                    <label for="">ETH Wallet Address</label>
                                    <input type="text" name="eth_addr" id="eth_addr" value="" class="form-control" />
                                </div>
                                <div class="input-btn">
                                    <input class="btn btn-success btn-sm" type="submit" name="status" value="Submit">
                                </div>
                            </form>
                    </div>  
            </div>
        </div>
        
        <div class="box-body tr-form-body-msg"> 
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
             @if (session('error'))
                <div class="alert alert-info fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('error') }}
                </div>
            @endif
          <table id="tr-search-list" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>blockNumber</th>
                <th>timeStamp</th>
                <th>hash</th>
                <th>nonce</th>
                <th>blockHash</th>
                <th>transactionIndex</th>
                <th>from</th>
                <th>to</th>
                <th>value</th>
                <th>gas</th>
                <th>gasPrice</th>
                <th>isError</th>
                <th>txreceipt_status</th>
                <th>contractAddress</th>
                <th>cumulativeGasUsed</th>
                <th>gasUsed</th>
                <th>confirmations</th>
              </tr>
            </thead>
            <tbody>
                @if (session('txnlists'))
                @foreach($txnlists as $key=>$item)
                <tr>
                <td>{{ $item['blockNumber'] }}</td>
                <td>{{ $item['timeStamp'] }}</td>
                <td>{{ $item['hash'] }}</td>
                <td>{{ $item['nonce'] }}</td>
                <td>{{ $item['blockHash'] }}</td>
                <td>{{ $item['transactionIndex'] }}</td>
                <td>{{ $item['from'] }}</td>
                <td>{{ $item['to'] }}</td>
                <td>{{ $item['value'] }}</td>
                <td>{{ $item['gas'] }}</td>
                <td>{{ $item['gasPrice'] }}</td>
                <td>{{ $item['isError'] }}</td>
                <td>{{ $item['txreceipt_status'] }}</td>
                <td>{{ $item['contractAddress'] }}</td>
                <td>{{ $item['cumulativeGasUsed'] }}</td>
                <td>{{ $item['gasUsed'] }}</td>
                <td>{{ $item['confirmations'] }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
          </table>
        </div>      
    </section>          
    </div>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/dataTables.bootstrap.min.js"></script>
    <script src="/assets/js/dataTables.alphabetSearch.js"></script>
      <script>
          $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
            });
                
           $("#investor_type").change(function(){
                var investor_type = $(this).val();
                //var token = $("input[name='_token']").val();
                $.ajax({
                    url: "{{ route('admin::ajaxGetInvestors') }}",
                    method: 'POST',
                    data: {investor_type:investor_type},
                    success: function(obj) {
                        //console.log(obj);
                        var iarr=[];
                        for(a in obj){
                            iarr.push([a,obj[a]]);
                        }
                        iarr.sort(function(a,b){return a[1] - b[1]});
                        iarr.reverse();
                        $('#investor_name').empty();
                        for(var a=0;b=iarr[a];++a){
                            $('#investor_name').append("<option value='" + b[0] +"'>" + b[1] + "</option>");
                        }
                        
                        /*
                        //console.log(data.sort());
                        $('#investor_name').empty();
                        $.each(data, function(key, element) {
                            $('#investor_name').append("<option value='" + key +"'>" + element + "</option>");
                        });
                        */
                    }
                });
            });
            
            $('#tr-search-list').dataTable();
            
            
      </script>
@endsection