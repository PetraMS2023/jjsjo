<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {

        $contacts = Contact::all();
        return view('admin.parts.contact', compact('contacts'));
    }

    //show
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.parts.Showcontact', compact('contact'));
    }

    //destroy
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id)->delete();
//        notify()->success('تم حذف الرسالة بنجاح');
        alert()->success('تم حذف الرسالة بنجاح');
        return redirect()->route('admin.contacts.index');
    }





}
