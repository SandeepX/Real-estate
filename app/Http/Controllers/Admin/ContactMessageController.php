<?php

namespace App\Http\Controllers\Admin;

use App\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactMessageController extends Controller
{
    //
    public function getAllContactMessages(){

        $messages = ContactMessage::latest()->get();

        return view('admin.pages.messages.contact.index',compact('messages'));
    }

    public function viewSingleMessage($id){

        $message= ContactMessage::findOrFail($id);

        return view('admin.pages.messages.contact.single',compact('message'));
    }
}
