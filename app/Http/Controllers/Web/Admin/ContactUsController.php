<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\Admin\ContactInterface;
use App\Http\Requests\Admin\ContactUs\ContactRequest;
use function redirect;
use function toast;

class ContactUsController extends Controller
{
    private $contactInterface;
    public function __construct(ContactInterface $interface)
    {
        $this->contactInterface = $interface;
    }

    public function index()
    {
        return $this->contactInterface->index();
    }

    public function delete(ContactRequest $request)
    {
        $this->contactInterface->delete($request);
        toast('contact Was Deleted !','success');
        return redirect(route('admin.contact.index'));
    }

}
