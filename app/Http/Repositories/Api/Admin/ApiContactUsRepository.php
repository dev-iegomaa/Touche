<?php

namespace App\Http\Repositories\Api\Admin;

use App\Http\Interfaces\Api\Admin\ApiContactUsInterface;
use App\Http\Traits\Api\apiResponse;
use App\Http\Traits\ContactTrait;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Validator;

class ApiContactUsRepository implements ApiContactUsInterface
{
    use apiResponse, ContactTrait;

    private $contactModel;
    public function __construct(ContactUs $contact)
    {
        $this->contactModel = $contact;
    }

    public function index()
    {
        $contacts = $this->getMessages();
        return $this->apiResponse(200, 'Contact Us Data :)', $contacts);
    }

    public function delete($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:contact_us,id'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error :)', $validator->errors());
        }

        $this->getMessage($request->id)->delete();
        return $this->apiResponse(200, 'Contact Data Was Deleted :)');
    }
}
