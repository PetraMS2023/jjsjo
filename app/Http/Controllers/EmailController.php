<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        $rows = Contact::orderBy('id', 'desc')->paginate(10);
        return view('admin.emails.index', compact('rows'));
    }

    public function show($id)
    {
        $rowShow = Contact::findOrFail($id);
        //ajax
        return response()->json($rowShow);
    }

    public function destroy($id)
    {
        $row = Contact::findOrFail($id);
        $row->delete();
        alert()->success('تم الحذف بنجاح', 'تم الحذف بنجاح');
        return redirect()->route('admin.emails.index');
    }
}
