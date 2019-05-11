<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Talent;
use Illuminate\Support\Str;
use DataTables;

class TalentController extends Controller
{
    public function index(){
        return view("admin.talent.index");
    }
    public function semuaDataTalent(){
        $model = Talent::query();
        return Datatables::of($model)
            ->addColumn('action', function ($artikel) {
                $edit = "<a href='#' onclick='edittalent(".$artikel.")' class='btn btn-sm btn-primary mr-2'><i class='fa fa-edit'></i> Edit</a>";
                $delete = '<a href="#" onclick="deletetalent('.$artikel->id.')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>';
                return $edit . $delete;
            })
            ->make(true);
    }
    public function tambah(Request $req){
        $this->validate($req,[
            "nama" => "required",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slug = Str::slug($req['nama'], '-');
        $imagename = time().'.'.request()->image->getClientOriginalExtension();

        $req->file('image')->move(public_path('img'), $imagename);

        $new = new Talent;

        if($req['index']){
            $index = $req['index'];
        }
        
        $new->nama = $req['nama'];
        $new->slug = $slug;
        $new->img = $imagename;
        $new->deskripsi = $req['deskripsi'];
        $new->save();

        return redirect("/admin/talent");
    }

    public function edit(Request $req){
        $this->validate($req,[
            "nama" => "required",
        ]);

        $new = Talent::find($req['id']);

        if($req->file('image')){
            $this->validate($req,[
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imagename = time().'.'.request()->image->getClientOriginalExtension();

            $req->file('image')->move(public_path('img'), $imagename);
            $new->img = $imagename;
        }

        if($req['index']){
            $index = $req['index'];
        }
        
        $new->nama = $req['nama'];
        $new->deskripsi = $req['deskripsi'];
        $new->save();

        return redirect("/admin/talent");
    }

    public function delete(Request $req){
        $this->validate($req,[
            "id" => "required",
        ]);

        $new = Talent::find($req['id']);
        $new->delete();

        return redirect("/admin/talent");
    }
}
