<?php $__env->startSection('content'); ?> 
  <div class="content-wrapper">        
    <section class="content-header">
      <h1>Show Transactions</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin::dashboard')); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Show Transactions</li>
      </ol>
    </section>        
    <section class="content">      
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Show Transactions</h3>
        </div>
        <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                <li><?php echo e(session('error')); ?></li>
            </ul>
        </div>
        <?php endif; ?>
        <div class="box tr-form-container">   
              <?php echo e(csrf_field()); ?>

              <div class="row tr-form-wrapper">  
                    <div>
                            <form id="tr-search-form1" method="post" action="<?php echo e(route('admin::trSearchForm1')); ?>">
                                <?php echo e(csrf_field()); ?>

                                <div class="sel-type">
                                    <label for="">Investor Type</label>
                                    <select class="form-control" id="investor_type" name="investor_type">
                                        <option value="" selected="selected">All</option>
                                        <option value="whitelisted" <?php if(session('sel_investor_type') == "whitelisted"): ?> selected <?php endif; ?>>White Listed</option>
                                        <option value="public" <?php if(session('sel_investor_type') == "public"): ?> selected <?php endif; ?>>Public</option>
                                        <option value="private" <?php if(session('sel_investor_type') == "private"): ?> selected <?php endif; ?>>Private</option>
                                    </select>
                                </div>
                                <div class="sel-investor">
                                    <label for="">Investor</label>
                                    <select class="form-control" id="investor_name" name="investor_name">
                                        <option value="" selected="selected">Select Investor</option>
                                        <?php foreach($investors as $investor): ?>
                                        <option value="<?php echo e($investor->investor_id); ?>" <?php if(session('sel_investor_name') == $investor->investor_id): ?> selected <?php endif; ?>><?php echo e($investor->name); ?></option>
                                        <?php endforeach; ?>
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
                                    <input type="text" name="eth_addr" id="eth_addr" value="<?php if(session('sel_eth_addr')): ?><?php echo e(session('sel_eth_addr')); ?><?php endif; ?>" class="form-control" />
                                </div>
                                <div class="input-btn">
                                    <input class="btn btn-success btn-sm" type="submit" name="status" value="Submit">
                                </div>
                            </form>
                    </div>  
            </div>
        </div>
        
        <div class="box-body tr-form-body-msg"> 
             <?php if(session('info_message')): ?>
                <div class="alert alert-info fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo e(session('info_message')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('eth_balance')): ?>
            <div class="row">
                <div class="col-md-2"><b>ETH Balance :</b></div><div class="col-md-3"> <?php echo e(session('eth_balance')); ?> </div>
            </div>
            <?php endif; ?>
            <?php if(session('no_of_txns')): ?>
            <div class="row">
                <div class="col-md-3"><b>No Of Transactions : </b></div><div class="col-md-3"> <?php echo e(session('no_of_txns')); ?> </div>
            </div>
            <?php endif; ?>
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
                <?php if(session('txnlists')): ?>
                <?php foreach($txnlists as $key=>$item): ?>
                <tr>
                <td><?php echo e($item['hash']); ?></td>    
                <td><?php echo e($item['blockNumber']); ?></td>
                <td>
                    <?php
                    
                    echo \App\Models\Investor::time_elapsed_string("@".$item['timeStamp'], true);
                    
                    //$now = \Carbon\Carbon::now('UTC');
                    //echo $item['timeStamp']."<br/>";
                    //echo \Carbon\Carbon::createFromTimeStamp($item['timeStamp'])->diffForHumans();
                    
                    ?>
                </td>
                <td><?php echo e($item['from']); ?></td>
                <td><?php echo e($item['to']); ?></td>
                <td><?php echo e($item['value']/1000000000000000000); ?> Ether</td>
                <td><?php echo e(($item['gasPrice']*$item['gasUsed'])/1000000000000000000); ?></td>
                <!--
                <td><?php echo e($item['nonce']); ?></td>
                <td><?php echo e($item['blockHash']); ?></td>
                <td><?php echo e($item['transactionIndex']); ?></td>
                <td><?php echo e($item['gas']); ?></td>
                <td><?php echo e($item['gasPrice']); ?></td>
                <td><?php echo e($item['isError']); ?></td>
                <td><?php echo e($item['txreceipt_status']); ?></td>
                <td><?php echo e($item['contractAddress']); ?></td>
                <td><?php echo e($item['cumulativeGasUsed']); ?></td>
                <td><?php echo e($item['gasUsed']); ?></td>
                <td><?php echo e($item['confirmations']); ?></td>
                -->
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
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
                    url: "<?php echo e(route('admin::ajaxGetInvestors')); ?>",
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>