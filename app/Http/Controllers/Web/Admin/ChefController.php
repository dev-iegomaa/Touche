<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\Admin\ChefInterface;
use App\Http\Requests\Admin\Chef\CreateChefRequest;
use App\Http\Requests\Admin\Chef\DeleteChefRequest;
use App\Http\Requests\Admin\Chef\EditChefRequest;

class ChefController extends Controller
{
    private $chefInterface;

    public function __construct(ChefInterface $interface)
    {
        $this->chefInterface = $interface;
    }

    public function index()
    {
        return $this->chefInterface->index();
    }

    public function create()
    {
        return $this->chefInterface->create();
    }

    public function store(CreateChefRequest $request)
    {
        return $this->chefInterface->store($request);
    }

    public function delete(DeleteChefRequest $request)
    {
        return $this->chefInterface->delete($request);
    }

    public function update($chef_id)
    {
        return $this->chefInterface->update($chef_id);
    }

    public function edit(EditChefRequest $request)
    {
        return $this->chefInterface->edit($request);
    }
}
