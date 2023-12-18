<?php

namespace App\Http\Repositories\Api\Admin;

use App\Http\Interfaces\Api\Admin\ApiCategoryInterface;
use App\Http\Traits\Api\apiResponse;
use App\Http\Traits\CategoryTrait;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ApiCategoryRepository implements ApiCategoryInterface
{
    use apiResponse, CategoryTrait;
    private $categoryModel;

    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }

    public function index()
    {
        $categories = $this->categoryRecords();
        return $this->apiResponse(200,'Category Data',$categories);
    }

    public function create($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422,'Validation Error :(', null, $validator->errors());
        }

        $category = $this->categoryModel::create([
            'name' => $request->name
        ]);

        return $this->apiResponse(200,'Category Was Created :)',$category);

    }

    public function delete($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422,'Validation Error :(', null, $validator->errors());
        }

        $this->categoryRecord($request->id)->delete();

        return $this->apiResponse(200,'Category Was Deleted :)');
    }

    public function update($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:categories,id',
            'name' => 'required|unique:categories,name,' . $request->id
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422,'Validation Error :(', null, $validator->errors());
        }

        $this->categoryRecord($request->id)->update([
            'name' => $request->name
        ]);

        return $this->apiResponse(200,'Category Was Updated :)');
    }
}
