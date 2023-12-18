<?php

namespace App\Http\Repositories\Web\Admin;

use App\Http\Interfaces\Web\Admin\MenuInterface;
use App\Http\Traits\CategoryTrait;
use App\Http\Traits\Redis\MenuRedis;
use App\Models\Category;
use App\Models\Menu;
use function back;
use function redirect;
use function toast;
use function view;

class MenuRepository implements MenuInterface
{
    private $menuModel;
    private $categoryModel;
    use MenuRedis, CategoryTrait;

    public function __construct(Menu $menu, Category $category)
    {
        $this->menuModel = $menu;
        $this->categoryModel = $category;
    }

    public function index()
    {
        $menus = $this->getMenuFromRedis();
        return view('Admin.menu.index', compact('menus'));
    }

    public function create()
    {
        $categories = $this->categoryRecords();
        return view('Admin.menu.create', compact('categories'));
    }

    public function store($request)
    {
        $this->menuModel::create($request->validated());
        $this->setMenuToRedis();
        toast('Menu Was Created !','success');
        return redirect(route('admin.menu.index'));
    }

    public function delete($request)
    {
        $meal = $this->menuRecord($request->id);
        $meal->delete();
        $this->setMenuToRedis();
        toast('Menu Was Deleted !','success');
        return back();
    }

    public function update($menu_id)
    {
        $menu = $this->menuRecord($menu_id);
        $categories = $this->categoryRecords();
        return view('Admin.menu.edit', compact('menu','categories'));
    }

    public function edit($request)
    {
        $menu = $this->menuRecord($request->id);

        if (!is_null($request->body)) {
            $body = $request->body;
        }

        if (!is_null($request->category_id)) {
            $category_id = $request->category_id;
        }

        $menu->update([
            'title' => $request->title,
            'price' => $request->price,
            'body' => (isset($body)) ? $body : $menu->body,
            'category_id' => (isset($category_id)) ? $category_id : $menu->category_id
        ]);

        $this->setMenuToRedis();
        toast('Menu Was Updated !','success');
        return redirect(route('admin.menu.index'));
    }
}
