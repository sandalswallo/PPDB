<div class="modal fade show" id="modalForm" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog"
data-backdrop="static" data -keyboard="false">    
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Large Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-grup">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama">
                    </div>

                    <button type="submit" class="btn btn-success">Simpan</button>
                 </form>
            </div>
           
        </div>

    </div>

</div>