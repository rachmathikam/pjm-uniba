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
                        <a href="#">Kategori Dokumen</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#kategori">
                               + Tambah Kategori Dokumen
                              </button>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#subkategori">
                            + Tambah Sub Kategori Dokumen
                            </button>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#masterKategori">
                                + Tambah Master Kategori Dokumen
                                </button>
                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#table_kategori">
                                 Table Kategori Dokumen
                                </button>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#table_sub_kategori">
                                    Table Sub Kategori Dokumen
                                   </button>
                              <button class="btn btn-sm btn-danger deleteData" disabled><i class="fas fa-trash"></i> Hapus Terpilih</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table  table-hover">
                                    <thead>
                                        <tr>
                                            @if ($kategoriSubKategori->isEmpty())
                                            <th style="width: 10%"><input type="checkbox" id="select_all_ids"
                                                    class="ml-3 mt-2 checkbox-item" disabled></th>
                                            @else
                                                <th style="width: 10%"><input type="checkbox" id="select_all_ids"
                                                        class="ml-3 mt-2 checkbox-item"></th>
                                            @endif
                                            <th>Kategori</th>
                                            <th>Sub Kategori</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="add_new">
                                        @foreach ($kategoriSubKategori as $data)
                                            <tr id="data{{ $data->id }}">
                                                <td><input type="checkbox" name="ids" class="checkbox_ids ml-3 checkbox-item"
                                                    value="{{ $data->id }}">
                                                </td>
                                                <td>
                                                    <span class="editSpan kategori"> {{ $data->kategori }}</span>
                                                    <input type="text" class="editInput kategori" name="kategori"
                                                        value="{{ $data->kategori }}">
                                                </td>
                                                <td>
                                              <span class="editSpan"> {{ $data->sub_kategori }}</span>
                                                    <input type="text" class="editInput subkategori" name="sub_kategori"
                                                        value="{{ $data->sub_kategori }}">
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
        </div>
    </div>

 <!-- Modal kategori  -->
 <div class="modal fade" id="kategori" tabindex="-1" role="dialog" aria-labelledby="Kategori" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="Kategori">Tambah Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="add_form_kategori">
                @csrf
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" class="form-control" id="kategori">
                    <div class="invalid-feedback " id='kategori-error'>

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
  <!-- End Modal -->

    <!-- Modal subkategori-->
    <div class="modal fade" id="subkategori" tabindex="-1" role="dialog" aria-labelledby="subkategori" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="subkategori">Tambah Sub Kategori</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="add_form_sub" class="row">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="sub_kategori">Sub kategori</label>
                        <input type="text" name="sub_kategori" class="form-control" id="sub_kategori">
                        <div class="invalid-feedback " id='kategori-error'>

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
      <!-- End Modal subkategori-->

      <!-- Modal masterKategori -->
    <div class="modal fade" id="masterKategori" tabindex="-1" role="dialog" aria-labelledby="masterKategori" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="masterKategori">Tambah Master Kategori</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="add_form_master" class="row">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="kategori">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control">
                            <option selected disabled>-- Pilih Kategori -- </option>
                            @foreach ($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback " id='kategori_id-error'>

                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="subkategori">Sub Kategori</label>
                        <select name="sub_kategori_dokumen_id" id="sub_kategori_dokumen_id" class="form-control">
                            <option selected disabled>-- Pilih Sub Kategori -- </option>
                            @foreach ($subKategoris as $item)
                            <option value="{{ $item->id }}">{{ $item->sub_kategori }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback " id='sub_kategori_dokumen_id-error'>

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
      <!-- End Modal masterKategori -->


       <!-- Modal table kategori -->
    <div class="modal fade" id="table_kategori" tabindex="-1" role="dialog" aria-labelledby="table_kategori" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="table_kategori">Data Kategori</h5>
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
                                    @if ($kategori->isEmpty())
                                    <th style="width: 10%"><input type="checkbox" id="select_all_ids"
                                            class="ml-3 mt-2 checkbox-item" disabled></th>
                                    @else
                                        <th style="width: 10%"><input type="checkbox" id="select_all_ids"
                                                class="ml-3 mt-2 checkbox-item"></th>
                                    @endif
                                    <th>Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="add_new">
                                @foreach ($kategori as $data)
                                    <tr id="data{{ $data->id }}">
                                        <td><input type="checkbox" name="ids" class="checkbox_ids ml-3 checkbox-item"
                                            value="{{ $data->id }}">
                                        </td>
                                        <td>
                                            <span class="editSpan kategori"> {{ $data->kategori }}</span>
                                            <input type="text" class="editInput kategori" name="kategori"
                                                value="{{ $data->kategori }}">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End Modal table kategori -->


      <!-- Modal table Sub Kategori -->
    <div class="modal fade" id="table_sub_kategori" tabindex="-1" role="dialog" aria-labelledby="table_sub_kategori" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="table_sub_kategori">Data Sub Kategori</h5>
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
                                    @if ($subKategori->isEmpty())
                                    <th style="width: 10%"><input type="checkbox" id="select_all_ids"
                                            class="ml-3 mt-2 checkbox-item" disabled></th>
                                    @else
                                        <th style="width: 10%"><input type="checkbox" id="select_all_ids"
                                                class="ml-3 mt-2 checkbox-item"></th>
                                    @endif
                                    <th>Sub Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="add_new">
                                @foreach ($subKategori as $data)
                                    <tr id="data{{ $data->id }}">
                                        <td><input type="checkbox" name="ids" class="checkbox_ids ml-3 checkbox-item"
                                            value="{{ $data->id }}">
                                        </td>
                                        <td>
                                            <span class="editSpan sub_kategori"> {{ $data->sub_kategori }}</span>
                                            <input type="text" class="editInput sub_kategori" name="sub_kategori"
                                                value="{{ $data->sub_kategori }}">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </form>
          </div>
        </div>
      </div>
      <!-- End Modal table kategori -->






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

        $("#add_form_kategori").on('submit', function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    url : "{{ route('kategori_dokumen.kategori') }}",
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
                        }else{
                            var content = {};
			                content.title = 'Pesan Error';
                            content.message = response.data.kategori;
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

            $("#add_form_sub").on('submit', function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    url : "{{ route('kategori_dokumen.sub') }}",
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
                        }else{
                            var content = {};
			                content.title = 'Pesan Error';
                            content.message = response.data.sub_kategori;
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
                                console.log(response.data);
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').text(errors[0]).wrapInner("<strong />");
                        });
                        }
                    },
                });
            });

            $("#add_form_master").on('submit', function(e) {
                e.preventDefault();
                var data = new FormData(this);
                $.ajax({
                    url : "{{ route('kategori_dokumen.master') }}",
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
                                console.log(response.data);
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
                url: "{{ route('kategori_dokumen.updated') }}",
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
                        trObj.find(".editSpan.profile").text(response.data.profile);
                        trObj.find(".editInput.profile").val(response.data.profile);
                        trObj.find(".editInput").hide();
                        trObj.find(".editSpan").show();
                        trObj.find(".btnSave").hide();
                        trObj.find(".editCancel").hide();
                        trObj.find(".edit_inline").show();
                    }
                }
            });
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
            console.log(anyChecked);
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
                            url: "{{ route('tupoksi.delete') }}",
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
