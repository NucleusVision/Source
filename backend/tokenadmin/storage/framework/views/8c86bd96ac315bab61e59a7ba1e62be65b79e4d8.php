<header class="main-header">
    <a href="<?php echo e(route('admin::dashboard')); ?>" class="logo">
        <span class="logo-mini"><img src="/assets/img/logo-icon-small.png" alt=""></span>
        <span class="logo-lg"><img src="/assets/img/logo.png" alt=""></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-target="#navbarCollapse" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <?php if(\Auth::check()): ?>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown dropdown-user">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username username-hide-on-mobile"><?php echo e(trim(str_limit(\Auth::user()->first_name." ".\Auth::user()->last_name, 25))); ?></span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">     
                        <li><a href="<?php echo e(route('auth.logout')); ?>"><i class="fa fa-lock"></i> Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <?php endif; ?>
        
    </nav>
</header>