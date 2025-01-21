<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('assets/images/admin/profile.jpeg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            @role('superadmin')
                            Admin
                            @endrole
                            @role('adminbidang')
                            Bidang {{ auth()->user()->nama }}
                            @endrole
                            <span class="user-level">Persuma</span>
                        </span>
                    </a>

                    <div class="clearfix"></div>

                </div>
            </div>

            <ul class="nav nav-primary">
                @hasanyrole('superadmin|adminbidang')
                <li class="nav-item">
                    <a href="/dashboardadmin/ {{ auth()->user()->id }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @endrole
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-user-friends"></i>
                        <p>Data Akun</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/admin">
                                    <span class="sub-item">Admin</span>
                                </a>
                            </li>
                            <li>
                                <a href="/user">
                                    <span class="sub-item">Mahasiswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="/jurusan">
                                    <span class="sub-item">Jurusan</span>
                                </a>
                            </li>
                            <li>
                                <a href="/prodi">
                                    <span class="sub-item">Prodi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @role('adminbidang')
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-laptop"></i>
                        <p>Data Bidang</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="/databidang/{{ auth()->user()->id }}">
                                    <span class="sub-item">Kelola Bidang</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endrole
                <li class="nav-item">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-book"></i>
                        <p>Data Permohonan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            @role('superadmin')
                            <li>
                                <a href="/pengajuanadmin">
                                    <span class="sub-item">Pengajuan Magang</span>
                                </a>
                            </li>
                            <li>
                                <a href="/pengajuanditeruskan">
                                    <span class="sub-item">Pengajuan Ke Bidang</span>
                                </a>
                            </li>
                            <li>
                                <a href="/pengajuanaccadmin">
                                    <span class="sub-item">Pengajuan Dikonfirmasi</span>
                                </a>
                            </li>
                            @endrole
                            @role('adminbidang')
                            <li>
                                <a href="/pengajuanbidang/{{ auth()->user()->id }}">
                                    <span class="sub-item">Pengajuan dari bidang</span>
                                </a>
                            </li>
                            @endrole
                            @role('superadmin')
                            <li>
                                <a href="/pengajuanbidangsuper">
                                    <span class="sub-item">Pengajuan dari bidang</span>
                                </a>
                            </li>
                            @endrole
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#charts">
                        <i class="far fa-chart-bar"></i>
                        <p>Data Magang</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            @role('superadmin')
                            <li>
                                <a href="/magang">
                                    <span class="sub-item">Data Magang</span>
                                </a>
                            </li>
                            @endrole
                            @role('adminbidang')
                            <li>
                                <a href="/magangbidang/{{ auth()->user()->id }}">
                                    <span class="sub-item">Data Magang</span>
                                </a>
                            </li>
                            @endrole
                        </ul>
                    </div>
                </li>
                <li class="mx-4 mt-2">
                    <a href="/logout" class="btn btn-danger btn-block"><span class="btn-label mr-2"> <i class="fas fa-sign-out-alt"></i> </span>Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>