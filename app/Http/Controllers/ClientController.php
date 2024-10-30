<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //index
    public function index()
    {
        $rows = Client::paginate(10);
        return view('admin.Client.index', compact('rows'));
    }

    //create
    public function create()
    {
        return view('admin.Client.create');
    }

    //store
    public function store(Request $request)
    {

        $this->validate($request, [
            'name.ar' => 'required',
            'name.en' => 'required',
            'image' => 'required',
            'job_title.ar' => 'required',
            'job_title.en' => 'required',
        ]);
        $client = new Client();
        $client->name = $request->name;
        $client->image = $request->image;
        $client->job_title = $request->job_title;
        $client->save();
        alert()->success('تم اضافة العميل بنجاح', 'تمت العملية');
        return redirect()->route('admin.clients.index');
    }

    //destroy
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
//        notify()->success('Client Deleted Successfully','Success');
        alert()->success('تم حذف العميل بنجاح', 'تمت العملية');
        return redirect()->route('admin.clients.index');
    }

    //edit
    public function edit($id)
    {
        $row = Client::find($id);
//        alert()->success('Client Edited Successfully','Success');
        return view('admin.Client.edit', compact('row'));
    }

    //update
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name.ar' => 'required',
            'name.en' => 'required',
            'image' => 'nullable',
            'job_title.ar' => 'required',
            'job_title.en' => 'required',
        ]);
        $client = Client::find($id);
        $client->name = $request->name;
        $client->image = $request->image;
        $client->job_title = $request->job_title;
        $client->save();
//        notify()->success('Client Updated Successfully','Success');
        alert()->success('تم تعديل العميل بنجاح', 'تمت العملية');
        return redirect()->route('admin.clients.index');
    }


}

