@extends('layouts.user')

@section('title')
My Profile
@endsection

@push('css-after')
<style>
.talent-list{
    width: 100%;
    float:left
}
</style>
@endpush


@push('js-after')
<script>
    function editprofile(){
        $("#editprofile").modal("show");
    }
    function createclass(){
        $("#createclass").modal("show");
    }
</script>
@endpush
@section('content')
<div class="container">
    <div class="row">
            <div class="col-md-12 col-lg-6">
                    <div class="card shadow border-0">
                        <div class="card-header">
                            My Profile
                            <button class="btn btn-primary btn-sm float-right" onclick="editprofile()">
                                Edit Profile
                            </button>
                        </div>
                        <div class="card-body">
                                <table class="table table-borderless">
                                        <tr>
                                            <td>Name</td>
                                            <td>: {{Auth::user()->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Username</td>
                                            <td>: {{Auth::user()->username}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>: {{Auth::user()->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>No HP</td>
                                            <td>: {{Auth::user()->no_hp}}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>: {{Auth::user()->alamat}}</td>
                                        </tr>
                                        @php
                                        $mentor = DB::table("mentors")->where("user_id",Auth::user()->id)->get()->first();    
                                        @endphp
                                        @if ($mentor)
                                        <tr>
                                            <td>No Identitas (KTP)</td>
                                            <td>: {{$mentor->no_ktp}}</td>
                                        </tr>
                                        <tr>
                                            <td>Pendidikan Terakhir</td>
                                            <td>: {{$mentor->pendidikan_terakhir}}</td>
                                        </tr>
                                        @endif
                                    </table>
                                    <h5 class="my-4">
                                    @if(!Auth::user()->mentor)
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#registermentor">Register Mentor</button></h5>
                                    @endif
                        </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                @if(Auth::user()->mentor)
                <h5 class="my-4">My Class <button class="btn btn-primary float-right" onclick="createclass()">Create Class</button></h5>
                @php
                    $kelas = DB::table("classes")->get();
                @endphp
                @foreach($kelas as $k)
                <div class="talent-list p-2 mb-1">
                    <div class="row">
                        <div class="col-md-12 col-lg-4">
                            <img src="img/{{ $k->img}}" class="img-fluid rounded">
                        </div>
                        <div class="col-md-12 col-lg-8">
                            <div class="talent-text py-2">
                                <h6>
                                    <div class="dropdown no-arrow float-right">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(17px, 19px, 0px);">
                                                <div class="dropdown-header">Action:</div>
                                                <a class="dropdown-item" href="#">View</a>
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    {{ $k->nama }}
                                </h6>
                                <small> 
                                    @php
                                        $t = DB::table("talents")->where("id",$k->talent_id)->get()->first();
                                    @endphp
                                    {{ $t->nama }}
                                </small>
                                
                                <div class="row pt-2">
                                    <div class="col-md-3">
                                        <i class="fa fa-eye"></i>
                                        100k
                                    </div>
                                    <div class="col-md-4">
                                        <i class="fa fa-user-circle"></i>
                                        10 Murid
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                @endforeach
                @endif
            </div>  
        
            
    </div>
</div>
{{-- Modal Jadi Mentor --}}
<div class="modal fade" id="registermentor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Register Mentor</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
    <form method="POST" action="{{ route("register-mentor") }}">
    @csrf
        <div class="form-group">
        <label for="recipient-name" class="col-form-label">No Identitas (KTP):</label>
        <input placeholder="Masukkan No KTP" type="text" class="form-control" name="no_ktp">
        </div>
        <div class="form-group">
        <label for="recipient-name" class="col-form-label">Pendidikan Terakhir:</label>
        <input placeholder="S1 Informatika" type="text" class="form-control" name="pendidikan_terakhir">
        </div>
        <div class="form-group">
        <label for="message-text" class="col-form-label">Alasan Menjadi Mentor:</label>
        <textarea class="form-control" name="alasan_menjadi_mentor"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    </div>
</div>
</div>
</div>

{{-- Edit Profil --}}
<div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{ route("edit-my-profile") }}">
            @csrf
            <div class="form-group">
                <label class="col-form-label">Name:</label>
                <input value="{{ Auth::user()->name}}" type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label class="col-form-label">Username</label>
                <input value="{{ Auth::user()->username}}" type="text" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label class="col-form-label">No Hp</label>
                <input value="{{ Auth::user()->no_hp}}" placeholder="sample '6285787995896'" type="text" class="form-control" name="no_hp">
            </div>
            <div class="form-group">
                <label class="col-form-label">Alamat</label>
                <textarea class="form-control" name="alamat" placeholder="ALamat">{{ Auth::user()->alamat}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        </div>
    </div>
    </div>
    

    {{-- Buat Kelas --}}


    {{-- Modal Jadi Mentor --}}
<div class="modal fade" id="createclass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Class</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{ route("create-class") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Nama:</label>
                <input placeholder="Nama of Class" type="text" class="form-control" name="nama">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">TalentIn:</label>
                <select class="form-control" name="talent_id">
                    <option value="">Talent In</option>
                    @php
                        $talents = DB::table("talents")->get();
                    @endphp
                    @foreach ($talents as $item)
                        <option value="{{$item->id}}">{{ $item->nama}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Harga:</label>
                <input placeholder="Harga" type="integer" class="form-control" name="harga">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Jumlah Jam:</label>
                <input placeholder="Jumlah Jam" type="integer" class="form-control" name="jml_jam">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Image Thumbnail:</label>
                <input placeholder="Image" type="file" class="form-control" name="image">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Link Video Youtube:</label>
                <input placeholder="Link Video" type="text" class="form-control" name="video">
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Deskription:</label>
                <textarea class="form-control" name="deskripsi"></textarea>
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Alamat Kursus:</label>
                <textarea class="form-control" name="alamat"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection
