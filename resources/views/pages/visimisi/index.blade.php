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
            {{-- button --}}
            <div class="page-break">
                <div class="row">
                    <div class="col-md-3">
                        <button class="btn btn-primary mt-auto d-flex ">
                            Tambah Visi-Misi /Tujuan
                        </button>
                    </div>
                    <div class="col-md-3">
                        <select name="" id="" class="form-control">
                            <option selected disabled>Filter By:</option>
                            <option>Visi-Misi</option>
                            <option>Tujuan</option>
                        </select>

                    </div>
                </div>
            </div>
            <section class="card mt-4">
                <div class="list-group list-group-messages list-group-flush">
                    <div class="list-group-item read">
                        <div class="list-group-item-figure">
                            <span class="rating rating-sm mr-3 mt-3">
                                <input type="checkbox" id="star10" value="1">
                            </span>
                        </div>
                        <div class="list-group-item-body pl-3 pl-md-4">
                            <div class="row">
                                <div class="col-12 col-lg-10">
                                    <h4 class="list-group-item-title">
                                        <a href="#">Arash Mil</a>
                                    </h4>
                                    <p class="list-group-item-text text-truncate"> Hi Guys, minus, aliquam porro
                                        repudiandae numquam. Molestias. </p>
                                </div>
                                <div class="col-12 col-lg-2 text-lg-right mt-2">
                                    <button class="list-group-item-text btn btn-danger btn-sm"><i
                                            class="fas fa-trash text-white"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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

        $('#multi-filter-select1').DataTable({
            "pageLength": 5,
            "ordering": false,
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
    </script>
@endsection
