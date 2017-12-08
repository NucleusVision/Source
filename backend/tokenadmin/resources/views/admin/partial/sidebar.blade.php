<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route("admin::dashboard") }}">
                    <i class="icon-speedometer"></i> <span>Dashboard</span>
                </a>
            </li>
            
            <li class="{{ Request::is('admin/entries', 'admin/entries/*') ? 'active' : '' }}">
                <a href="{{ route("admin::entries") }}">
                    <i class="icon-users"></i> <span>Entries</span>
                </a>
            </li>
            
            
            <li class="{{ Request::is('admin/investors-all', 'admin/investors-all/*') ? 'active' : '' }}">
                <a href="{{ route("admin::investorsNew") }}">
                    <i class="icon-users"></i> <span>All Investors</span>
                </a>
            </li>
            
            <!--
            <li class="{{ Request::is('admin/investors', 'admin/investors/*') ? 'active' : '' }}">
                <a href="{{ route("admin::investors") }}">
                    <i class="icon-users"></i> <span>Investors</span>
                </a>
            </li>
            -->
    
            <li class="{{ Request::is('admin/pr-investors', 'admin/pr-investors/*') ? 'active' : '' }}">
                <a href="{{ route("admin::prInvestors") }}">
                    <i class="icon-users"></i> <span>PR Investors</span>
                </a>
            </li>
            
            <li class="{{ Request::is('admin/wp-investors', 'admin/wp-investors/*') ? 'active' : '' }}">
                <a href="{{ route("admin::investorsWp") }}">
                    <i class="icon-users"></i> <span>Whitelisted/Public Investors</span>
                </a>
            </li>
            
            <li class="{{ Request::is('admin/settings', 'admin/settings/*') ? 'active' : '' }}">
                <a href="{{ route("admin::settings") }}">
                    <i class="icon-settings"></i> <span>Settings</span>
                </a>
            </li>
            
            <li class="{{ Request::is('admin/show-transactions', 'admin/show-transactions/*') ? 'active' : '' }}">
                <a href="{{ route("admin::showTransactions") }}">
                    <i class="icon-wallet"></i> <span>Show Transactions</span>
                </a>
            </li>
            
        </ul>
    </section>
</aside>