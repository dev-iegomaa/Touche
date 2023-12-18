<?php

namespace App\Http\Repositories\Web\Admin;

use App\Http\Interfaces\Web\Admin\CategoryInterface;
use App\Http\Traits\CategoryTrait;
use App\Models\Category;
use function back;
use function redirect;
use function toast;
use function view;

class CategoryRepository implements CategoryInterface
{
    private $categoryModel;
    use CategoryTrait;

    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }

    public function index()
    {
        $categories = $this->categoryRecords();
        return view('Admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('Admin.category.create');
    }

    public function store($request)
    {
        $this->categoryModel::create($request->validated());
        toast('Category Was Created !','success');
        return redirect(route('admin.category.index'));
    }

    public function delete($request)
    {
        $category = $this->categoryRecord($request->id);
        $category->delete();
        toast('Category Was Deleted !','success');
        return back();
    }

    public function update($category_id)
    {
        $category = $this->categoryRecord($category_id);
        return view('Admin.category.edit', compact('category'));
    }

    public function edit($request)
    {
        $category = $this->categoryRecord($request->id);
        $category->update($request->validated());

        toast('Category Was Updated !','success');
        return redirect(route('admin.category.index'));
    }
}
