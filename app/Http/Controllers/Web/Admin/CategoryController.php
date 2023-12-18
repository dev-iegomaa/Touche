<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Web\Admin\CategoryInterface;
use App\Http\Requests\Admin\Category\CategoryRequest;
use App\Http\Requests\Admin\Category\DeleteCategoryRequest;

class CategoryController extends Controller
{
    private $categoryInterface;

    public function __construct(CategoryInterface $interface)
    {
        $this->categoryInterface = $interface;
    }

    public function index()
    {
        return $this->categoryInterface->index();
    }

    public function create()
    {
        return $this->categoryInterface->create();
    }

    public function store(CategoryRequest $request)
    {
        return $this->categoryInterface->store($request);
    }

    public function delete(DeleteCategoryRequest $request)
    {
        return $this->categoryInterface->delete($request);
    }

    public function update($category_id)
    {
        return $this->categoryInterface->update($category_id);
    }

    public function edit(CategoryRequest $request)
    {
        return $this->categoryInterface->edit($request);
    }
}
