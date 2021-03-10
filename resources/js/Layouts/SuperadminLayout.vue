<template>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a @click="logout" href="#" method="post" class="nav-link">
                <i class="fas fa-sign-out-alt"></i>
            </a>
          </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="/logo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">HIAP Inc.</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/logo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-bold">Superadministrator</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/sa/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
            <li class="nav-item">
                <inertia-link href="/sa/clients" class="nav-link">
                    <i class="nav-icon fas fa-user-friends"></i>
                    <p>
                        Clients
                    </p>
                </inertia-link>
          </li>
          <li class="nav-item">
                <inertia-link href="/sa/programs" class="nav-link">
                    <i class="nav-icon fas fa-layer-group"></i>
                    <p>
                        Programs
                    </p>
                </inertia-link>
          </li>
          <li class="nav-item">
                <inertia-link href="/sa/moderators" class="nav-link">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>
                        Moderators
                    </p>
                </inertia-link>
          </li>
          <li class="nav-item">
            <inertia-link href="/sa/teachers" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>Teachers</p>
            </inertia-link>
          </li>
          <li class="nav-item">
            <inertia-link href="/sa/school" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>Schools</p>
            </inertia-link>
          </li>
          <li class="nav-item">
            <inertia-link href="/sa/certs" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>Certificates</p>
            </inertia-link>
          </li>
          <li class="nav-item">
            <inertia-link href="/sa/staffs" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>Staffs</p>
            </inertia-link>
          </li>
          <li class="nav-item">
                <inertia-link href="/sa/logs" class="nav-link">
                    <i class="nav-icon fas fa-clipboard-list"></i>
                    <p>
                        Logs
                    </p>
                </inertia-link>
          </li>
          <!-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../../index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li> -->
            <!-- </ul>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section id="app" class="content">
        <slot />
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.4
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</template>

<script>
    export default {
        mounted () {
            document.body.classList.add('sidebar-mini');
        },
        methods: {
            logout () {
                axios.post('/logout')
                    .then((response) => {
                        document.location.replace('/');
                    })
            }
        }
    }
</script>
