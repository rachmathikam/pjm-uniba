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
                                            <input type="text" class="form-control" name="judul" id="judul" value="{{ $datas->judul }}">
                                            <input type="hidden"  name="old_gambar" id="old_gambar" value="{{ $datas->gambar }}">
                                            <input type="hidden"  name="old_slug" id="old_slug" value="{{ $datas->slug }}">
                                            <div class="invalid-feedback " id='judul-error'>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label for="">Isi Berita</label>
                                            <textarea name="isi_berita" id="isi_berita" cols="30" rows="10" class="form-control">{{ $datas->judul }}</textarea>
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
                                            <img src="{{ asset('frontend_assets/image/berita') }}/{{ $datas->gambar }}"
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
                    url : "{{ route('berita.updated',$datas->slug) }}",
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
