@extends('layouts.app')
@section('content')
    <style>
        .editInput {
            display: none;
            height: 45px;
            border: 1px solid #e0d2d2;
            border-radius: 5px;
            width: 100%;
            height: 45px;
        }


        .deleteData[disabled] {
            opacity: 0.65;
            cursor: not-allowed;
        }

        #select_all_ids[disabled] {
            opacity: 0.65;
            cursor: not-allowed;
        }

        select option{
        /* background-color: white; */
        color: black;
        }
        .center{
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, 10%);
        }

        .di_terima{
        background-color:#28a745;
        }
        .pending{
            background-color:#FFC107;
        }

        .status{
            width: 100px;
            border: none;
            height: 50px;
            border-radius: 5px;
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
                        <a href="#">Divisi PJM</a>
                    </li>
                </ul>
            </div>

            <div class="filter form-group">
                <label for="">Filter Divisi</label>
                <select name="filter_divisi" id="filter_divisi" class="form-control col-2">
                        <option selected disabled>Filter By Divisi</option>
                        @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                        @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#exampleModal">
                                + Tambah Devisi Eksplorasi Data PJM
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#tambah_pengurus">
                                + Tambah Pengurus Devisi Eksplorasi Data PJM
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#pengurus_personalia"  data-target=".bd-example-modal-lg">
                                 Data Pengurus Devisi Eksplorasi Data PJM
                            </button>
                            <button class="btn btn-sm btn-danger deleteData" disabled><i class="fas fa-trash"></i> Hapus
                                Terpilih</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table  table-hover">
                                    <thead>
                                        <tr>
                                            @if ($divisi_pjm->isEmpty())
                                                <th style="width: 10%"><input type="checkbox" id="select_all_ids"
                                                        class="ml-3 mt-2 checkbox-item" disabled></th>
                                            @else
                                                <th style="width: 10%"><input type="checkbox" id="select_all_ids"
                                                        class="ml-3 mt-2 checkbox-item"></th>
                                            @endif
                                            <th>Kategori</th>
                                            <th>Tugas Divisi PJM Berdasarkan Kategori</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="add_new">
                                        @foreach ($lol as $data)
                                            <tr id="data{{ $data['id'] }}">
                                                <td><input type="checkbox" name="ids"
                                                        class="checkbox_ids ml-3 checkbox-item" value="{{ $data['id'] }}">
                                                </td>
                                                <td>
                                                    <span class="editSpan kategori_sub_kategori_id">{{$data['kategori'] }} -
                                                        {{$data['sub_kategori'] }}</span>
                                                    <select name="kategori_sub_kategori_id"
                                                        class="form-control editInput kategori_sub_kategori_id mb-2">
                                                        @foreach ($kategori as $item)
                                                            <option value="{{ $item->id }}">{{ $item->kategori }} -
                                                                {{ $item->sub_kategori }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <span class="editSpan deskripsi"> {{ $data['deskripsi'] }}</span>
                                                    <input type="text" class="editInput deskripsi form-control" onclick="test({{ $data['id'] }})"
                                                        id="divisi_pjm_edit{{ $data['id'] }}" name="divisi_pjm_edit"
                                                        value="{{ $data['deskripsi'] }}">
                                                    <div class="invalid-feedback" id="divisi_pjm_edit-error">

                                                    </div>
                                                </td>
                                                <td>
                                                    <select name="status" id="status{{ $data['id'] }}" class="status text-center" onchange="status({{ $data['id'] }})" style="background-color: {{ $data['color'] }}; color:white;">
                                                        @if($data['status'] == 'publish')
                                                            <option selected value="publish">Publish</option>
                                                            <option value="non_publish">No Publish</option>
                                                        @else
                                                        <option  value="publish">Publish</option>
                                                        <option selected value="non_publish">No Publish</option>
                                                        @endif
                                                    </select>
                                                </td>
                                                <td style="width: 15%">
                                                    <button class="btn text-warning btn-sm edit_inline"><i
                                                            class="fa fa-edit"></i></button>
                                                    <button class="btn text-black btnSave btn-sm" style="display: none"><i
                                                            class="fa fa-check"></i></button>
                                                    <button class="btn text-danger editCancel btn-sm" onclick="editCancel({{ $data['id'] }})"
                                                        style="display: none"><i class="fa fa-times"></i></button>
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
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilih Master Kategori</label>
                            <select name="kategori_sub_kategori_id" id="kategori_sub_kategori_id" class="form-control mb-2">
                                <option selected disabled>-- Pilih Master Kategori --</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori }} - {{ $item->sub_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="kategori_sub_kategori_id-error">

                            </div>

                        </div>
                        <div class="form-group">
                            <label for="divisi_pjm">Isi</label>
                            <textarea name="divisi_pjm" id="divisi_pjm" rows="3" class="form-control"></textarea>
                            <div class="invalid-feedback" id="divisi_pjm-error">

                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Tambah Modal Pengurus  Divisi PJM  -->
    <div class="modal fade" id="tambah_pengurus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah Pengurus Divisi PJM Uniba</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_form_pengurus" class="row">
                        @csrf
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> Kategori</label>
                            <select name="kategori_sub_kategori_id" id="kategori_sub_kategori_id_pengurus"
                                class="form-control kategori_sub_kategori_id mb-2">
                                <option selected disabled>-- Kategori --</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->sub_kategori }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="kategori_sub_kategori_id_pengurus-error">

                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama_pengurus">Nama Pengurus</label>
                            <input name="nama_pengurus" id="nama_pengurus" class="form-control">
                            <div class="invalid-feedback" id="nama_pengurus-error">

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="jabatan">Jabatan</label>
                            <input name="jabatan" id="jabatan" class="form-control">
                            <div class="invalid-feedback" id="jabatan-error">

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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- End Modal -->

    <!-- Modal Data Pengurus divisi -->
    <div class="modal fade bd-example-modal-xl" id="pengurus_personalia" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content center" style="width: 1280px;">
                <div class="modal-header">
                    <h5>Data Pengurus Divisi PJM Uniba</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="filter form-group">
                    <label for="">Filter Pengurus Divisi</label>
                    <select name="filter_pengurus" id="filter_pengurus" class="form-control col-2">
                            <option selected disabled>Filter Pengurus By Divisi</option>
                            @foreach ($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select1" class="display table  table-hover">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Pengurus Divisi PJM</th>
                                        <th>Jabatan</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="add_new_pengurus">
                                    @foreach ($pengurus_divisi as $data)
                                        <tr id="data_pengurus{{ $data->id }}">
                                            <td>
                                                <span class="editSpan kategori_sub_kategori_id">{{ $data->kategori }} -
                                                    {{ $data->sub_kategori }}</span>
                                                <select name="kategori_sub_kategori_id"
                                                    class="form-control editInput kategori_sub_kategori_id mb-2">
                                                    @foreach ($kategori as $item)
                                                        <option value="{{ $item->id }}">{{ $item->kategori }} -
                                                            {{ $item->sub_kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <span class="editSpan nama"> {{ $data->nama }}</span>
                                                <input type="text" class="editInput nama"  name="personalia"
                                                    value="{{ $data->nama }}">
                                            </td>
                                            <td>
                                                <span class="jabatan"> {{ $data->jabatan }}</span>

                                            </td>
                                            <td><img src="{{ asset('assets/image/pengurus_divisi') }}/{{ $data->foto }}"
                                                    width="100"></td>
                                            <td style="width: 20%">
                                                <button class="btn text-warning btn-sm edit_inline"><i
                                                        class="fa fa-edit"></i></button>
                                                <button class="btn text-danger btn-sm"
                                                    onclick="PengurusDelete({{ $data->id }})"><i
                                                        class="fa fa-trash"></i></button>

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
    </div>
    <!-- End Modal -->


    <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles" />
    <script>

        $('#multi-filter-select').DataTable({
            "pageLength": 5,
            "ordering": false,
        });
        $('#multi-filter-select1').DataTable({
            "pageLength": 10,
            "ordering": false,
        });

        $("#filter_pengurus").on('change', function() {
            data = $(this).val();
            $.ajax({
                url: "{{ route('pengurus_divisi_pjm.filter') }}",
                data: {data: data},
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var html = '';
                    $('#add_new_pengurus').children().remove();
                    if (response.status == 200) {
                        $.each(response.data, function(key, value) {
                            html += `<tr id="data${value.id}">
                                        <td>
                                            <span>${value.kategori} - ${value.sub_kategori}</span>

                                            </td>
                                        <td>
                                            <span>${value.nama}</span>

                                        </td>
                                        <td>
                                            <span class="jabatan">${value.jabatan}</span>

                                        </td>
                                        <td><img src="{{ asset('assets/image/pengurus_divisi') }}/${value.foto}"
                                            width="100"></td>
                                        <td style="width: 20%">
                                            <button class="btn text-warning btn-sm edit_inline"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn text-danger btn-sm" onclick="PengurusDelete(${value.id})"><i
                                                class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>`;
                        });

                        $("#add_new_pengurus").append(html);
                    }else{
                        html = response.data;
                        $("#add_new_pengurus").append(html);
                    }
                }
            });
        });

        $("#filter_divisi").on('change', function() {
            data = $(this).val();
            $.ajax({
                url: "{{ route('divisi_pjm.filter') }}",
                data: {data: data},
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#add_new').children().remove();
                    var html = '';
                    if (response.status == 200) {

                            html += response.data;


                        $("#add_new").append(html);

                    }else{
                        html = response.data;
                        $("#add_new").append(html);
                    }
                }
            });
        });

        $("#add_form_pengurus").on('submit', function(e) {
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: "{{ route('pengurus_divisi_pjm.store') }}",
                data: data,
                type: "POST",
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.status == 200) {
                        $('.modal').modal('hide');
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
                        $('#add_new_pengurus').children().remove();
                        var html = '';
                        $.each(response.data, function(key, value) {
                            html += `<tr id="data${value.id}">
                                        <td>
                                            <span>${value.kategori} - ${value.sub_kategori}</span>

                                            </td>
                                        <td>
                                            <span>${value.nama}</span>

                                        </td>
                                        <td>
                                            <span class="jabatan">${value.jabatan}</span>

                                        </td>
                                        <td><img src="{{ asset('assets/image/pengurus_divisi') }}/${value.foto}"
                                            width="100"></td>
                                        <td style="width: 20%">
                                            <button class="btn text-warning btn-sm edit_inline"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn text-danger btn-sm" onclick="PengurusDelete(${value.id})"><i
                                                class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>`;
                        });
                        var select = $("#kategori_sub_kategori_id_pengurus");
                        select.find('option:not(:first-child)').remove();
                        $.each(response.select, function(key, value) {
                            $("#kategori_sub_kategori_id_pengurus").append($('<option>', {
                                value: value.id,
                                text: value.sub_kategori
                            }));
                        });

                        $("#kategori_sub_kategori_id_pengurus").append(select);
                        $('#add_new_pengurus').append(html);
                        $("#add_form_pengurus")[0].reset();

                    } else {
                        var content = {};
                        content.title = 'Pesan Error';
                        content.message = 'Data gagal di tambah';
                        content.icon = 'fa fa-times';
                        $.notify(content, {
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



        $("#add_form").on('submit', function(e) {
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: "{{ route('divisi_pjm.store') }}",
                data: data,
                type: "POST",
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    $('#add_new').children().remove();
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

                        html = response.data;

                       $("#add_new").append(html);

                    } else {
                        var content = {};
                        content.title = 'Pesan Error';
                        content.message = 'Data gagal di tambah';
                        content.icon = 'fa fa-times';
                        $.notify(content, {
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
            data_id = ID.split("data");
            var inputData = $(this).closest("tr").find(".editInput").serialize();
            $.ajax({
                type: "POST",
                url: "{{ route('divisi_pjm.updated') }}",
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

                        trObj.find(".editSpan.deskripsi").text(response.data.deskripsi);
                        trObj.find(".editInput.deskripsi").val(response.data.deskripsi);
                        trObj.find(".editSpan.kategori_sub_kategori_id").text(response.data
                            .kategori_sub_kategori_id);

                        trObj.find(".editInput").hide();
                        trObj.find(".editSpan").show();
                        trObj.find(".btnSave").hide();
                        trObj.find(".editCancel").hide();
                        trObj.find(".edit_inline").show();

                    } else {
                        var content = {};
                        content.title = 'Pesan Error';
                        content.message = 'Data gagal di tambah';
                        content.icon = 'fa fa-times';
                        $.notify(content, {
                            type: 'danger',
                            placement: {
                                from: "top",
                                align: "right",
                            },
                            delay: 1000,
                            timer: 1000,
                        });
                        $.each(response.data, function(field, errors) {
                            data = trObj.find(".editInput.deskripsi");
                            data.addClass('is-invalid');
                            $('#' + field + '-error' + data_id).text(errors[0]).wrapInner("<strong />");

                        });
                    }
                }
            });
        });


        $('.editCancel').on('click', function() {
            $('#divisi_pjm_edit').removeClass('is-valid is-invalid');
        });

        $('#divisi_pjm_edit').on('click', function() {
            $('#divisi_pjm_edit').removeClass('is-valid is-invalid');
        });

        $('#kategori_sub_kategori_id').on('change', function() {
            $('#kategori_sub_kategori_id').removeClass('is-valid is-invalid');
        });


        $("#select_all_ids").click(function() {
            $('.checkbox_ids').prop('checked', $(this).prop('checked'));
        });

        $(document).on('change', '.checkbox-item', function() {
            var anyChecked = $('.checkbox-item:checked').length > 0;
            $('.deleteData').prop('disabled', !anyChecked);
        });

        $(document).on('change', '.checkbox_ids', function() {
            var anyChecked = $('.checkbox_ids:checked').length > 0;
            $('.deleteData').prop('disabled', !anyChecked);
            if (anyChecked == 0) {
                $('#select_all_ids').prop('checked', false);
            }

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
                            url: "{{ route('divisi_pjm.delete') }}",
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
                                    delay: 1500,
                                });


                                $.each(response.data, function(key, value) {
                                    var datas = $('#data' + value);
                                    datas.remove();
                                });

                                if (response.select == 'disabled') {
                                    $(".checkbox-item").prop("checked", false);
                                    $('.deleteData').prop('disabled', true);
                                    $(".checkbox-item").attr('disabled', true);

                                } else if (response.select == 'ada') {
                                    $('.deleteData').prop('disabled', true);
                                    $("#select_all_ids").prop("checked", false);
                                }

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

        function PengurusDelete(id) {
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
                            url: "{{ route('pengurus_divisi_pjm.delete') }}",
                            type: "POST",
                            data: {
                                ids: id,
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
                                var datas = $('#data_pengurus' + id);
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
        }

        function status(isi){
        var inputData = $('#status'+isi).val();
            console.log(inputData);
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ route('divisi_pjm.status') }}",
            dataType: "json",
            data:'statusAksi=edit&id='+isi+'&'+'status='+inputData,
            success:function(response){
            if(response.status == 200){
                var content = {};
                        content.message = 'Data berhasil di update';
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
                    $("#status"+isi).css({ 'background-color' : '', 'opacity' : '' });
                    $("#status"+isi).css({ 'background-color' : response.color });
               }
            }
        });

    }

    function test(id) {
            $('#divisi_pjm_edit' + id).removeClass('is-valid is-invalid');
    }

    function editCancel(id) {
            $('#divisi_pjm_edit' + id).removeClass('is-valid is-invalid');
    }
    </script>
@endsection