  <!-- Sidebar-->
  <div class="border-end bg-light" id="sidebar-wrapper">
      <div class="sidebar-heading border-bottom bg-light d-flex d-flex align-items-baseline ">
          <div class="container">
              <img src="{{ asset('storage/img/picalogo.svg') }}" alt="" width="100"height="100">
          </div>

      </div>
      <div class="list-group list-group-flush">
          <a class="list-group-item list-group-item-action list-group-item-light p-3" id="dashboardsActive"
              href="/">Dashboard</a>
          @if (Auth::user()->role == 'superadmin' || Auth::user()->role == 'Admin')
              <a class="list-group-item list-group-item-action list-group-item-light p-3" id="QuickActive"
                  href="{{ route('QuickCount.showQuickCount') }}">Quick Count</a>
              <a class="list-group-item list-group-item-action list-group-item-light p-3" id="RealActive"
                  href="{{ route('RealCount.showRealCount') }}">Real Count</a>
          @endif
          @if (Auth::user()->role == 'superadmin')
              <a class="list-group-item list-group-item-action list-group-item-light p-3" id="userActive"
                  href="{{ route('user.userShowAll') }}">Users</a>
          @endif
          <p style="background-image: url('/IMG_7110.png');">
      </div>
  </div>
<style>
p {
  background-image: url('/IMG_7110.png');
}
</style>