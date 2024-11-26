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
          
      </div>
  </div>
<style>
    #sidebar-wrapper {
        background-image: url('{{ asset('build/assets/IMG_7110.png') }}'); /* Menentukan gambar background */
        background-size: cover;  /* Menyesuaikan gambar dengan ukuran elemen */
        background-position: center;  /* Menempatkan gambar di tengah */
        background-repeat: no-repeat;  /* Menghindari gambar terulang */
        height: 100vh;  /* Pastikan sidebar mengisi tinggi layar */
    }
</style>