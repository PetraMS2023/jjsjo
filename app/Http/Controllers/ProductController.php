<?php

namespace App\Http\Controllers;

use App\Exports\ExportProducts;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Excel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $rows = Product::latest()->paginate(10);
        return view('admin.Products.index', compact('rows'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', null)->latest()->get();
        return view('admin.Products.create', compact('categories'));
    }

    //getSubCategory
    public function getSubCategory($id)
    {
        $subCategories = Category::where('parent_id', $id)->latest()->get();
        return response()->json($subCategories );
    }

    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());
//        notify()->success('Product Added Successfully', 'Success');
        alert()->success('تم اضافة المنتج بنجاح', 'تمت العملية');
        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        //delete images
        $product->media()->delete();
        $product->delete();
//        notify()->success('Product Deleted Successfully', 'Success');
        alert()->success('تم حذف المنتج بنجاح', 'تمت العملية');
        return redirect()->route('admin.products.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::where('parent_id', null)->latest()->get();
        return view('admin.Products.edit', compact('product', 'categories'));
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::findOrfail($id);
        $product->update($request->validated());
//        notify()->success('Product Updated Successfully', 'Success');
        alert()->success('تم تعديل المنتج بنجاح', 'تمت العملية');
        return redirect()->route('admin.products.index');
    }


    public function deleteImage(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if ($product->media->count() == 1) {
            return response()->json(['status' => false, 'msg' => "لا يمكن حذف الصورة الوحيدة"]);
        }
        $product->media()->where('id', $request->image_id);
        $name = $product->media()->where('id', $request->image_id)->first()->file_name;
        if (file_exists(public_path('storage/images/products/' . $name))) {
            unlink(public_path('storage/images/products/' . $name));
        }
        $product->media()->where('id', $request->image_id)->delete();
        return response()->json(['status' => true, 'msg' => "تم حذف الصورة بنجاح"]);
    }

    //export
    public function export()
    {
        return Excel::download(new ExportProducts, 'products.xlsx');
    }

}
