<div class="modal fade" id="edittalent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit talent</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route("edit-talent") }}" enctype="multipart/form-data">
            @csrf
            <input id="edit-id" type="hidden" class="form-control" name="id">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama:</label>
            <input id="edit-nama" type="text" class="form-control" name="nama">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">deskripsi:</label>
            <input id="edit-deskripsi" type="text" class="form-control" name="deskripsi">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Image:</label>
            <input type="file" class="form-control" name="image">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">
                  Simpan
              </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>