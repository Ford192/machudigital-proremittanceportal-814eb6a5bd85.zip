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
{{--        <li><a href="{{ route('transactions.index.with-download')}}" class=""><i class="lnr lnr-users"></i> <span>Transaction Report</span></a></li>--}}
      @endcan
      @can('is_bank_cm')
        <li><a href="{{ route('bank_users_admin')}}" class=""><i class="lnr lnr-users"></i> <span>Users</span></a></li>
        <li><a href="https://portal.myzeepay.com/EclipsePORTAL/index.jsf" class=""><i class="lnr lnr-sync"></i> <span>Redemption Portal</span></a></li>
      <li><a href="{{ route('transactions.index.with-download')}}" class=""><i class="lnr lnr-printer"></i> <span>Transactions</span></a></li>
      @endcan

      @can('is_teller')
              <li><a href="{{ route('transactions.index.with-download')}}" class=""><i class="lnr lnr-printer"></i> <span>Transactions Report</span></a></li>
          <li><a id="Aj_print" href="{{ url('/receipt/printable') }}" onclick="openWin()" class=""><i class="lnr lnr-printer"></i> <span>Print Last Receipt</span></a></li>
          <li><a href="https://portal.myzeepay.com/EclipsePORTAL/index.jsf" class=""><i class="lnr lnr-sync"></i> <span>Redeem Voucher</span></a></li>
      @endcan

      </ul>
    </nav>
  </div>
</div>



