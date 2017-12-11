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
        @if (session('error'))
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                <li>{{ session('error') }}</li>
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
                                        <option value="whitelisted" @if(session('sel_investor_type') == "whitelisted") selected @endif>White Listed</option>
                                        <option value="public" @if(session('sel_investor_type') == "public") selected @endif>Public</option>
                                        <option value="private" @if(session('sel_investor_type') == "private") selected @endif>Private</option>
                                    </select>
                                </div>
                                <div class="sel-investor">
                                    <label for="">Investor</label>
                                    <select class="form-control" id="investor_name" name="investor_name">
                                        <option value="" selected="selected">Select Investor</option>
                                        @foreach($investors as $investor)
                                        <option value="{{ $investor->investor_id }}" @if(session('sel_investor_name') == $investor->investor_id) selected @endif>{{ $investor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-btn">
                                    <input class="btn btn-success btn-sm" type="submit" name="status" value="Submit">
                                </div>
                            <div class="txt">
                                (or)
                            </div>
                                <div class="sel-investor">
                                    <label for="">ETH Wallet Address</label>
                                    <input type="text" name="eth_addr" id="eth_addr" value="@if(session('sel_eth_addr')){{ session('sel_eth_addr') }}@endif" class="form-control" />
                                </div>
                                <div class="input-btn">
                                    <input class="btn btn-success btn-sm" type="submit" name="status" value="Submit">
                                </div>
                            </form>
                    </div>  
            </div>
        </div>
        
        <div class="box-body tr-form-body-msg"> 
             @if (session('info_message'))
                <div class="alert alert-info fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session('info_message') }}
                </div>
            @endif
            @if (session('eth_balance'))
            <div class="row">
                <div class="col-md-2"><b>ETH Balance :</b></div><div class="col-md-3"> {{ session('eth_balance') }} </div>
            </div>
            @endif
            @if (session('no_of_txns'))
            <div class="row">
                <div class="col-md-3"><b>No Of Transactions : </b></div><div class="col-md-3"> {{ session('no_of_txns') }} </div>
            </div>
            @endif
          <table id="tr-search-list" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>TxHash</th> 
                <th>Block</th>
                <th>Age</th>
                <th>From</th>
                <th>To</th>
                <th>Value</th>
                <th>TxFee</th>
                <!--
                <th>nonce</th>
                <th>blockHash</th>
                <th>transactionIndex</th>
                <th>gas</th>
                <th>gasPrice</th>
                <th>isError</th>
                <th>txreceipt_status</th>
                <th>contractAddress</th>
                <th>cumulativeGasUsed</th>
                <th>gasUsed</th>
                <th>confirmations</th>
                -->
              </tr>
            </thead>
            <tbody>
                @if (session('txnlists'))
                @foreach($txnlists as $key=>$item)
                <tr>
                <td>{{ $item['hash'] }}</td>    
                <td>{{ $item['blockNumber'] }}</td>
                <td>
                    <?php
                    
                    echo \App\Models\Investor::time_elapsed_string("@".$item['timeStamp'], true);
                    
                    //$now = \Carbon\Carbon::now('UTC');
                    //echo $item['timeStamp']."<br/>";
                    //echo \Carbon\Carbon::createFromTimeStamp($item['timeStamp'])->diffForHumans();
                    
                    ?>
                </td>
                <td>{{ $item['from'] }}</td>
                <td>{{ $item['to'] }}</td>
                <td>{{ $item['value']/1000000000000000000 }} Ether</td>
                <td>{{ ($item['gasPrice']*$item['gasUsed'])/1000000000000000000 }}</td>
                <!--
                <td>{{ $item['nonce'] }}</td>
                <td>{{ $item['blockHash'] }}</td>
                <td>{{ $item['transactionIndex'] }}</td>
                <td>{{ $item['gas'] }}</td>
                <td>{{ $item['gasPrice'] }}</td>
                <td>{{ $item['isError'] }}</td>
                <td>{{ $item['txreceipt_status'] }}</td>
                <td>{{ $item['contractAddress'] }}</td>
                <td>{{ $item['cumulativeGasUsed'] }}</td>
                <td>{{ $item['gasUsed'] }}</td>
                <td>{{ $item['confirmations'] }}</td>
                -->
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
            

            $('#tr-search-list').DataTable({
                "scrollX": true,
                "bSort" : false,
                "pageLength": 25,
                "scrollY": "200px",
                "scrollCollapse": true,
                "paging": false
            });
            
            
      </script>
@endsection