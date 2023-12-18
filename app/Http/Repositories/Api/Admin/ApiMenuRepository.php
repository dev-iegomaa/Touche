<?php

namespace App\Http\Repositories\Api\Admin;

use App\Http\Interfaces\Api\Admin\ApiMenuInterface;
use App\Http\Traits\Api\apiResponse;
use App\Http\Traits\Redis\MenuRedis;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;

class ApiMenuRepository implements ApiMenuInterface
{

    use apiResponse, MenuRedis;

    private $menuModel;
    public function __construct(Menu $menu)
    {
        $this->menuModel = $menu;
    }

    public function index()
    {
        $menus = $this->getMenuFromRedis();
        return $this->apiResponse(200, $menus);
    }

    public function create($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:menus,title',
            'body' => 'required',
            'price' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error :)', null, $validator->errors());
        }

        $menu = $this->menuModel::create([
            'title' => $request->title,
            'body' => $request->body,
            'price' => $request->price,
            'category_id' => $request->category_id
        ]);
        return $this->apiResponse(200, 'Menu Was Created :)', $menu);
    }

    public function delete($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:menus,id',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error :)', null, $validator->errors());
        }

        $this->menuRecord($request->id)->delete();
        return $this->apiResponse(200, 'Menu Was Deleted :)');
    }

    public function update($request)
    {
        $validator = Validator::make($request->all(), [
            'id'    => 'required|exists:menus,id',
            'title' => 'required|unique:menus,title,' . $request->id,
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error :)', null, $validator->errors());
        }

        $menu = $this->menuRecord($request->id);

        $menu->update([
            'title'         => $request->title,
            'price'         => $request->price,
            'body'          => (!is_null($request->body)) ? $request->body : $menu->body,
            'category_id'   => (!is_null($request->category_id)) ? $request->category_id : $menu->category_id
        ]);

        return $this->apiResponse(200, 'Menu Was Updated :)');
    }
}
