@extends('welcome')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-4">
                <button class="btn btn-primary btn-add" onclick="window.location='<?= $_SERVER['REQUEST_URI'] ?>/add'">
                    <span class="d-none d-lg-block">Tambah Data</span>
                    <span class="d-block d-lg-none"><i class="fas fa-plus mr-1"></i></span>
                </button>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" style="width: 100%;">
                            <thead>
                                <th>Code</th>
                                <th>Full Name</th>
                                <th>No. Telphone</th>
                                <th>Kota</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($data as $no => $row)
                                <tr>
                                    <td>{{ $row['code'] }}</td>
                                    <td>{{ $row['fullname'] }}</td>
                                    <td>{{ $row['notelp'] }}</td>
                                    <td>{{ $row['kota'] }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-secondary btn-sm btn-edit" data-href="{{ $_SERVER['REQUEST_URI'] . '/' . $row['code'] .'/edit' }}" onclick="javascript:void(0);">Edit</button>
                                        <button class=" btn btn-danger btn-sm btn-delete" data-id="{{ $row['code'] }}" data-href="{{ $_SERVER['REQUEST_URI'] }}/{{ $row['code'] }}" onclick="javascript:void(0);">Hapus</button>
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
</section>
@stop

@section('scriptjs')
<script>
    $(document).ready(function() {
        $('.table').DataTable();

        $('.btn-edit').on('click', function() {
            window.location = $(this).data('href');
        });

        $('.btn-delete').on('click', function() {
            Swal.fire({
                title: 'Apa Anda yakin?',
                text: "Anda tidak dapat mengembalikan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: $(this).data('href'),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'DELETE',
                        dataType: "JSON",
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON);
                        },
                        success: function(response) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.success,
                                showConfirmButton: false,
                                timer: 1500
                            })

                            setTimeout(function() {
                                location.reload()
                            }, 1500)
                        },
                    })
                }
            })
        });
    })
</script>
@stop