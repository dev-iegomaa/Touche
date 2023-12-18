<?php

namespace App\Http\Repositories\Api\Admin;

use App\Http\Interfaces\Api\Admin\ApiChefInterface;
use App\Http\Traits\Api\apiResponse;
use App\Http\Traits\Redis\ChefRedis;
use App\Models\Chef;
use Illuminate\Support\Facades\Validator;

class ApiChefRepository implements ApiChefInterface
{

    use ChefRedis, apiResponse;

    private $chefModel;
    public function __construct(Chef $chef)
    {
        $this->chefModel = $chef;
    }

    public function index()
    {
        $chefs = $this->getChefFromRedis();
        return $this->apiResponse(200,'Chef Data :)', $chefs);
    }

    public function create($request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'image'         => 'required|mimes:png,jpg,jpeg,webp',
            'description'   => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error :)', null, $validator->errors());
        }

        $imageName = $this->uploadImage($request->image,'chef');

        $chef = $this->chefModel::create([
            'name'          => $request->name,
            'description'   => $request->description,
            'image'         => $imageName,
        ]);

        $this->setChefToRedis();
        return $this->apiResponse(200, 'Chef Was Created :)', $chef);
    }

    public function delete($request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:chefs,id',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error :)', null, $validator->errors());
        }

        $this->chefRecord($request->id)->delete();

        $this->setChefToRedis();
        return $this->apiResponse(200, 'Chef Was Deleted :)');
    }

    public function update($request)
    {
        $validator = Validator::make($request->all(), [
            'id'            => 'required|exists:chefs,id',
            'description'   => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(422, 'Validation Error :)', null, $validator->errors());
        }

        $chef = $this->chefRecord($request->id);

        if (!is_null($request->image)) {
            $imageName = $this->uploadImage($request->image,'chef', $chef->image);
        }

        $chef->update([
            'name'          => $chef->name,
            'description'   => $request->description,
            'image'         => (isset($imageName)) ? $imageName : $chef->getRawOriginal('image')
        ]);

        $this->setChefToRedis();
        return $this->apiResponse(200, 'Chef Was Updated :)', $chef);
    }

}
