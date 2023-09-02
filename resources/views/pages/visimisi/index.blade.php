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
                    <div class="col-md-1 mr-5">
                        <button class="btn btn-primary mt-auto d-flex " onclick="displayInput()">
                            Tambah Visi-Misi /Tujuan
                        </button>
                    </div>
                    <div class="col-md-1 ml-4">
                        <button class="btn btn-warning d-flex btn-info">
                            <i class="fas fa-info" style="font-size:21px;"></i>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <select name="" id="" class="form-control">
                            <option selected disabled>Filter By:</option>
                            <option>Visi-Misi</option>
                            <option>Tujuan</option>
                        </select>

                    </div>
                </div>
            </div>

            <div class="row" style="display: none" id="select">
                <div class="col-md-6 mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Visi - Misi</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pilih Visi / Misi</label>
                                            <select name="" id="visi-misi" class="form-control" onchange="selectOption()">
                                                <option selected disabled>-- Pilih Visi / Misi --</option>
                                                <option value="visi"> Visi </option>
                                                <option value="misi"> Misi </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group visi" style="display: none">
                                            <label>Input Visi</label>
                                            <form id="form_visi">
                                                <div id="inputContainervisi">
                                                    <button type="submit" class="btn btn-primary btn-sm ml-2">Simpan</button>
                                                    <button type="button" class="btn btn-success btn-sm ml-2" onclick="addInputVisi()">+</button>
                                                        <div class="form-group">
                                                            <div class="input-group">

                                                                <input type="text" class="form-control" name="visi[]" id="visi" placeholder="masukkan visi..">
                                                                <div class="input-group-append">
                                                                    <button type="button" class="btn btn-danger remove-input" disabled><i class="fas fa-times"></i></button>
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
                                                    <button type="button" class="btn btn-success btn-sm ml-2" onclick="addInputMisi()">+</button>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="misi[]" id="misi" placeholder="masukkan misi..">
                                                                <div class="input-group-append">
                                                                    <button type="button" class="btn btn-danger remove-input" disabled><i class="fas fa-times"></i></button>
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
                    <div class="col-md-6 mt-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tujuan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="form_tujuan">
                                            <div id="inputContainertujuan">
                                                <button type="button" class="btn btn-primary btn-sm ml-2">Simpan</button>
                                                <button type="button" class="btn btn-success btn-sm ml-2" onclick="addInputTujuan()">+</button>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="tujuan[]" id="tujuan" placeholder="masukkan tujuan..">
                                                            <div class="input-group-append">
                                                                <button type="button" class="btn btn-danger remove-input" disabled><i class="fas fa-times"></i></button>
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
    </div>

    <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" id="theme-styles" />
    <script>



        function displayInput(){
            $('#select').toggle();
        }
        function selectOption() {
          data =  $('#visi-misi').val();
            if(data == "visi"){
                $('.visi').show();
                $('.misi').hide();
            }else{
                $('.misi').show();
                $('.visi').hide();
            }
        }

     function addInputTujuan() {
        var html = '<div class="form-group">' +
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
        var html = '<div class="form-group">' +
            '<div class="input-group">' +
            '<input type="text" class="form-control" name="visi[]" placeholder="masukkan visi...">' +
            '<div class="input-group-append">' +
            '<button type="button" class="btn btn-danger remove-input" onclick="removeInput(this)"><i class="fas fa-times"></i></button>' +
            '</div>' +
            '</div>' +
            '</div>';

            $('#inputContainervisi').append(html);
         }

         function addInputMisi() {
        var html = '<div class="form-group">' +
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

         $('#form_visi').submit(function(){
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url : "{{ route('tambah.visi') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function(response){

                    }
                });
         });

    function removeInput(element) {
        var inputGroup = $(element).closest('.input-group');
        if (inputGroup.parent().is(':nth-child(1)')) {
            // Prevent removing the first input
            alert('Cannot remove the first input!');
        } else {
            inputGroup.parent().remove();
        }
    }



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
