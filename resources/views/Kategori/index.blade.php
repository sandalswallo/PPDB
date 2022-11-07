@extends('template.layout')

@section('title')
    Kategori
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Kategori</h1>
        </div>

        <div class="section-body">
            <div class="row">

                {{-- Data Kategori --}}
                <div class="col-12 col-md-7 col-lg-7">
                    <div class="card">
                        {{-- Judul --}}
                        <div class="card-header">
                            <h4>Data Kategori</h4>
                        </div>

                        {{-- Tabel --}}
                        <div class="card-body">
                            <table class="table table-striped text-nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td scope="col" width="50px">No</td>
                                        <td scope="col">Nama</td>
                                        <td scope="col" width="84px">Aksi</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>

                {{-- Tambah Kategori --}}
                <div class="col-12 col-md-5 col-lg-5">
                    <div class="card">

                        <div class="card-header">
                            <h4>Tambah Kategori</h4>
                        </div>

                        <div class="card-body" id="formTambah">
                            <form action="{{route('kategori.store')}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                    
                                    {{-- Add Nama --}}
                                    <label class="" for="nama">Nama Kategori</label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama')}}" class="form-control @error('nama') is-invalid @enderror">
                                    @error('nama')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    
                                    {{-- Tombol simpan dan batal --}}
                                    <div class="footer mt-2">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@include('kategori.form')

@endsection

@push('script')
    <script>
    // Data Tables
    let table;

    $(function() {
        table = $('.table').DataTable({
            proccesing: true,
            autowidth: false,
            ajax: {
                url: '{{ route('kategori.data') }}'
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'nama'},
                {data: 'aksi'}
            ]
        });
    })

    $('#formTambah').on('submit', function(e){
            if(! e.preventDefault()){
                $.post($('#formTambah form').attr('action'), $('#formTambah form').serialize())
                .done((response) => {
                    $('#formTambah form')[0].reset();
                    table.ajax.reload();
                    iziToast.success({
                        title: 'Sukses',
                        message: 'Data berhasil disimpan',
                        position: 'topRight'
                    })
                })
                .fail((errors) => {
                    iziToast.error({
                        title: 'Gagal',
                        message: 'Data gagal disimpan',
                        position: 'topRight'
                    })
                    return;
                })
            }
        })

    // Fungsi Edit Data
    $('#modalForm').on('submit', function(e){
            if(! e.preventDefault()){
                $.post($('#modalForm form').attr('action'), $('#modalForm form').serialize())
                .done((response) => {
                    $('#modalForm').modal('hide');
                    table.ajax.reload();
                    iziToast.success({
                        title: 'Sukses',
                        message: 'Data berhasil di ubah',
                        position: 'topRight'
                    })
                })
                .fail((errors) => {
                    iziToast.error({
                        title: 'Gagal',
                        message: 'Data gagal di ubah',
                        position: 'topRight'
                    })
                    return;
                })
            }
        })

    function editData(url){
        $('#modalForm').modal('show');
        $('#modalForm .modal-title').text('Edit Data Kategori');

        $('#modalForm form')[0].reset();
        $('#modalForm form').attr('action', url);
        $('#modalForm [name=_method]').val('put');

        $.get (url)
            .done((response) => {
                $('#modalForm [name=nama]').val(response.nama);
                // console.log(response.nama);
            })
            .fail((errors) => {
                alert('Tidak Dapat Menampilkan Data');
                return;
            })
    }

    // Fungsi Delete Data
    function deleteData(url){
            swal({
                title: "Apa anda yakin menghapus data ini?",
                text: "Jika anda klik OK, maka data akan terhapus",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.post(url, {
                    '_token' : $('[name=csrf-token]').attr('content'),
                    '_method' : 'delete'
                })
                .done((response) => {
                    swal({
                    title: "Sukses",
                    text: "Data berhasil dihapus!",
                    icon: "success",
                    });
                })
                .fail((errors) => {
                    swal({
                    title: "Gagal",
                    text: "Data gagal dihapus!",
                    icon: "error",
                    });
                })
                table.ajax.reload();
                }
            });

        }

    </script>
@endpush