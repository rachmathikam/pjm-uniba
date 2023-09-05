@extends('layouts.app')
@section('content')
    <style>
        .editInput {
            display: none;
            height: 45px;
            border: 1px solid #e0d2d2;
            border-radius: 5px;
            width: 100%;
            word-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        span.editSpan {
            overflow: hidden;
            word-wrap: break-word;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .deleteData[disabled] {
            opacity: 0.65;
            cursor: not-allowed;
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
                        <a href="#">Petugas</a>
                    </li>
                </ul>
            </div>
            {{-- button --}}
            <div class="page-break">
                <div class="row">
                    <div class="col-md-1 mr-5">
                        <button class="btn btn-primary mt-auto d-flex " onclick="displayInput()">
                            Tambah Visi-Misi /Tujuan
                        </button>
                    </div>
                    <div class="col-md-1 mr-5 ml-4">
                        <button class="btn btn-danger mt-auto d-flex deleteData" disabled>
                            Hapus Terpilih
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-warning d-flex btn-info">
                            <i class="fas fa-info" style="font-size:21px;"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row" style="display: none" id="select">
                <div class="col-md-12 mt-5">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Visi - Misi</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pilih Visi - Misi & Tujuan</label>
                                        <select name="" id="visi-misi" class="form-control"
                                            onchange="selectOption()">
                                            <option selected disabled>-- Pilih Visi / Misi --</option>
                                            <option value="visi"> Visi </option>
                                            <option value="misi"> Misi </option>
                                            <option value="tujuan"> Tujuan </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group visi" style="display: none">
                                        <label>Input Visi</label>
                                        <form id="form_visi">
                                            <div id="inputContainervisi">
                                                <button type="submit" class="btn btn-primary btn-sm ml-2">Simpan</button>
                                                <button type="button" class="btn btn-success btn-sm ml-2"
                                                    onclick="addInputVisi()">+</button>
                                                <div class="row">
                                                    <div class="form-group col-sm-5" id="simple-date1">
                                                        <label for="">Tahun Periode</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar"></i></span>
                                                            </div>
                                                            <input type="date" class="form-control" name="tanggalawal"
                                                                id="tanggalawal" id="simpleDataInput">
                                                            <div class="invalid-feedback" id='tanggalawal-error'>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <small class="ml-3"><b>Sampai</b></small>
                                                    <div class="form-group col-sm-5 ml-3" id="simple-date1">
                                                        <label for="">Tahun Periode</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar"></i></span>
                                                            </div>
                                                            <input type="date" class="form-control" name="tanggalakhir"
                                                                id="tanggalakhir" id="simpleDataInput">
                                                            <div class="invalid-feedback" id='tanggalakhir-error'>
                                                                <input type="hidden" value="visi" name="kategori">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <div class="dynamic-inputs-container">
                                                            <div class="input-group" id="input-group-visi">
                                                                <input type="text" class="form-control" name="visi[]"
                                                                    id="visi" placeholder="masukkan visi..">
                                                                <div class="input-group-append">
                                                                    <button type="button"
                                                                        class="btn btn-danger remove-input" disabled><i
                                                                            class="fas fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="form-group misi" style="display: none">
                                        <label>Input Misi</label>
                                        <form id="form_misi">
                                            <div id="inputContainermisi">
                                                <button type="submit" class="btn btn-primary btn-sm ml-2">Simpan</button>
                                                <button type="button" class="btn btn-success btn-sm ml-2"
                                                    onclick="addInputMisi()">+</button>
                                                <div class="row">
                                                    <div class="form-group col-sm-5" id="simple-date1">
                                                        <label for="">Tahun Periode</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar"></i></span>
                                                            </div>
                                                            <input type="date" class="form-control" name="tanggalawal"
                                                                id="tanggalawal" id="simpleDataInput">
                                                            <div class="invalid-feedback" id='tanggalawal-error'>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <small class="ml-3"><b>Sampai</b></small>
                                                    <div class="form-group col-sm-5 ml-3" id="simple-date1">
                                                        <label for="">Tahun Periode</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar"></i></span>
                                                            </div>
                                                            <input type="date" class="form-control"
                                                                name="tanggalakhir" id="tanggalakhir"
                                                                id="simpleDataInput">
                                                            <div class="invalid-feedback" id='tanggalakhir-error'>
                                                                <input type="hidden" value="misi" name="kategori">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <div class="dynamic-inputs-container">
                                                            <div class="input-group" id="input-group-misi">
                                                                <input type="text" class="form-control" name="misi[]"
                                                                    id="misi" placeholder="masukkan misi..">
                                                                <div class="input-group-append">
                                                                    <button type="button"
                                                                        class="btn btn-danger remove-input" disabled><i
                                                                            class="fas fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="form-group tujuan" style="display: none">
                                        <label>Input Tujuan</label>
                                        <form id="form_tujuan">
                                            <div id="inputContainertujuan">
                                                <button type="submit" class="btn btn-primary btn-sm ml-2">Simpan</button>
                                                <button type="button" class="btn btn-success btn-sm ml-2"
                                                    onclick="addInputTujuan()">+</button>
                                                <div class="row">
                                                    <div class="form-group col-sm-5" id="simple-date1">
                                                        <label for="">Tahun Periode</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar"></i></span>
                                                            </div>
                                                            <input type="date" class="form-control" name="tanggalawal"
                                                                id="tanggalawal" id="simpleDataInput">
                                                            <div class="invalid-feedback" id='tanggalawal-error'>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <small class="ml-3"><b>Sampai</b></small>
                                                    <div class="form-group col-sm-5 ml-3" id="simple-date1">
                                                        <label for="">Tahun Periode</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-calendar"></i></span>
                                                            </div>
                                                            <input type="date" class="form-control"
                                                                name="tanggalakhir" id="tanggalakhir"
                                                                id="simpleDataInput">
                                                            <div class="invalid-feedback" id='tanggalakhir-error'>
                                                                <input type="hidden" value="tujuan" name="kategori">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-12">
                                                        <div class="dynamic-inputs-container">
                                                            <div class="input-group" id="input-group-tujuan">
                                                                <input type="text" class="form-control"
                                                                    name="tujuan[]" id="tujuan"
                                                                    placeholder="masukkan tujuan..">
                                                                <div class="input-group-append">
                                                                    <button type="button"
                                                                        class="btn btn-danger remove-input" disabled><i
                                                                            class="fas fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table">
                            <thead>
                                <tr>
                                    @if ($visiMisi->isEmpty())
                                        <th style="width: 10%"><input type="checkbox" id="select_all_ids"
                                                class="ml-3 mt-2 checkbox-item" disabled></th>
                                    @else
                                        <th style="width: 10%"><input type="checkbox" id="select_all_ids"
                                                class="ml-3 mt-2 checkbox-item"></th>
                                    @endif
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="add_new">
                                @php $no = 1 @endphp
                                @foreach ($visiMisi as $data)
                                    <tr id="data{{ $data->id }}">
                                        <td><input type="checkbox" name="ids" class="checkbox_ids ml-3 checkbox-item"
                                                value="{{ $data->id }}">
                                        <td>
                                            <span class="editSpan kategori" id="spanKategori">{{ $data->kategori }}</span>
                                            <select name="kategori" id="InputKategori" class=" editInput kategori"
                                                style="display: none;">
                                                @if ($data->kategori == 'visi')
                                                    <option selected value="visi">visi</option>
                                                    <option value="misi">misi</option>
                                                    <option value="tujuan">tujuan</option>
                                                @elseif($data->kategori == 'visi')
                                                    <option value="visi">visi</option>
                                                    <option selected value="misi">misi</option>
                                                    <option value="tujuan">tujuan</option>
                                                @else
                                                    <option value="visi">visi</option>
                                                    <option valiue="misi">misi</option>
                                                    <option selected value="tujuan">tujuan</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <span class="editSpan deskripsi"> {{ $data->deskripsi }}</span>
                                            <input type="text" class="editInput deskripsi" name="deskripsi"
                                                value="{{ $data->deskripsi }}">
                                        </td>
                                        <td>
                                            {{ $data->status }}
                                        </td>
                                        <td>
                                            <button class="btn text-warning btn-sm edit_inline"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn text-black btnSave btn-sm" style="display: none"><i
                                                    class="fa fa-check"></i></button>
                                            <button class="btn text-danger editCancel btn-sm" style="display: none"><i
                                                    class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles" />
    <script>
        function displayInput() {
            $('#select').toggle();
        }

        $('#multi-filter-select').DataTable({
            "pageLength": 5,
            "ordering": false,
        });

        function selectOption() {
            data = $('#visi-misi').val();
            if (data == "visi") {
                $('.visi').show();
                $('.misi').hide();
                $('.tujuan').hide();
            } else if (data == "misi") {
                $('.misi').show();
                $('.visi').hide();
                $('.tujuan').hide();

            } else {
                $('.tujuan').show();
                $('.misi').hide();
                $('.visi').hide();
            }
        }

        function removeInput(element) {
            var inputGroup = $(element).closest('.input-group');
            if (inputGroup.parent().is(':nth-child(1)')) {
                // Prevent removing the first input
                alert('Cannot remove the first input!');
            } else {
                inputGroup.parent().remove();
            }
        }

        function addInputTujuan() {
            var html = '<div class="form-group col-12">' +
                '<div class="input-group">' +
                '<input type="text" class="form-control" name="tujuan[]" placeholder="masukkan tujuan...">' +
                '<div class="input-group-append">' +
                '<button type="button" class="btn btn-danger remove-input" onclick="removeInput(this)"><i class="fas fa-times"></i></button>' +
                '</div>' +
                '</div>' +
                '</div>';
            $('#inputContainertujuan').append(html);

        }

        function addInputVisi() {
            var html = '<div class="row">' +
                '<div class="form-group col-12">' +
                '<div class="input-group">' +
                '<input type="text" class="form-control" name="visi[]" placeholder="masukkan visi...">' +
                '<div class="input-group-append">' +
                '<button type="button" class="btn btn-danger remove-input" onclick="removeInput(this)"><i class="fas fa-times"></i></button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';

            $('#inputContainervisi').append(html);
        }

        function addInputMisi() {
            var html = '<div class="form-group col-12">' +
                '<div class="input-group">' +
                '<input type="text" class="form-control" name="misi[]" placeholder="masukkan misi...">' +
                '<div class="input-group-append">' +
                '<button type="button" class="btn btn-danger remove-input" onclick="removeInput(this)"><i class="fas fa-times"></i></button>' +
                '</div>' +
                '</div>' +
                '</div>';

            $('#inputContainermisi').append(html);
        }

        $(".btn-info").on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                text: "Visi Misi akan di publish jika telah di checklist !",
                icon: 'info',
            })
        });

        $('#form_visi').submit(function() {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('tambah.visi') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(response) {
                    var html = '';
                    var no = 1;
                    if (response.status == 200) {
                        $(".checkbox-item").attr('disabled', false);
                        $('.table tbody').children().remove();
                        var content = {};
                        content.message = 'Data berhasil di tambah';
                        content.icon = 'fa fa-check';
                        content.title = 'Pesan Success';
                        $.notify(content, {
                            type: 'primary',
                            placement: {
                                from: "top",
                                align: "right",
                            },
                            time: 1500,
                            delay: 1000,
                        });
                        $.each(response.data, function(key, value) {
                            html += `<tr id="data${value.id}">
                                        <td><input type="checkbox" name="ids"
                                            class="checkbox_ids ml-3 checkbox-item"  value="${value.id}">
                                        <td>
                                            <span class="editSpan kategori" id="spanKategori">${value.kategori}</span>
                                            <select name="kategori" id="InputKategori" class=" editInput kategori"
                                                style="display: none;">
                                                    <option selected value="visi">visi</option>
                                                    <option value="misi">misi</option>
                                                    <option value="tujuan">tujuan</option>
                                            </select>
                                        </td>
                                        <td>
                                            <span class="editSpan deskripsi"> ${value.deskripsi}</span>
                                            <input type="text" class="editInput deskripsi" name="deskripsi"
                                                value="${value.deskripsi}">
                                        </td>
                                        <td>
                                            <button class="btn text-warning btn-sm edit_inline"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn text-black btnSave btn-sm" style="display: none"><i
                                                    class="fa fa-check"></i></button>
                                            <button class="btn text-danger editCancel btn-sm" style="display: none"><i
                                                    class="fa fa-times"></i></button>
                                        </td>
                                    </tr>`;
                        });
                        $('#add_new').append(html);
                        $("#inputContainervisi").children().remove();
                        var html = `<div id="inputContainervisi">
                                                <button type="submit" class="btn btn-primary btn-sm ml-2">Simpan</button>
                                                <button type="button" class="btn btn-success btn-sm ml-2"
                                                    onclick="addInputVisi()">+</button>
                                                <div class="form-group col-12">
                                                    <div class="dynamic-inputs-container">
                                                        <div class="input-group" id="input-group-visi">
                                                            <input type="text" class="form-control" name="visi[]"
                                                                id="visi" placeholder="masukkan visi..">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-danger remove-input"
                                                                    disabled><i class="fas fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`;

                        $('#inputContainervisi').append(html);
                    } else {
                        var content = {};
                        content.message = response.errors;
                        content.icon = 'fa fa-times';
                        content.title = 'Pesan Error';
                        $.notify(content, {
                            type: 'danger',
                            placement: {
                                from: "top",
                                align: "right",
                            },
                            time: 1500,
                            delay: 1000,
                        });
                    }
                }
            });
        });

        $('#form_misi').submit(function() {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('tambah.misi') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(response) {
                    $(".checkbox-item").attr('disabled', false);
                    $('.table tbody').children().remove();
                    var html = '';
                    var no = 1;
                    if (response.status == 200) {
                        var content = {};
                        content.message = 'Data berhasil di tambah';
                        content.icon = 'fa fa-check';
                        content.title = 'Pesan Success';
                        $.notify(content, {
                            type: 'primary',
                            placement: {
                                from: "top",
                                align: "right",
                            },
                            time: 1500,
                            delay: 1000,
                        });
                        $.each(response.data, function(key, value) {
                            html += `<tr id="data${value.id}">
                                         <td><input type="checkbox" name="ids"
                                            class="checkbox_ids ml-3 checkbox-item"  value="${value.id}">
                                        <td>
                                            <span class="editSpan kategori" id="spanKategori">${value.kategori}</span>
                                            <select name="kategori" id="InputKategori" class=" editInput kategori"
                                                style="display: none;">
                                                    <option  value="visi">visi</option>
                                                    <option selected value="misi">misi</option>
                                                    <option value="tujuan">tujuan</option>
                                            </select>
                                        </td>
                                        <td>
                                            <span class="editSpan deskripsi"> ${value.deskripsi}</span>
                                            <input type="text" class="editInput deskripsi" name="deskripsi"
                                                value="${value.deskripsi}">
                                        </td>
                                        <td>
                                            <button class="btn text-warning btn-sm edit_inline"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn text-black btnSave btn-sm" style="display: none"><i
                                                    class="fa fa-check"></i></button>
                                            <button class="btn text-danger editCancel btn-sm" style="display: none"><i
                                                    class="fa fa-times"></i></button>
                                        </td>
                                    </tr>`;
                        });
                        $('#add_new').append(html);
                        $("#inputContainermisi").children().remove();
                        var html = `<div id="inputContainermisi">
                                                <button type="submit" class="btn btn-primary btn-sm ml-2">Simpan</button>
                                                <button type="button" class="btn btn-success btn-sm ml-2"
                                                    onclick="addInputmisi()">+</button>
                                                <div class="form-group">
                                                    <div class="dynamic-inputs-container">
                                                        <div class="input-group" id="input-group-misi">
                                                            <input type="text" class="form-control" name="misi[]"
                                                                id="misi" placeholder="masukkan misi..">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-danger remove-input"
                                                                    disabled><i class="fas fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`;

                        $('#inputContainermisi').append(html);
                    } else {
                        var content = {};
                        content.message = response.errors;
                        content.icon = 'fa fa-times';
                        content.title = 'Pesan Error';
                        $.notify(content, {
                            type: 'danger',
                            placement: {
                                from: "top",
                                align: "right",
                            },
                            time: 1500,
                            delay: 1000,
                        });
                    }
                }
            });
        });

        $('#form_tujuan').submit(function() {
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{ route('tambah.tujuan') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function(response) {
                    $(".checkbox-item").attr('disabled', false);
                    $('.table tbody').children().remove();
                    var html = '';
                    var no = 1;
                    if (response.status == 200) {
                        var content = {};
                        content.message = 'Data berhasil di tambah';
                        content.icon = 'fa fa-check';
                        content.title = 'Pesan Success';
                        $.notify(content, {
                            type: 'primary',
                            placement: {
                                from: "top",
                                align: "right",
                            },
                            time: 1500,
                            delay: 1000,
                        });
                        $.each(response.data, function(key, value) {
                            html += `<tr id="data${value.id}">
                                        <td><input type="checkbox" name="ids"
                                            class="checkbox_ids ml-3 checkbox-item"  value="${value.id}">
                                        <td>
                                            <span class="editSpan kategori" id="spanKategori">${value.kategori}</span>
                                            <select name="kategori" id="InputKategori" class=" editInput kategori"
                                                style="display: none;">
                                                    <option  value="visi">visi</option>
                                                    <option  value="misi">misi</option>
                                                    <option selected value="tujuan">tujuan</option>
                                            </select>
                                        </td>
                                        <td>
                                            <span class="editSpan deskripsi"> ${value.deskripsi}</span>
                                            <input type="text" class="editInput deskripsi" name="deskripsi"
                                                value="${value.deskripsi}">
                                        </td>
                                        <td>
                                            <button class="btn text-warning btn-sm edit_inline"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn text-black btnSave btn-sm" style="display: none"><i
                                                    class="fa fa-check"></i></button>
                                            <button class="btn text-danger editCancel btn-sm" style="display: none"><i
                                                    class="fa fa-times"></i></button>
                                        </td>
                                    </tr>`;
                        });
                        $('#add_new').append(html);
                        $("#inputContainertujuan").children().remove();
                        var html = `<div id="inputContainertujuan">
                                                <button type="submit" class="btn btn-primary btn-sm ml-2">Simpan</button>
                                                <button type="button" class="btn btn-success btn-sm ml-2"
                                                    onclick="addInputTujuan()">+</button>
                                                <div class="form-group">
                                                    <div class="dynamic-inputs-container">
                                                        <div class="input-group" id="input-group-tujuan">
                                                            <input type="text" class="form-control" name="tujuan[]"
                                                                id="tujuan" placeholder="masukkan tujuan..">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-danger remove-input"
                                                                    disabled><i class="fas fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`;

                        $('#inputContainertujuan').append(html);
                    } else {
                        var content = {};
                        content.message = response.errors;
                        content.icon = 'fa fa-times';
                        content.title = 'Pesan Error';
                        $.notify(content, {
                            type: 'danger',
                            placement: {
                                from: "top",
                                align: "right",
                            },
                            time: 1500,
                            delay: 1000,
                        });
                    }
                }
            });
        });





        $(document).on('click', '.deleteData', function() {
            var ID = $(this).closest("tr").attr("id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            });
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Do you want to delete ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('petugas.delete') }}",
                            type: "POST",
                            data: {
                                ids: ID,
                            },
                            success: function(response) {
                                var content = {};
                                content.message = response.message;
                                content.icon = 'fa fa-check';
                                content.title = 'Pesan Success';
                                $.notify(content, {
                                    type: 'primary',
                                    placement: {
                                        from: "top",
                                        align: "right",
                                    },
                                    time: 1500,
                                    delay: 1500,
                                });

                                var datas = $('#data' + response.data);
                                datas.remove();
                            }
                        });
                    }
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'Cancelled',
                        'Data is not deleted',
                        'error'
                    )
                }
            });
        });

        $("#add_new").on('click', '.edit_inline', function() {
            var btn = $(this);
            btn.closest("tr").find(".edit_inline").hide();

            $(this).closest("tr").find(".editSpan").hide();
            $(this).closest("tr").find(".editInput").show();
            $(this).closest("tr").find(".editCancel").show();
            $(this).closest("tr").find(".edit_inline").hide();
            $(this).closest("tr").find(".btnSave").show();
        });

        $("#add_new").on('click', '.editCancel', function(e) {
            e.preventDefault();

            $(this).closest("tr").find(".editSpan").show(); // mencari
            $(this).closest("tr").find(".editInput").hide();

            $(this).closest("tr").find(".edit_inline").show();
            $(this).closest("tr").find(".editCancel").hide();

            $(this).closest("tr").find(".btnSave").hide();
        });


        $("#add_new").on("click", '.btnSave', function(e) {
            e.preventDefault();
            var trObj = $(this).closest("tr");
            var ID = $(this).closest("tr").attr('id');

            var inputData = $(this).closest("tr").find(".editInput").serialize();
            console.log(inputData);
            $.ajax({
                type: "POST",
                url: "{{ route('edit.visimisi') }}",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'action=edit&id=' + ID + '&' + inputData,
                success: function(response) {
                    if (response.status == 200) {
                        var content = {};
                        content.message = response.message;
                        content.icon = 'fa fa-check';
                        content.title = 'Pesan Success';
                        $.notify(content, {
                            type: 'primary',
                            placement: {
                                from: "top",
                                align: "right",
                            },
                            time: 1500,
                            delay: 1500,
                        });
                        trObj.find(".editSpan.kategori").text(response.data.kategori);
                        trObj.find(".editInput.kategori").val(response.data.kategori);
                        trObj.find(".editSpan.deskripsi").text(response.data.deskripsi);
                        trObj.find(".editInput.deskripsi").val(response.data.deskripsi);
                        trObj.find(".editInput").hide();
                        trObj.find(".editSpan").show();
                        trObj.find(".btnSave").hide();
                        trObj.find(".editCancel").hide();
                        trObj.find(".edit_inline").show();
                    }
                }
            });
        });

        $(document).on('change', '.checkbox-item', function() {
            var anyChecked = $('.checkbox-item:checked').length > 0;
            $('.deleteData').prop('disabled', !anyChecked);
        });

        $(document).on('change', '.checkbox_ids', function() {
            var anyChecked = $('.checkbox_ids:checked').length > 0;
            console.log(anyChecked);
            $('.deleteData').prop('disabled', !anyChecked);
            if (anyChecked == 0) {
                $('#select_all_ids').prop('checked', false);
            }

        });



        $("#select_all_ids").click(function() {
            $('.checkbox_ids').prop('checked', $(this).prop('checked'));
        });



        $(document).on('click', '.deleteData', function() {
            var all_ids = [];
            $('input:checkbox[name=ids]:checked').each(function() {
                all_ids.push($(this).val());
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            });
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Do you want to delete ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('visimisi.delete') }}",
                            type: "POST",
                            data: {
                                ids: all_ids,
                            },
                            success: function(response) {
                                var content = {};
                                content.message = response.message;
                                content.icon = 'fa fa-check';
                                content.title = 'Pesan Success';
                                $.notify(content, {
                                    type: 'primary',
                                    placement: {
                                        from: "top",
                                        align: "right",
                                    },
                                    time: 1500,
                                    delay: 1000,
                                });
                                if (response.select == 'disabled') {
                                    $(".checkbox-item").prop("checked", false);
                                    $('.deleteData').prop('disabled', true);
                                    $(".checkbox-item").attr('disabled', true);

                                } else if (response.select == 'ada') {
                                    $('.deleteData').prop('disabled', true);
                                    $("#select_all_ids").prop("checked", false);
                                }
                                $.each(all_ids, function(key, val) {
                                    var datas = $('#data' + val);
                                    datas.remove();
                                });
                            }
                        });
                    }
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swal.fire(
                        'Cancelled',
                        'Data is not deleted',
                        'error'
                    )
                }
            });
        });
    </script>
@endsection
