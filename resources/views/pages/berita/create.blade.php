@extends('layouts.app')
@section('content')
<style>
    .center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
  height: auto;
  border: 1px solid #acacac;
}

</style>
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
                        <a href="#">Tambah Berita</a>
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
                                            Berita *</span>
                                    </li>
                                    <small> Berita PJM</small>
                                </ul>
                            </div>
                            <div class="col-md-8 mb-3" style="float:right">
                                <form id="add_form">
                                        @csrf
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="">Judul</label>
                                            <input type="text" class="form-control" name="judul" id="judul">
                                            <div class="invalid-feedback " id='judul-error'>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label for="">Isi Berita</label>
                                            <textarea name="isi_berita" id="isi_berita" cols="30" rows="10" class="form-control"></textarea>
                                            <div class="invalid-feedback " id='isi_berita-error'>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="">Gambar Berita</label>
                                            <input type="file" class="form-control" name="image" id="image"
                                                onchange="document.getElementById('ba').src = window.URL.createObjectURL(this.files[0])">
                                            <div class="invalid-feedback " id='image-error'>

                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 mb-2">
                                            <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%221152%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%201152%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_18a6d8dfceb%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A58pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_18a6d8dfceb%22%3E%3Crect%20width%3D%221152%22%20height%3D%22250%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22409.0078125%22%20y%3D%22150.8%22%3E1152x250%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                                                id="ba" alt="your image" class="center">
                                        </div>
                                         <button type="submit" id="btn_add" class="btn btn-primary mt-5 ml-1"
                                            style="float:right;">Kirim</button>
                                        <a href="{{ route('berita.index') }}"  class="btn btn-secondary mt-5 text-white"
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

            $("#add_form").on('submit', function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    url : "{{ route('berita.store') }}",
                    data: data,
                    type: "POST",
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
                                 location = "{{ route('berita.index') }}";
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

        $('#judul').on('click', function() {
            $('#judul').removeClass('is-valid is-invalid');
        });

        $('#isi_berita').on('click', function() {
            $('#isi_berita').removeClass('is-valid is-invalid');
        });

        $('#image').on('change', function() {
            $('#image').removeClass('is-valid is-invalid');
        });

        </script>
    @endsection
