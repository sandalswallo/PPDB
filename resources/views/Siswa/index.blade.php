@extends('template.layout')

@section('title')
    Siswa
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Siswa</h1>
        </div>

        <div class="section-body">
            <div class="row">

                {{-- Data siswa --}}
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        {{-- Judul --}}
                        <div class="card-header">
                            <div class="col-12 col-md-10 col-lg-10">
                                <h4>Data siswa</h4>
                            </div>
                            <div class="col-12 col-md-2 col-lg-2">
                                <button type="button" onclick="addForm('{{ route('siswa.store') }}')" class="btn btn-success shadow-sm rounded-pill">
                                        <i class="fa fa-print"></i> Print
                                </button>
                                <button type="button" onclick="addForm('{{ route('siswa.store') }}')" class="btn btn-primary shadow-sm rounded-pill">
                                        <i class="fa fa-plus"></i> Tambah
                                </button>
                            </div>
                        </div>

                        {{-- Tabel --}}
                        <div class="card-body">
                            <table class="table table-striped text-nowrap" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td scope="col" style="width: 50px;">No</td>>
                                        <td scope="col">Nama</td>
                                        <td scope="col">Kelas</td>
                                        <td scope="col">Jurusan</td>
                                        <td scope="col">Asal sekolah</td>
                                        <td scope="col">Jenis Kelamin</td>                                   
                                        <td scope="col" style="width: 120px;">Aksi</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>

               

            </div>
        </div>
    </section>

@include('siswa.form')

@endsection

@push('script')
<script>
    //data tables
    let table;
    $(function () {
        table = $('.table').DataTable({
            proccesing: true,
            autowitdh: false,
            ajax: {
                url: '{{ route('siswa.data') }}'
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'nama'},
                {data: 'jenis_kelamin'},
                {data: 'jurusan_id'},
                {data: 'kelas'},
                {data: 'asal_sekolah'},
                {data: 'aksi'}
            ]
        });
    })
    $('#modalForm').on('submit', function (e) {
        if (!e.preventDefault()) {
            $.post($('#modalForm form').attr('action'), $('#modalForm form').serialize())
                .done((response) => {
                    $('#modalForm')[0].reset();
                    table.ajax.reload();
                    iziToast.success({
                        title: 'Sukses',
                        message: 'Data Berhasil diSimpan',
                        position: 'topRight'
                    })
                })
                .fail((errors) => {
                    iziToast.error({
                        title: 'Gagal',
                        message: 'Data Gagal diSimpan',
                        position: 'topRight'
                    })
                    return;
                })
        }
    })
    function addForm(url) {
        $('#modalForm').modal('show');
        $('#modalForm .modal-title').text('Tambah Data siswa');
        $('#modalForm form').modal('hide');
        $('#modalForm form').attr('action', url);
        $('#modalForm [name=_method]').val('post');
    }
    function editData(url) {
        $('#modalForm').modal('show');
        $('#modalForm .modal-title').text('Edit Data siswa');
        $('#modalForm form')[0].reset();
        $('#modalForm form').attr('action', url);
        $('#modalForm [name=_method]').val('put');
        $.get(url)
            .done((response) => {
                $('#modalForm [name=nama]').val(response.nama);
                $('#modalForm [name=kelas]').val(response.kelas);
                $('#modalForm [name=jurusan_id').val(response.jurusan_id);
                $('#modalForm [name=asal_sekolah]').val(response.asal_sekolah);
                $('#modalForm [name=jenis_kelamin]').val(response.jenis_kelamin);
                
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan Data');
                return;
            })
    }
    function deleteData(url) {
        swal({
                title: "Yakin ingin Menghapus Data ini?",
                text: "Jika Anda klick OK! Maka data akan terhapus",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        swal({
                            title: "Sukses",
                            text: "Data Berhasil dihapus",
                            icon: "success",
                        });
                        return;
                    })
                    .fail((erorrs) => {
                        swal({
                            title: "Gagal",
                            text: "Data Gagal dihapus",
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