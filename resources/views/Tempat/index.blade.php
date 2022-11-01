@extends('template.layout')
@section('title')
    Tempat
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tempat</h1>
        </div>
        <div class="section-body">
            <div class="row">
                {{-- Data Tempat --}}
                <div class="col-12 col-md-7 col-lg-7">
                    <div class="card">
                        {{-- Judul --}}
                        <div class="card-header">
                            <h4>Data Tempat</h4>
                        </div>
                        {{-- Tabel --}}
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td style="width: 5%">No</td>
                                        <td>Nama</td>
                                        <td style="width: 15%">Aksi</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- Tambah Barang --}}
                <div class="col-12 col-md-5 col-lg-5">
                    <div class="card">

                        <div class="card-header">
                            <h4>Tambah Tempat</h4>
                        </div>

                        <div class="card-body" id="formTambah">
                            <form action="{{route('tempat.store')}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group">

                                    {{-- Add Nama --}}
                                    <label class="" for="nama">Nama Tempat</label>
                                    <input type="text" autocomplete="off" name="nama" id="nama" value="{{ old('nama')}}" class="form-control @error('nama') is-invalid @enderror">
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
                url: '{{ route('tempat.data') }}'
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

        function editData(url){
        $('#modalForm').modal('show');
        $('#modalForm .modal-title').text('Edit Data tempat');

        // Mereset Setelah Memencet Submit
        $('#modalForm form')[0].reset();
        $('#modalForm form').attr('action', url);
        $('#modalForm [name=_method').val('put');

        $.get(url)
        .done((response) => {
            $('#modalForm [name=nama]').val(response.nama);
        })
        .fail((errors) => {
            alert('Tidak Dapat Menampilkan Data');
            return;
        })
    }


    function deleteData(url) {
        // Menambahkan Alert Seperti Di Web Side SweetAlert 
        swal({
            title: "Yakin Ingin Dihapus?",
            text: "Jika Anda Klik Oke! Maka Data Akan Terhapus",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.post(url, {
                    '_token' : $('[name = csrf-token]').attr('content'),
                    '_method' : 'delete'
            })            
            .done((response) => {
                swal({
                    title: "Sukses!",
                    text: "Data Berhasil Dihapus",
                    icon: "success",
                });
                    return;
            })
            .fail((errors) => {
                swal({
                    title: "Gagal!",
                    text: "Data Gagal Dihapus",
                    icon: "error",
                });
                    return;
            });

            table.ajax.reload();
        }
    });
}
    </script>
@endpush