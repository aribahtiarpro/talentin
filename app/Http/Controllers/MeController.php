<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\User;
use App\Mentor;
use App\Kelas;

class MeController extends Controller
{
    public function index(){
        return view("me.index");
    }
    public function registerMentor(Request $req){

        

        $user = User::find(Auth::user()->id);
        $user->mentor = true;
        $user->save();

        $this->validate($req,[
            "no_ktp" => ['required', 'unique:mentors'],
            "pendidikan_terakhir" => "required",
            "alasan_menjadi_mentor" => "required",
        ]);
        
        $mentor = new Mentor;
        $mentor->user_id = Auth::user()->id;
        $mentor->no_ktp = $req['no_ktp'];
        $mentor->pendidikan_terakhir = $req['pendidikan_terakhir'];
        $mentor->alasan_menjadi_mentor = $req['alasan_menjadi_mentor'];
        $mentor->save();

        return redirect("/me");
        
    }
    public function editMyProfile(Request $req){

        $user = User::find(Auth::user()->id);
        $user->name = $req['name'];
        $user->username = $req['username'];
        // $user->email = $req['email'];
        $user->no_hp = $req['no_hp'];
        $user->alamat = $req['alamat'];
        $user->save();

        return redirect("/me");
    }

    public function createClass(Request $req){
        // 'nama','slug', 'img', 'video','harga','alamat','jml_jam','talent_id','mentor_id'
        $this->validate($req,[
            "nama" => "required",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = Str::slug($req['nama'], '-');
        $imagename = time().'.'.request()->image->getClientOriginalExtension();

        $req->file('image')->move(public_path('img'), $imagename);

        $new = new Kelas;

        if($req['index']){
            $index = $req['index'];
        }
        
        $new->nama = $req['nama'];
        $new->video = $req['video'];
        $new->harga = $req['harga'];
        $new->alamat_kursus = $req['alamat'];
        $new->jml_jam = $req['jml_jam'];
        $new->talent_id = $req['talent_id'];
        $new->mentor_id = Auth::user()->id;
        $new->slug = $slug;
        $new->img = $imagename;
        $new->deskripsi = $req['deskripsi'];
        $new->save();

        // return $new;
        return redirect("/me");
    }
}
