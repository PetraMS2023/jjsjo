<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\JobsStoreRequest;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Jops;

class HomeContactController extends Controller
{
    public function index()
    {
        $address = Address::first();
        return view('intro_site.parts.contact', compact('address'));
    }

    //store
    public function store(ContactStoreRequest $request)
    {
        Contact::create($request->validated());
        alert()->success(__('site.Message Sent Successfully'),__('site.Success'));
        return redirect()->route('contact');
    }

    //jobs
    public function jobs()
    {
        return view('intro_site.parts.jobs');
    }

    //storeJobs
    public function storeJobs(JobsStoreRequest $request)
    {

        Jops::create($request->validated());
        alert()->success(__('site.Message Sent Successfully'),__('site.Success'));
        return redirect()->route('jobs');
    }

}
