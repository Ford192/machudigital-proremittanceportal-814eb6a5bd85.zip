<div id="sidebar-nav" class="sidebar">
  <div class="sidebar-scroll">
    <nav>
      <ul class="nav">
        <li><a href="{{ route('home')}}" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>

      @can('isAdmin')
        <li><a href="{{ url('/bank/show') }}" class=""><i class="lnr lnr-chart-bars"></i> <span>Banks</span></a></li>
        <li><a href="{{ route('all_users_admin')}}" class=""><i class="lnr lnr-users"></i> <span>Users</span></a></li>
        <li><a href="{{ route('all_remitance')}}" class=""><i class="lnr lnr-briefcase"></i> <span>Transactions</span></a></li>
        <li><a href="{{ route('actLog')}}" class=""><i class="lnr lnr-briefcase"></i> <span>Activity Logs</span></a></li>
{{--        <li><a href="{{ route('transactions.index.with-download')}}" class=""><i class="lnr lnr-users"></i> <span>Transactions</span></a></li>--}}
      @endcan
      @can('is_bank_cm')
        <li><a href="{{ route('bank_users_admin')}}" class=""><i class="lnr lnr-users"></i> <span>Users</span></a></li>
        <li><a href="{{ route('transactions.index.with-download')}}" class=""><i class="lnr lnr-users"></i> <span>Transactions</span></a></li>
      @endcan
        <!-- <li><a href="elements.html" class=""><i class="lnr lnr-code"></i> <span>Elements</span></a></li>
        <li><a href="charts.html" class=""><i class="lnr lnr-chart-bars"></i> <span>Charts</span></a></li>
        <li><a href="panels.html" class=""><i class="lnr lnr-cog"></i> <span>Panels</span></a></li>
        <li><a href="notifications.html" class=""><i class="lnr lnr-alarm"></i> <span>Notifications</span></a></li>
        <li>
          <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Pages</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
          <div id="subPages" class="collapse ">
            <ul class="nav">
              <li><a href="page-profile.html" class="">Profile</a></li>
              <li><a href="page-login.html" class="">Login</a></li>
              <li><a href="page-lockscreen.html" class="">Lockscreen</a></li>
            </ul>
          </div>
        </li>
        <li><a href="tables.html" class=""><i class="lnr lnr-dice"></i> <span>Tables</span></a></li>
        <li><a href="typography.html" class=""><i class="lnr lnr-text-format"></i> <span>Typography</span></a></li>
        <li><a href="icons.html" class=""><i class="lnr lnr-linearicons"></i> <span>Icons</span></a></li> -->

      </ul>
    </nav>
  </div>
</div>
