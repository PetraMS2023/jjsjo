<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //index
    public function index()
    {
        $rows = News::paginate(10);
        return view('admin.news.index', compact('rows'));
    }

    //create
    public function create()
    {
        return view('admin.news.create');
    }

    //store
    public function store(Request $request)
    {

        $this->validate($request, [
            'title.en' => 'required',
            'title.ar' => 'required',
            'description.en' => 'required',
            'description.ar' => 'required',
            'date' => 'required',
            'image' => 'required',
        ]);
        $client = new News();
                $client->title = $request->title;
        $client->description = $request->description;
        $client->image = $request->image;
        $client->date = $request->date;
        $client->save();
        alert()->success('تم اضافة الخبر بنجاح', 'تمت العملية');
        return redirect()->route('admin.news.index');
    }

    //destroy
    public function destroy($id)
    {
        $client = News::find($id);;
        $client->delete();
//        notify()->success('Client Deleted Successfully','Success');
        alert()->success('تم حذف الخبر بنجاح', 'تمت العملية');
        return redirect()->route('admin.news.index');
    }

    //edit
    public function edit($id)
    {
        $row = News::find($id);
//        alert()->success('Client Edited Successfully','Success');
        return view('admin.news.edit', compact('row'));
    }

    //update
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title.en' => 'required',
            'title.ar' => 'required',
            'description.en' => 'required',
            'description.ar' => 'required',
            'date' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $client = News::find($id);
                $client->title = $request->title;

        $client->description = $request->description;
        $client->image = $request->image;
        $client->date = $request->date;
        $client->save();
//        notify()->success('Client Updated Successfully','Success');
        alert()->success('تم تعديل الخبر بنجاح', 'تمت العملية');
        return redirect()->route('admin.news.index');
    }
}
