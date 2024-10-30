<?php

namespace App\Exports;

use App\Models\Product;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportProducts implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'id',
            'Title Arabic',
//            'Title English',
            'Description Arabic',
//            'Description English',
            'Category name',
            'Sub Category name',
            'Created at',
            'Updated at',
        ];
    }

    public function collection()
    {
        $products = Product::all();
        $data =  [];
        foreach ($products as $product) {
            $data[] = [
                'id' => $product->id,
                'title_ar' => $product->getTranslation('title', 'ar'),
//                'title_en' => $product->getTranslation('title', 'en'),
                'description_ar' => $product->getTranslation('description', 'ar'),
//                'description_en' => $product->getTranslation('description', 'en'),
                'category_name' => $product->category->name,
                'sub_category_name' => $product->subCategory->name,
                'created_at' => $product->created_at->format('Y-m-d'),
                'updated_at' => $product->updated_at->format('Y-m-d'),
            ];
        }
        return collect($data);
    }
}

