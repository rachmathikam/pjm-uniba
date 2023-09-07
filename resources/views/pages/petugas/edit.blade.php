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
                        <a href="{{ route('petugas.index') }}">{{ $data['title'] }}</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Tambah Petugas</a>
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
                                <form id="edit_form">
                                        @csrf
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="">NIP</label>
                                            <input type="text" class="form-control" name="nip" id="nip" value="{{ $petugas->nip }}">
                                            <input type="hidden" name="old_gambar" id="old_gambar" value="{{ $petugas->foto }}">
                                            <div class="invalid-feedback " id='nip-error'>

                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="{{ $petugas->email }}">
                                            <div class="invalid-feedback " id='email-error'>

                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" value="{{ $petugas->password }}">
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
                                        <label for="">Nama Petugas</label>
                                        <input type="text" class="form-control " name="name" id="name" value="{{ $petugas->name }}">
                                        <div class="invalid-feedback " id='name-error'>

                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{ $petugas->tempat_lahir }}">
                                        <div class="invalid-feedback " id='tempat_lahir-error'>

                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6" id="simple-date1">
                                        <label for="">Tanggal Lahir</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control" name="tanggal_lahir"
                                                id="tanggal_lahir" id="simpleDataInput"  value="{{ $petugas->tanggal_lahir }}">
                                            <div class="invalid-feedback" id='tanggal_lahir-error'>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="">Phone</label>
                                        <input type="text" class="form-control" name="no_telp" id="no_telp"  value="{{ $petugas->no_telp }}">
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
                                        <img src="{{ asset('assets/image/petugas')}}/{{ $petugas->foto }}"
                                            id="ba" alt="your image" width="100" height="100">
                                        <small id="after_change">Foto saat ini</small>
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
                                        <textarea name="alamat" id="alamat" class="form-control" rows="5">{{ $petugas->alamat }}</textarea>
                                        <div class="invalid-feedback " id='alamat-error'>
                                        </div>
                                        <button type="submit" id="btn_add" class="btn btn-primary mt-5 ml-1"
                                            style="float:right;">Kirim</button>
                                        <a href="{{ route('petugas.index') }}"  class="btn btn-secondary mt-5 text-white"
                                            style="float:right;"><i class="fas fa-arrow-left"></i> Kembali</a>
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
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



        <script>

            $("#edit_form").on('submit', function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    type: "PUT",
                    url : "{{ route('petugas.updated',$petugas->slug) }}",
                    data: data,
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 200) {
                          var content = {};
                            content.message = 'Data berhasil di tambah';
                            content.icon = 'fa fa-check';
			                content.title = 'Pesan Success';
                            $.notify(content,{
                                type: 'primary',
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                time: 1500,
                                delay: 1000,
			                });
                              setTimeout(function() {
                                 location = "{{ route('petugas.index') }}";
                            }, 1500)
                        }else{
                            var content = {};
			                content.title = 'Pesan Error';
                            content.message = 'Data gagal di tambah';
                            content.icon = 'fa fa-times';
                            $.notify(content,{
                                type: 'danger',
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                               delay: 1000,
	                           timer: 1000,
			                });
                             $.each(response.data, function(field, errors) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner("<strong />");
                        });
                        }
                    },
                });
            });

            $('#image').on('change', function() {
            $('#image').removeClass('is-valid is-invalid');
            $('#before_change').hide();
            $('#after_change').show();

        });

        $('#nip').on('click', function() {
            $('#nip').removeClass('is-valid is-invalid');
        });

        $('#name').on('click', function() {
            $('#name').removeClass('is-valid is-invalid');
        });

        $('#tempat_lahir').on('click', function() {
            $('#tempat_lahir').removeClass('is-valid is-invalid');
        });

        $('#tanggal_lahir').on('click', function() {
            $('#tanggal_lahir').removeClass('is-valid is-invalid');
        });

        $('#email').on('click', function() {
            $('#email').removeClass('is-valid is-invalid');
        });
        $('#no_telp').on('click', function() {
            $('#no_telp').removeClass('is-valid is-invalid');
        });
        $('#alamat').on('click', function() {
            $('#alamat').removeClass('is-valid is-invalid');
        });
        $('#password').on('click', function() {
            $('#password').removeClass('is-valid is-invalid');
        });

        </script>
    @endsection
