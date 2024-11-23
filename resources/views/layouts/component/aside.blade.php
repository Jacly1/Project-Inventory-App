<?php
function set_active($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
        <img src="{{asset('assets/dist/img/Arcia.png')}}"
            alt="Arcia Logo"

            class="brand-image img-circle elevation-3"

            style="opacity: .8">
        <span class="brand-text font-weight-light">Arcia Inventory</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview" role="menu" data-accordion="false">

                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{url('dashboard')}}" class="nav-link {{set_active('dashboard')}}">

                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                </li>

                <li class="nav-header">Manage Accesability</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">



                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Accessability
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @canany(['create-role', 'edit-role', 'delete-role'])

                        <li class="nav-item">
                            <a href="{{url('roles')}}"

                                class="nav-link {{set_active('roles')}}">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Management Roles</p>
                            </a>
                        </li>
                        @endcanany
                        @canany(['create-user', 'edit-user', 'delete-user'])

                        <li class="nav-item">
                            <a href="{{url('users')}}"

                                class="nav-link {{set_active('users')}}">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Management Users</p>
                            </a>
                        </li>
                        @endcanany
                    </ul>
                </li>




                <li class="nav-header">Inventory</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">



                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Manage Inventory
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @canany(['create-masuk', 'edit-masuk', 'delete-masuk'])

                        <li class="nav-item">
                            <a href="{{url('masukbahan')}}"

                                class="nav-link {{set_active('masuk')}}">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Manage Barang Masuk</p>
                            </a>
                        </li>
                        @endcanany
                        @canany(['create-stok', 'edit-stok', 'delete-stok', 'show-stok'])

                        <li class="nav-item">
                            <a href="{{url('stokbahan')}}"

                                class="nav-link {{set_active('stok')}}">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Manage Stok</p>
                            </a>
                        </li>
                        @endcanany
                        @canany(['create-keluar', 'edit-keluar', 'delete-keluar'])

                        <li class="nav-item">
                            <a href="{{url('keluarproduk')}}"

                                class="nav-link {{set_active('keluar')}}">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Manage Barang Keluar</p>
                            </a>
                        </li>
                        @endcanany
                    </ul>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">



                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @canany(['show-laporan'])

                        <li class="nav-item">
                            <a href="{{url('laporan/penggunaan')}}"

                                class="nav-link {{set_active('laporan/penggunaan')}}">

                                <p>Laporan Penggunaan</p>
                            </a>
                        </li>
                        @endcanany
                        @canany(['show-laporan'])

                        <li class="nav-item">
                            <a href="{{url('laporan/stok')}}"

                                class="nav-link {{set_active('laporan/stok')}}">

                                <p>Laporan Stok</p>
                            </a>
                        </li>
                        @endcanany

                        @canany(['show-laporan'])

                        <li class="nav-item">
                            <a href="{{url('laporan/kartustok')}}"

                                class="nav-link {{set_active('laporan/kartustok')}}">

                                <p>Laporan Kartu Stok</p>
                            </a>
                        </li>
                        @endcanany
                    </ul>
                </li>




                <li class="nav-header">Exit</li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();

document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="nav-icon fas fa-file-export"></i>



                        <p>
                            {{ __('Logout') }}
                            <span class="right badge badge-danger"></span>
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>