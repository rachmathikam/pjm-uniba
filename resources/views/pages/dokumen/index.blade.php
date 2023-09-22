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
                        <a href="#">Dokumen PJM</a>
                    </li>
                </ul>
            </div>

            <div class="filter form-group">
                <label for="">Filter Dokumen</label>
                <select name="filter_divisi" id="filter_divisi" class="form-control col-2">
                        <option selected disabled>Filter By Kategori</option>
                        @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->sub_kategori }}</option>
                        @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#exampleModal">
                                + Tambah Dokumen
                            </button>
                            <button class="btn btn-sm btn-danger deleteData" disabled><i class="fas fa-trash"></i> Hapus
                                Terpilih</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table  table-hover">
                                    <thead>
                                        <tr>
                                            @if ($dokumen->isEmpty())
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
                                                    <span class="editSpan deskripsi"> {{ $data['slug'] }}</span>
                                                    <input type="text" class="editInput deskripsi form-control" onclick="test({{ $data['id'] }})"
                                                        id="divisi_pjm_edit{{ $data['id'] }}" name="divisi_pjm_edit"
                                                        value="{{ $data['slug'] }}">
                                                    <div class="invalid-feedback" id="divisi_pjm_edit-error">

                                                    </div>
                                                </td>
                                                <td>
                                                    <embed src="{{ asset('assets/pdf/dokumen') }}/{{ $data['file'] }}" width="300" height="150" type="application/pdf">
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
                            <label for="exampleInputEmail1">Pilih Kategori</label>
                            <select name="kategori_sub_kategori_id" id="kategori_sub_kategori_id" class="form-control mb-2">
                                <option selected disabled>-- Pilih Kategori --</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori }} - {{ $item->sub_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="kategori_sub_kategori_id-error">

                            </div>

                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input name="judul" id="judul" type="text" class="form-control">
                            <div class="invalid-feedback" id="judul-error">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file_dokumen">File</label>
                            <input name="file_dokumen" id="file_dokumen" type="file" class="form-control">
                            <div class="invalid-feedback" id="file_dokumen-error">

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


        $("#add_form").on('submit', function(e) {
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: "{{ route('dokumen.store') }}",
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






        $('#divisi_pjm_edit').on('click', function() {
            $('#divisi_pjm_edit').removeClass('is-valid is-invalid');
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

