<?php

namespace App\Http\Controllers;

use App\Models\Jops;
use Illuminate\Http\Request;

class JopsController extends Controller
{
    public function index()
    {
        $rows = Jops::orderBy('id', 'desc')->paginate(10);
        return view('admin.jops.index', compact('rows'));
    }

    public function show($id)
    {
        $rowShow = Jops::findOrFail($id);
        //ajax
        return response()->json($rowShow);
    }

    public function destroy($id)
    {
        $row = Jops::findOrFail($id);
        $row->delete();
        alert()->success('تم الحذف بنجاح', 'تم الحذف بنجاح');
        return redirect()->route('admin.jops.index');
    }
}
