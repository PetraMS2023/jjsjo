<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Text::select('id', 'image')->first();
        return view('admin.parts.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $messages = [
            'image.required' => 'من فضلك ادخل الفديو',
        ];
        $this->validate($request, [
            'image' => 'required',
        ], $messages);
        $setting = Text::select('id', 'image')->first();
        $setting->update($request->all());
        alert()->success('تم تعديل الفديو بنجاح');
        return redirect()->back()->with('success', 'تم رفع الفديو بنجاح');
    }
}
