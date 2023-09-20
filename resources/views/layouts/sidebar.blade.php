<div class="sidebar sidebar-style-2">

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="../../assets/image/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Hizrian
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-list"></i>
                        <p>Master</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="../../demo1/index.html">
                                    <span class="sub-item">Role</span>
                                </a>
                            </li>
                            <li>
                                <a href="../../demo2/index.html">
                                    <span class="sub-item">Permission</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Petugas PJM</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('petugas.index') }}">
                        <i class="fas fa-user"></i>
                        <p>Petugas PJM</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Master</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#table" class="collapsed" aria-expanded="false">
                        <i class="fas fa-list"></i>
                        <p>Master Web Profile</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="table">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="../../demo1/index.html">
                                    <span class="sub-item">Setting Beranda</span>
                                </a>
                            </li>
                            <li>
                                <a href="../../demo2/index.html">
                                    <span class="sub-item">Setting Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="../../demo2/index.html">
                                    <span class="sub-item">SPMI & AMI</span>

                                </a>
                            </li>
                            <li>
                                <a href="../../demo2/index.html">
                                    <span class="sub-item">Dokumen</span>
                                </a>
                            </li>
                            <li>
                                <a href="../../demo2/index.html">
                                    <span class="sub-item">Setting Media</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Profile PJM</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}">
                        <i class="fas fa-database"></i>
                        <p>Kategori Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#form" class="collapsed" aria-expanded="false">
                        <i class="fas fa-tasks"></i>
                        <p>Profile PJM Uniba</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="form">
                        <ul class="nav nav-collapse">
                            @php
                                $check = \DB::table('kategori_sub_kategori')
                                    ->join('kategori', 'kategori.id', 'kategori_sub_kategori.kategori_id')
                                    ->where('kategori', 'Profile')
                                    ->first();
                            @endphp
                            @if (!empty($check))
                                <li>
                                    <a href="{{ route('profile.index') }}">
                                        <span class="sub-item">Profile</span>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('visimisi.index') }}">
                                    <span class="sub-item">Visi & Misi / Tujuan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('personalia.index') }}">
                                    <span class="sub-item">Personalia</span>

                                </a>
                            </li>
                            <li>
                                <a href="{{ route('tupoksi.index') }}">
                                    <span class="sub-item">Tupoksi PJM Uniba</span>
                                </a>
                            </li>
                            <li>
                                <a href="../../demo2/index.html">
                                    <span class="sub-item">Roadmap Penjaminan Mutu Uniba</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('divisi_pjm.index') }}">
                        <i class="fas fa-university"></i>
                        <p>Divisi PJM</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Dokumen PJM</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kategori_dokumen.index') }}">
                        <i class="fas fa-database"></i>
                        <p>Kategori Dokumen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dokumen.index') }}">
                        <i class="fas fa-folder"></i>
                        <p>Dokumen</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Media PJM</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('berita.index') }}">
                        <i class="fas fa-bullhorn"></i>
                        <p>Pengumuman</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('berita.index') }}">
                        <i class="fas fa-newspaper"></i>
                        <p>Berita</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('berita.index') }}">
                        <i class="fas fa-film"></i>
                        <p>Agenda</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('berita.index') }}">
                        <i class="fas fa-image"></i>
                        <p>Foto</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
