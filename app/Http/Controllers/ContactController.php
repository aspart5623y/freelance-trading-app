<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Repository\ContactRepository;


class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }


    public function store(ContactRequest $request)
    {
        $ContactRepository = new ContactRepository();
        $store = $ContactRepository->store($request->all());
        if ($store) {
            return back()->with('success', 'Your complaint has been sent. Our admin would get back to via the email you provided.');
        } else {
            return back()->with('error', 'An unexpected error occured.');
        }
    }
}
