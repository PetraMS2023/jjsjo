<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\News;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Text;

class HomeController extends Controller
{
    public function SetLanguage($lang) {
        if (in_array($lang, [ 'en'])) {

            if (session()->has('lang')) {
                session()->forget('lang');
            }

            session()->put('lang', $lang);

        } else {
            if (session()->has('lang')) {
                session()->forget('lang');
            }

            session()->put('lang', 'en');
        }
        return back();
    }
    public function index()
    {
        //news
        $news = News::orderBy('id', 'desc')->get();
        return view('intro_site.parts.index', compact('news'));
    }
    
        // show news
    public function showNews($id)
    {
        
        $new = News::find($id);
        return view('intro_site.parts.news-content', compact('new'));
    }

    public function about()
    {
        $about =  Text::select(  'about_us')->first();
        $clients = Client::all();
        return view('intro_site.parts.about', compact('clients', 'about'));
    }

    //clients
    public function clients()
    {
        $clients = Client::all();
        return view('intro_site.parts.client', compact('clients'));
    }

    //clientGetImages
    public function clientGetImages($id)
    {
        $client = Client::find($id);
        //ajax
        return view('intro_site.parts.client_images', compact('client'));
    }

    //category
    public function category()
    {
        $rows = Category::where('parent_id', null)->get();
        return view('intro_site.parts.category', compact('rows'));
    }
    //subCategory
    public function subCategory($id)
    {
        $rows = Category::where('parent_id', $id)->get();
        $category = Category::find($id);
        return view('intro_site.parts.sub_category', compact('rows' , 'category'));
    }

    //products
    public function products($id)
    {
        if ($id == 'all' || $id == 'الكل') {
            $rows = Product::paginate(12);
            $category = [
                'name' =>  app()->getLocale() == 'en' ? 'All' : 'الكل',
            ];
            return view('intro_site.parts.products', compact('rows', 'category'));
        }
        $rows = Product::where('subcategory_id', $id)->paginate(12);
        $category = Category::find($id);
        return view('intro_site.parts.products', compact('rows', 'category'));
    }

    //images of product
    public function productsImages($id)
    {

        $rows = Product::findOrFail($id);
        return view('intro_site.parts.products_images', compact('rows'));
        //ajax
      /*  return response()->json([
            'title' => app()->getLocale() == 'en' ? $rowShow->getTranslations('title')['en'] : $rowShow->getTranslations('title')['ar'],
            'description' => app()->getLocale() == 'en' ? $rowShow->getTranslations('description')['en'] : $rowShow->getTranslations('description')['ar'],
            'subcategory' => app()->getLocale() == 'en' ? $rowShow->subCategory->getTranslations('name')['en'] : $rowShow->subCategory->getTranslations('name')['ar'],
            'firstMedia' => $rowShow->firstMedia->file_name ?? 'no-image.png',
            'media' => $rowShow->media,

        ]);*/

    }





}
