    <!-- Top navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid py-3">
            <button class="btn btn-primary btn-lg" id="sidebarToggle"><i class="bi bi-list"></i></button>

            <a class="nav-link dropdown-toggle me-4" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Selamat Datang
                {{ Auth::user()->name }}</a>
            <div class="dropdown-menu dropdown-menu-end me-4" aria-labelledby="navbarDropdown">
                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalProfile"><i
                        class="bi bi-person"></i> Profile</button>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}"method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-left"></i>
                        Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade " id="modalProfile" tabindex="-1" aria-labelledby="modalProfile" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalProfile">Profile Akun</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="profile" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="profile"
                            value="{{ Auth::user()->name }}"@disabled(true)>
                    </div>
                    <div class="mb-3">
                        <label for="profile" class="form-label">Email</label>
                        <input type="text" class="form-control" id="profile"
                            value="{{ Auth::user()->email }}"@disabled(true)>
                    </div>
                    <div class="mb-3">
                        <label for="profile" class="form-label">Role</label>
                        <input type="text" class="form-control" id="profile"
                            value="{{ Auth::user()->role }}"@disabled(true)>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
