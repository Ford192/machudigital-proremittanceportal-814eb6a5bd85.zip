<nav class="navbar navbar-default navbar-fixed-top">
  <div class="brand" style="padding:0;">
    <a href=" {{ url('/home')}}">
      <img src="{{ url('/img/logo_1.png') }}" width="100" style="padding:0; margin:0;" alt="Instant Money" class="img-responsive logo"></a>
  </div>
  <div class="container-fluid">
    <div class="navbar-btn">
      <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
    </div>
    <div id="navbar-menu">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span>{{ Auth()->user()->email}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
          <ul class="dropdown-menu">
            <!-- <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><i class="lnr lnr-user"></i> <span>Change Password</span></a></li> -->
            <li><a href="{{ route('logout')}}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
          </ul>
        </li>
        <!-- <li>
          <a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
        </li> -->
      </ul>
    </div>
  </div>
</nav>
<!-- END NAVBAR -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Change Passowrd</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
        @csrf;
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="exampleInputEmail14" aria-describedby="emailHelp" value="{{ Auth()->user()->name }}" disabled>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">New Password</label>
            <input type="text" class="form-control" name="new_password" id="exampleInputEmail15" aria-describedby="emailHelp" placeholder="new password">
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
