<?php

namespace App\Http\Repositories\Web\Admin;

use App\Http\Interfaces\Web\Admin\ContactInterface;
use App\Http\Traits\ContactTrait;
use App\Models\ContactUs;
use function view;

class ContactRepository implements ContactInterface
{
    use ContactTrait;
    private $contactModel;

    public function __construct(ContactUs $contact)
    {
        $this->contactModel = $contact;
    }

    public function index()
    {
        $messages  = $this->getMessages();
        return view('Admin.contact.index',compact('messages'));
    }

    public function delete($request)
    {
        $this->getMessage($request->id)->delete();
    }
}
