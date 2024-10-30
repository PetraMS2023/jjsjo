<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\update;
use App\Models\Address;
use App\Models\Text;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function aboutUs()
    {
        $row = Text::select('id', 'about_us')->first();
        return view('admin.About.index', compact('row'));
    }

    public function aboutUpdate(Request $request)
    {
        $this->validate($request, [
            'about.ar' => 'required',
            'about.en' => 'required',
        ]);
        $about = Text::select('id', 'about_us')->first();
        $about->update([
            'about_us' => $request->about,
        ]);
//        notify()->success('تم تعديل النص بنجاح');
        alert()->success('تم تعديل النص بنجاح');
        return redirect()->back();
    }

    public function conditions()
    {
        $row = Text::select('id', 'conditions')->first();
        return view('admin.Condition.index', compact('row'));
    }

    public function conditionsUpdate(Request $request)
    {
        $this->validate($request, [
            'conditions.ar' => 'required',
            'conditions.en' => 'required',
        ]);
        $about = Text::select('id', 'conditions')->first();
        $about->update([
            'conditions' => $request->conditions,
        ]);
//        notify()->success('تم تعديل النص بنجاح');
        alert()->success('تم تعديل النص بنجاح');
        return redirect()->back();
    }

    public function privacy()
    {
        $row = Text::select('id', 'privacy_policy')->first();
        return view('admin.Privacy.index', compact('row'));
    }

    public function privacyUpdate(Request $request)
    {
        $this->validate($request, [
            'privacy_policy.ar' => 'required',
            'privacy_policy.en' => 'required',
        ]);

        $privacy = Text::select('id', 'privacy_policy')->first();
        $privacy->update([
            'privacy_policy' => $request->privacy_policy,
        ]);
//        notify()->success('تم تعديل النص بنجاح');
        alert()->success('تم تعديل النص بنجاح');
        return redirect()->back();
    }

    //address
    public function address()
    {
        $row = Address::first();
        return view('admin.Addresses.index', compact('row'));
    }

    public function addressUpdate(update $request)
    {

        $address = Address::first();
        $address->update($request->validated());
        alert()->success('تم تعديل معلومات التواصل بنجاح');
        return redirect()->back();
    }
}
