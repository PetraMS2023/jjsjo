<?php

namespace App\Http\Controllers;


use App\Http\Requests\Slider\store as store;
use App\Http\Requests\Slider\update as update;
use App\Models\Slider as Models;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    use \App\Traits\UploadTrait;
    public function __construct()
    {
         $view     = 'Sliders';
         $route    = 'sliders';
         $name     = 'السلايدرات';
        $this->view = $view;
        $this->route = $route;
        $this->name = $name;

    }
    //index
    public function index()
    {
//        $rows = Models::firest();
        //اول سلايدر
        $rows = Models::where('type', 'image')->first();

        return view('admin.' . $this->view . '.index', compact('rows'));
    }

    //create
    public function create()
    {
        return view('admin.' . $this->view . '.create');
    }

    //store
    public function store(store $request)
    {
        $row = Models::create($request->validated());
        alert()->success('تم اضافه '.$this->name.' بنجاح', 'تمت العملية');
        return redirect()->route('admin.' . $this->route . '.index');
    }


//edit
    public function edit($id)
    {
        $row = Models::findOrFail($id);
        return view('admin.' . $this->view . '.edit', compact('row'));
    }

    //update
    public function update(update $request)
    {

        $row = Models::where('type', 'image')->first();
        $row->update($request->validated());
        //uploadImages
        $this->uploadImages($request->images, 'sliders', $row);
        alert()->success('تم تعديل '.$this->name.' بنجاح', 'تمت العملية');
        return redirect()->route('admin.' . $this->route . '.index');
    }

    //destroy
    public function destroy($id)
    {
        $row = Models:: findOrFail($id);
        $row->media()->delete();
        $row->delete();
        alert()->success('تم حذف '.$this->name.' بنجاح', 'تمت العملية');
        return redirect()->route('admin.' . $this->route . '.index');
    }

    public function deleteImage(Request $request)
    {
        $row = Models::where('type', 'image')->first();
        if ($row->media->count() == 1) {
            return response()->json(['status' => false, 'msg' => "لا يمكن حذف الصورة الوحيدة"]);
        }
        // مسح الصوره من الملفات
        $row->media()->where('id', $request->image_id);
        $name = $row->media()->where('id', $request->image_id)->first()->file_name;
        $path = base_path() . '/public/storage/images/sliders/' . $name;
        if (file_exists($path)) {
            unlink($path);
        }
        // مسح الصوره من قاعدة البيانات
        $row->media()->where('id', $request->image_id)->delete();
        return response()->json(['status' => true, 'msg' => "تم حذف الصورة بنجاح"]);
    }
}

