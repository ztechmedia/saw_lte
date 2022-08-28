 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= asset('images/toga.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin SAW</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= asset('template/lte/dist/img/avatar5.png') ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $this->auth->name ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a class="side-submenu nav-link pointer dashboard" data-url="<?=base_url("admin/dashboard")?>" data-submenu=".dashboard">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-item users">
            <a class="nav-link pointer">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Akun
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="side-submenu nav-link pointer admin" data-url="<?= base_url("admin/users/1") ?>" data-menu=".users" data-submenu=".admin">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item master">
            <a class="nav-link pointer">
              <i class="nav-icon fas fa-hdd"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="side-submenu nav-link pointer criterias" data-url="<?= base_url("admin/criterias") ?>" data-menu=".master" data-submenu=".criterias">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kritetia</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="side-submenu nav-link pointer alternatives" data-url="<?= base_url("admin/alternatives") ?>" data-menu=".master" data-submenu=".alternatives">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Alternatif</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="side-submenu nav-link pointer results" data-url="<?=base_url("admin/results")?>" data-submenu=".results">
              <i class="nav-icon fas fa-check-circle"></i>
              <p>Hasil Akhir</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link pointer" onclick="resetData()">
              <i class="nav-icon fas fa-sync"></i>
              <p>Reset</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link pointer action-logout" data-url="<?= base_url("logout") ?>" data-redirect="<?= base_url("login") ?>">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>