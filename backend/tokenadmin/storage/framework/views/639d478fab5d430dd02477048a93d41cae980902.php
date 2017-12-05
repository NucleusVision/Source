<?php $__env->startSection('content'); ?> 
  <div class="content-wrapper">        
    <section class="content-header">
      <h1>Settings</h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin::dashboard')); ?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Settings</li>
      </ol>
    </section>        
    <section class="content">      
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Settings</h3>
        </div>
          <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach($errors->all() as $error): ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="box-body">  
          <form method="POST" action="/admin/settings/store" accept-charset="UTF-8" class="form-horizontal">  
              <?php echo e(csrf_field()); ?>

                <div class="row mrb20">
                  <div class="col-md-12">
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Date/Time for start sales for whitelisted users </label>
                      <div class="col-md-4">
                          <input class="form-control" tabindex="3" name="dt_sales_users" id="dt_sales_users" type="text" value="<?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $oSetting->dt_sales_users)->format('m/d/Y h:i a')); ?>">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Date/Time for start sales for public (any user)</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="3" name="dt_sales_public" id="dt_sales_public" type="text" value="<?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $oSetting->dt_sales_public)->format('m/d/Y h:i a')); ?>">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Bonus % for first buyers</label>
                      <div class="col-md-4">
                          <input class="form-control" tabindex="3" name="bonus_percentage" type="text" value="<?php echo e($oSetting->bonus_percentage); ?>">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Number of first buyers that are awarded</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="no_first_buyers" type="text" value="<?php echo e($oSetting->no_first_buyers); ?>">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Token price</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="token_price" type="text" value="<?php echo e($oSetting->token_price); ?>">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Min amount of ether to invest</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="min_amount" type="text" value="<?php echo e($oSetting->min_amount); ?>">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Audit-period days (how many days until nCash tokens become transferrable post ICO)</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="audit_period_days" type="text" value="<?php echo e($oSetting->audit_period_days); ?>">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5">Maximum limit</label>
                      <div class="col-md-4">
                        <input class="form-control" tabindex="5" name="max_limit" type="text" value="<?php echo e($oSetting->max_limit); ?>">
                      </div>
                    </div>
                    <div class="form-group mrb20">
                      <label for="" class="control-label col-md-5"></label>
                      <div class="col-md-4">
                        <input class="btn btn-success btn-lg mrr20" type="submit" name="status" value="Submit"> 
                        <a href="<?php echo e(route('admin::dashboard')); ?>" class="btn btn-primary btn-lg cancel">Cancel</a>
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
                         "url": "<?php echo e(route('admin::investorsList')); ?>", 
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
            });
           
        </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>