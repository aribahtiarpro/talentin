<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mentor;
use DataTables;

class MentorController extends Controller
{
    public function index(){
        return view("admin.mentor.index");
    }
    public function semuaDataMentor(){
        $model = Mentor::query();
        return Datatables::of($model)
            ->addColumn('action', function ($artikel) {
                $edit = "<a href='#' onclick='edittalent(".$artikel.")' class='btn btn-sm btn-primary mr-2'><i class='fa fa-edit'></i> Edit</a>";
                $delete = '<a href="#" onclick="deletetalent('.$artikel->id.')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>';
                return $edit . $delete;
            })
            ->make(true);
    }
}
