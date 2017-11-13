<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Nucleus Vision | Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="/assets/css/global.css" rel="stylesheet" type="text/css" />
    <script src="/assets/js/jquery.min.js" type="text/javascript"></script>
    <!-- <script src="/assets/js/sweetalert.js"></script> -->
    <script src="/assets/js/sweetalert2.min.js"></script>
    <script src="/assets/js/core.js"></script>
    <script src="<?php echo e(asset("assets/js/notify.min.js")); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset("assets/js/notify-metro.js")); ?>" type="text/javascript"></script>	
    <link rel="icon" href="<?php echo e(asset('assets/img/favicon.png')); ?>" type="image/png" sizes="16x16">
  </head>
  <body class="sidebar-mini">
        <div class="wrapper">  
            <?php echo $__env->make('admin.partial.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo $__env->make('admin.partial.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo $__env->yieldContent('content'); ?>

            <?php echo $__env->make('admin.partial.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
            <?php if(Session::has('status')): ?>
            <script type="text/javascript"> 
                $.notify({
                    title: '',
                    text: "<?php echo e(Session::get('message')); ?>"
                }, {
                    style: 'metro',
                    className: "<?php echo e(Session::get('status')); ?>",
                    autoHide: true,
                    clickToHide: true
                });
            </script> 
            <?php endif; ?>
            
        </div>

        <div class="loader">
            <div class="spinner"></div>
        </div>
      
        <script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/assets/js/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="/assets/js/app.min.js" type="text/javascript"></script>
        <script src="/assets/js/jquery.validate.min.js"></script>
        <script src="/assets/js/moment-with-locales.js"></script>
        <script src="/assets/js/bootstrap-datetimepicker.js"></script>
        <script src="/assets/js/custom.js"></script>
    </body>
</html>    
        