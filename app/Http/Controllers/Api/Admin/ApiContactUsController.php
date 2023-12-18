<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Api\Admin\ApiContactUsInterface;
use Illuminate\Http\Request;

class ApiContactUsController extends Controller
{

    private $contactInterface;
    public function __construct(ApiContactUsInterface $interface)
    {
        $this->contactInterface = $interface;
    }

    public function index()
    {
        return $this->contactInterface->index();
    }

    public function delete(Request $request)
    {
        return $this->contactInterface->delete($request);
    }

}
