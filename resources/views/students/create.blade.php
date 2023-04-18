@extends('welcome')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-4">
                <button class="btn btn-primary btn-add" onclick="window.location='/students'" title="Back">
                    <span><i class="fas fa-arrow-left mr-1"></i></span>
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
                    <div class="card-header">
                        <h4 class="card-title m-0">{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation">
                            <div class="col-12">
                                <label for="validationCustom01" class="form-label">Code</label>
                                <input type="text" class="form-control" id="code" name="code">
                                <div class="invalid-feedback invalid-code"></div>
                            </div>
                            <div class="col-12">
                                <label for="validationCustom01" class="form-label">Full name</label>
                                <input type="text" class="form-control" id="fullname" name="fullname">
                                <div class="invalid-feedback invalid-fullname"></div>
                            </div>
                            <div class="col-12">
                                <label for="validationCustom02" class="form-label">No. Telp</label>
                                <input type="text" class="form-control" id="notelp" name="notelp">
                                <div class="invalid-feedback invalid-notelp"></div>
                            </div>
                            <div class="col-12">
                                <label for="validationCustom02" class="form-label">Kota</label>
                                <select class="form-control" id="kota" name="kota">
                                    <option value="Jakarta">Jakarta</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
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
        $('form').on('submit', function(e) {
            e.preventDefault();

            // alert('ok')
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/students/store',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('button[type=submit]').html('Loading....')
                    $('.form-control').removeClass('is-invalid');
                },
                complete: function() {
                    $('button[type=submit]').html('Simpan')
                },
                error: function(error) {
                    $.each(error.responseJSON.errors, function(a, b) {
                        console.log(b);
                        $('#' + a).addClass('is-invalid');
                        $('.invalid-' + a).html('<strong>' + b + '</strong>');
                    })
                },
                success: function(response) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.success,
                        showConfirmButton: false,
                        timer: 1500
                    });

                    setTimeout(function() {
                        window.location = '/students';
                    }, 1500);

                }
            })
        })
    })
</script>
@stop