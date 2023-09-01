@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title">{{ $data['title'] }}</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="#">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Base</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Sweet Alert</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <ul class="navbar-nav">
                                    <li class="nav-item mb-1">
                                        <span class="text-primary" style="cursor: pointer; font-weight:bold;">
                                            User *</span>
                                    </li>
                                    <small> Informasi User</small>
                                </ul>
                            </div>
                            <div class="col-md-8 mb-3" style="float:right">
                                <form id="add_form">
                                    <div class="row">

                                        @csrf
                                        <div class="form-group col-sm-6">
                                            <label for="">NIK</label>
                                            <input type="text" class="form-control" name="nik" id="nik">
                                            <div class="invalid-feedback " id='nik-error'>

                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" name="email" id="email">
                                            <div class="invalid-feedback " id='email-error'>

                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="">Password</label>
                                            <input type="password" class="form-control" name="password" id="password">
                                            <div class="invalid-feedback " id='password-error'>

                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <ul class="navbar-nav">
                                    <li class="nav-item mb-1">
                                        <span class="text-primary" style="cursor: pointer; font-weight:bold;">Biodata
                                            *</span>
                                    </li>
                                    <small> Informasi Biodata</small>
                                </ul>
                            </div>
                            <div class="col-md-8 mt-3" style="float:right">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="">Nama Karyawan</label>
                                        <input type="text" class="form-control " name="name" id="name">
                                        <div class="invalid-feedback " id='name-error'>

                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir">
                                        <div class="invalid-feedback " id='tempat_lahir-error'>

                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6" id="simple-date1">
                                        <label for="">Tanggal Lahir</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="tanggal_lahir"
                                                id="tanggal_lahir" id="simpleDataInput">
                                            <div class="invalid-feedback" id='tanggal_lahir-error'>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Phone</label>
                                        <input type="text" class="form-control" name="no_telp" id="no_telp">
                                        <div class="invalid-feedback " id='no_telp-error'>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-8">
                                        <label for="">Foto</label>
                                        <input type="file" class="form-control" name="image" id="image"
                                            onchange="document.getElementById('ba').src = window.URL.createObjectURL(this.files[0])">
                                        <div class="invalid-feedback " id='image-error'>

                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4 mb-2">
                                        <img src="https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg"
                                            id="ba" alt="your image" width="100" height="100">
                                        <small id="before_change">Contoh Foto</small>
                                        <small id="after_change" style="display:none;">Foto saat ini</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mt-3">
                                <ul class="navbar-nav">
                                    <li class="nav-item mb-1">
                                        <span class="text-primary" style="cursor: pointer; font-weight:bold;">Alamat
                                            *</span>
                                    </li>
                                    <small> Informasi Tentang alamat</small>
                                </ul>
                            </div>
                            <div class="col-md-8 mt-3" style="float:right">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" id="alamat" class="form-control" rows="5"></textarea>
                                        <div class="invalid-feedback " id='alamat-error'>
                                        </div>
                                        <button type="submit" id="btn_add" class="btn btn-primary mt-5"
                                            style="float:right;">Kirim</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
        <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
        <script>
            $('#multi-filter-select').DataTable({
                "pageLength": 5,

            });
        </script>
    @endsection
