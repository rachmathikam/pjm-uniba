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
                        <a href="#">Petugas</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('petugas.create') }}" class="btn btn-sm btn-primary"><i
                                    class="fas fa-plus"></i> Tambah Pegawai</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table  table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Petugas</th>
                                            <th>NIP</th>
                                            <th>Alamat</th>
                                            <th>Foto</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Petugas</th>
                                            <th>NIP</th>
                                            <th>Alamat</th>
                                            <th>Foto</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php $no = 1 @endphp
                                    @foreach ($petugas as $data)
                                    <tr id="data{{ $data->id }}">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->nip }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td><img src="{{ asset('assets/image/petugas') }}/{{ $data->foto }}" width="100"></td>
                                        <td>
                                            <a href="{{ route('petugas.edit',$data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <button class="btn btn-sm btn-danger deleteData">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                                </table>
                            </div>
                        </div>
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
            $('#multi-filter-select').DataTable({
                "pageLength": 5,
                "ordering": false,
            });


            $(document).on('click', '.deleteData', function() {
                var ID = $(this).closest("tr").attr("id");
                console.log(ID);

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
                            $.notify(content,{
                                type: 'primary',
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                time: 1500,
                                delay: 1000,
			                });
                                var datas = $('#data' + ID);
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
        </script>
    @endsection
