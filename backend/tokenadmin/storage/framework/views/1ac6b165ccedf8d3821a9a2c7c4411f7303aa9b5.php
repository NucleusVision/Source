<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="<?php echo e(Request::is('admin/dashboard') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::dashboard")); ?>">
                    <i class="icon-speedometer"></i> <span>Dashboard</span>
                </a>
            </li>
            
            <li class="<?php echo e(Request::is('admin/entries', 'admin/entries/*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::entries")); ?>">
                    <i class="icon-users"></i> <span>Entries</span>
                </a>
            </li>
            
            
            <li class="<?php echo e(Request::is('admin/investors-all', 'admin/investors-all/*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::investorsNew")); ?>">
                    <i class="icon-users"></i> <span>All Investors</span>
                </a>
            </li>
            
            <!--
            <li class="<?php echo e(Request::is('admin/investors', 'admin/investors/*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::investors")); ?>">
                    <i class="icon-users"></i> <span>Investors</span>
                </a>
            </li>
            -->
    
            <li class="<?php echo e(Request::is('admin/pr-investors', 'admin/pr-investors/*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::prInvestors")); ?>">
                    <i class="icon-users"></i> <span>PR Investors</span>
                </a>
            </li>
            
            <li class="<?php echo e(Request::is('admin/wp-investors', 'admin/wp-investors/*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::investorsWp")); ?>">
                    <i class="icon-users"></i> <span>Whitelisted/Public Investors</span>
                </a>
            </li>
            
            <li class="<?php echo e(Request::is('admin/settings', 'admin/settings/*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::settings")); ?>">
                    <i class="icon-settings"></i> <span>Settings</span>
                </a>
            </li>
            
            <li class="<?php echo e(Request::is('admin/show-transactions', 'admin/show-transactions/*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route("admin::showTransactions")); ?>">
                    <i class="icon-wallet"></i> <span>Show Transactions</span>
                </a>
            </li>
            
        </ul>
    </section>
</aside>