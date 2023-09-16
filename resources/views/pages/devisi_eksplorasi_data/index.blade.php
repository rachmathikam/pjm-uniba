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
                        <a href="#">Personalia PJM</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                               + Tambah Devisi Eksplorasi Data PJM
                              </button>
                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah_pengurus">
                                + Tambah Pengurus Devisi Eksplorasi Data PJM
                               </button>
                              <button type="button"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#pengurus_personalia">
                                + Data Pengurus Devisi Eksplorasi Data PJM
                               </button>
                              <button class="btn btn-sm btn-danger deleteData" disabled><i class="fas fa-trash"></i> Hapus Terpilih</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table  table-hover">
                                    <thead>
                                        <tr>
                                            @if ($devisi_eksplorasi_data->isEmpty())
                                            <th style="width: 10%"><input type="checkbox" id="select_all_ids"
                                                    class="ml-3 mt-2 checkbox-item" disabled></th>
                                            @else
                                                <th style="width: 10%"><input type="checkbox" id="select_all_ids"
                                                        class="ml-3 mt-2 checkbox-item"></th>
                                            @endif
                                            <th>Master Kategori</th>
                                            <th>Personalia PJM</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="add_new">
                                        @foreach ($devisi_eksplorasi_data as $data)
                                            <tr id="data{{ $data->id }}">
                                                <td><input type="checkbox" name="ids" class="checkbox_ids ml-3 checkbox-item"
                                                    value="{{ $data->id }}">
                                                </td>
                                                <td>
                                                    <span class="editSpan kategori_sub_kategori_id">{{ $data->kategori }} - {{ $data->sub_kategori }}</span>
                                                    <select name="kategori_sub_kategori_id"  class="form-control editInput kategori_sub_kategori_id mb-2">
                                                        @foreach ($kategori as $item)
                                                            <option value="{{ $item->id }}">{{ $item->kategori }} - {{ $item->sub_kategori }}</option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                <td>
                                                    <span class="editSpan deskripsi"> {{ $data->deskripsi }}</span>
                                                    <input type="text" class="editInput deskripsi form-control" id="devisi_eksplorasi_data_edit" name="devisi_eksplorasi_data_edit"
                                                        value="{{ $data->deskripsi }}">
                                                    <div class="invalid-feedback" id="devisi_eksplorasi_data_edit-error">

                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="status"> {{ $data->status }}</span>

                                                </td>
                                                <td style="width: 15%">
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
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <option value="{{ $item->id }}">{{ $item->kategori }} - {{ $item->sub_kategori }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="kategori_sub_kategori_id-error">

                        </div>

                    </div>
                    <div class="form-group">
                        <label for="devisi_eksplorasi_data">Isi</label>
                    <textarea name="devisi_eksplorasi_data" id="devisi_eksplorasi_data" rows="3" class="form-control"></textarea>
                    <div class="invalid-feedback" id="devisi_eksplorasi_data-error">

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

       <!--Tambah Modal Pengurus  Personalia -->
    <div class="modal fade" id="tambah_pengurus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5>Tambah Pengurus Personalia</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="add_form_pengurus" class="row">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> Kategori</label>
                        <select name="kategori_sub_kategori_id" id="kategori_sub_kategori_id_pengurus" class="form-control kategori_sub_kategori_id mb-2">
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

    <!-- Modal Data Pengurus  Personalia -->
    {{-- <div class="modal fade pengurus_personalia" id="pengurus_personalia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5>Data Pengurus Personalia</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table  table-hover">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Pengurus Personalia PJM</th>
                                    <th>Jabatan</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="add_new_pengurus">
                                @foreach ($pengurus_personalias as $data)
                                    <tr id="data{{ $data->id }}">
                                        <td>
                                            <span class="editSpan kategori_sub_kategori_id">{{ $data->kategori }} - {{ $data->sub_kategori }}</span>
                                            <select name="kategori_sub_kategori_id"  class="form-control editInput kategori_sub_kategori_id mb-2">
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item->id }}">{{ $item->kategori }} - {{ $item->sub_kategori }}</option>
                                                @endforeach
                                            </select>
                                            </td>
                                        <td>
                                            <span class="editSpan nama"> {{ $data->nama }}</span>
                                            <input type="text" class="editInput nama" name="personalia"
                                                value="{{ $data->nama }}">
                                        </td>
                                        <td>
                                            <span class="jabatan"> {{ $data->jabatan }}</span>

                                        </td>
                                        <td><img src="{{ asset('assets/image/pengurus_personalia') }}/{{ $data->foto }}"
                                            width="100"></td>
                                        <td style="width: 20%">
                                            <button class="btn text-warning btn-sm edit_inline"><i
                                                    class="fa fa-edit"></i></button>
                                            <button class="btn text-danger btn-sm" onclick="PengurusDelete({{ $data->id }})"><i
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
      </div> --}}
      <!-- End Modal -->


      <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles" />
    <script>
        $('#multi-filter-select').DataTable({
            "pageLength": 5,
            "ordering": false,
        });

        $("#add_form_pengurus").on('submit', function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    url : "{{ route('pengurus_personalia.store') }}",
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
                              $.notify(content,{
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
                                        <td><img src="{{ asset('assets/image/pengurus_personalia') }}/${value.foto}"
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



        $("#add_form").on('submit', function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    url : "{{ route('devisi_eksplorasi_data.store') }}",
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
                            $("#add_new").children().remove();
                             $('.modal').modal('hide');
                            var html = '';
                            $.each(response.data, function(key, value) {
                                      html += `<tr id="data${value.id}">
                                                <td><input type="checkbox" name="ids" class="checkbox_ids ml-3 checkbox-item"
                                                    value="${value.id}">
                                                </td>
                                                <td>
                                                    <span class="editSpan kategori_sub_kategori_id">${value.kategori} - ${value.sub_kategori} </span>
                                                    <select name="kategori_sub_kategori_id"  class="form-control editInput kategori_sub_kategori_id mb-2">
                                                        @foreach ($kategori as $item)
                                                            <option value="{{ $item->id }}">{{ $item->kategori }} - {{ $item->sub_kategori }}</option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                <td>
                                                    <span class="editSpan deskripsi"> ${value.deskripsi} </span>
                                                    <input type="text" class="editInput deskripsi" name="personalia"
                                                        value="${value.deskripsi} ">
                                                </td>
                                                <td>
                                                    <span class="status"> ${value.status}</span>

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

                                 $("#add_new").append(html);
                                 $("#add_form")[0].reset();


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
            $.ajax({
                type: "POST",
                url: "{{ route('devisi_eksplorasi_data.updated') }}",
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
                        trObj.find(".editSpan.kategori_sub_kategori_id").text(response.data.kategori_sub_kategori_id);

                        trObj.find(".editInput").hide();
                        trObj.find(".editSpan").show();
                        trObj.find(".btnSave").hide();
                        trObj.find(".editCancel").hide();
                        trObj.find(".edit_inline").show();

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
                }
            });
        });


        $('.editCancel').on('click', function() {
            $('#devisi_eksplorasi_data_edit').removeClass('is-valid is-invalid');
        });

        $('#devisi_eksplorasi_data_edit').on('click', function() {
            $('#devisi_eksplorasi_data_edit').removeClass('is-valid is-invalid');
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
                            url: "{{ route('personalia.delete') }}",
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
                            url: "{{ route('pengurus_personalia.delete') }}",
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
                                    var datas = $('#data' + id);
                                    datas.remove();
                                    var select = $("#kategori_sub_kategori_id_pengurus");
                                     select.find('option:not(:first-child)').remove();
                                $.each(response.select, function(key, value) {
                                    $("#kategori_sub_kategori_id_pengurus").append($('<option>', {
                                    value: value.id,
                                    text: value.sub_kategori
                                    }));
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
        }


    </script>
@endsection
