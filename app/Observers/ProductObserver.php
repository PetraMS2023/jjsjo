<?php

namespace App\Observers;

use App\Models\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        if ($product->media()->count()) {
            foreach ($product->media as $media) {
                $path = base_path() . '/public/storage/images/products/' . $media->file_name;
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
        }
        $product->media()->delete();



    }


    public function saved(Product $product)
    {


        if (request()->has('images') && count(request()->images)) {
            $i = 1;
            foreach (request()->images as $image) {
                $file_name = $product->slug . '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                $file_type = $image->getMimeType();
                $file_path = 'products';
                $path = base_path() . '/public/storage/images/products/' . $file_name ;

                //تخذين  الصور بكامل جودتها وحجمها
                Image::make($image->getRealPath())->save($path, 100);

                $product->media()->create([
                    'file_name' => $file_name,
                    'file_type' => $file_type,
                    'file_path' => $file_path,
                    'file_sort' => $i,
                ]);
                $i++;
            }
        }
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
