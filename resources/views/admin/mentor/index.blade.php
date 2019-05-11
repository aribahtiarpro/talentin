@extends('layouts.admin')
@section('title')
    talent
@endsection

@push('css-after')
<link  href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('js-after')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
          $('#table').DataTable({
          processing: true,
          serverSide: true,
          "search": {
            "regex": true
          },
          ajax: "{{ route('semua-data-mentor') }}",
          columns: [
                  { data: 'id', name: 'id' },
                  { data: 'no_ktp', name: 'no_ktp' },
                  { data: 'pendidikan_terakhir', name: 'pendidikan_terakhir' },
                  { data: 'alasan_menjadi_mentor', name: 'alasan_menjadi_mentor' },
                  { data: 'action' }
              ]
      });
    });

    function edittalent(data){
      $("#edittalent").modal("show");
      $("#edit-id").val(data.id);
      $("#edit-nama").val(data.nama);
      $("#edit-deskripsi").val(data.deskripsi);
      console.log(data);
    }
    function deletetalent(id){
      $("#delete-id").val(id);
      $("#deletetalent").modal("show");
    }
    </script>
@endpush

@section('content')
    
<div class="container-fluid">
    <table class="table table-bordered" id="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>No Identitas (KTP)</th>
            <th>Pendidikan Perakhir</th>
            <th>Alasan</th>
            <th>Action</th>
          </tr>
      </thead>
    </table>
</div>

@include('admin.talent.edit')
@include('admin.talent.delete')
@endsection