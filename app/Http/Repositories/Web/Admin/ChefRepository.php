<?php

namespace App\Http\Repositories\Web\Admin;

use App\Http\Interfaces\Web\Admin\ChefInterface;
use App\Http\Traits\Redis\ChefRedis;
use App\Models\Chef;
use function back;
use function redirect;
use function toast;
use function view;

class ChefRepository implements ChefInterface
{
    private $chefModel;
    use ChefRedis;

    public function __construct(Chef $chef)
    {
        $this->chefModel = $chef;
    }

    public function index()
    {
        $chefs = $this->getChefFromRedis();
        return view('Admin.chef.index', compact('chefs'));
    }

    public function create()
    {
        return view('Admin.chef.create');
    }

    public function store($request)
    {
        $imageName = $this->uploadImage($request->image, 'chef');
        $this->chefModel::create([
            'image' => $imageName,
            'name' => $request->name,
            'description' => $request->description
        ]);

        $this->setChefToRedis();
        toast('chef Was Created !','success');
        return redirect(route('admin.chef.index'));
    }

    public function delete($request)
    {
        $chef = $this->chefRecord($request->id);
        unlink(public_path($chef->image));

        $chef->delete();
        $this->setChefToRedis();
        toast('chef Was Deleted !','success');
        return back();
    }

    public function update($chef_id)
    {
        $chef = $this->chefRecord($chef_id);
        return view('Admin.chef.edit', compact('chef'));
    }

    public function edit($request)
    {
        $chef = $this->chefRecord($request->id);
        $file = $request->image;

        if (!is_null($request->image)) {
            $imageName = $this->uploadImage($file, 'chef', $chef->image);
        }

        $chef->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => (isset($imageName)) ? $imageName : $chef->getRawOriginal('image')
        ]);

        $this->setChefToRedis();
        toast('chef Was Updated !','success');
        return redirect(route('admin.chef.index'));
    }
}
