<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <nav class="main-nav">

                    <a href="/mahasiswa" class="logo">
                        Mari Magang
                    </a>


                    <ul class="nav">
                        <li><a href="/mahasiswa">Beranda</a></li>
                        @if(!$user->nama || !$user->kampus || !$user->jurusan || !$user->prodi || !$user->telepon)
                        @else
                        <li>
                            <a href="/pengajuan">Pengajuan Magang</a>
                        </li>
                        @endif
                        <li>
                            <a href="/logout">Logout</a>
                        </li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>

                </nav>

            </div>
        </div>
    </div>
</header>
