<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="<?php echo e(Request::is('admin/dashboard') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::dashboard")); ?>">
                    <i class="icon-speedometer"></i> <span>Dashboard</span>
                </a>
            </li>
            
            <li class="<?php echo e(Request::is('admin/investors', 'admin/investors/*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::investors")); ?>">
                    <i class="icon-users"></i> <span>Investors</span>
                </a>
            </li>
            
            <li class="<?php echo e(Request::is('admin/entries', 'admin/entries/*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::entries")); ?>">
                    <i class="icon-users"></i> <span>Entries</span>
                </a>
            </li>
            
            <li class="<?php echo e(Request::is('admin/investors-new', 'admin/investors-new/*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::investorsNew")); ?>">
                    <i class="icon-users"></i> <span>Investors New</span>
                </a>
            </li>
            
            <li class="<?php echo e(Request::is('admin/pr-investors', 'admin/pr-investors/*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::prInvestors")); ?>">
                    <i class="icon-users"></i> <span>PR Investors</span>
                </a>
            </li>
            
            <li class="<?php echo e(Request::is('admin/settings', 'admin/settings/*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::settings")); ?>">
                    <i class="icon-users"></i> <span>Settings</span>
                </a>
            </li>
        </ul>
    </section>
</aside>