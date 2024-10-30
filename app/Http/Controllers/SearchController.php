<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $rows = Product::where('id', '==', null)->paginate(10);
        return view('intro_site.parts.search', compact('rows'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $news = News::where('description', 'like', '%' . $search . '%')->
        orWhere('date', 'like', '%' . $search . '%')-> get();

        return view('intro_site.parts.search', compact('news'));
    }

    public function productsImages($id)
    {
        $rows = Product::find($id);
        return view('intro_site.parts.search_images', compact('rows'));
    }

}
