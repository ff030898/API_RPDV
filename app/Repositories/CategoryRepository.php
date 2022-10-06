<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRepository
{
    protected $entity;

    public function __construct(Category $category)
    {
        $this->entity = $category;
    }

    public function getAll()
    {
        return $this->entity->all();
    }

    public function getCategory(string $identify)
    {
        $category = $this->entity::where('id', $identify)->first();
        return $category;
    }

    public function createNew(Request $data)
    {
        $category = new Category();

        // image upload
        if ($data->hasFile('img')) {

            $allowedfileExtension = ['jpg', 'png'];
            $file = $data->file('img');
            $extenstion = $file->getClientOriginalExtension();
            $check = in_array($extenstion, $allowedfileExtension);

            if ($check) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move('images/categories', $name);
                $category->img = $name;
            }
        }

        $category->desc = $data->input('desc');

        $category->save();

        return $category;
    }

    public function update(string $identify, Request $data)
    {

        $category = $this->getCategory($identify);

        if ($data->hasFile('img')) {

            $allowedfileExtension = ['jpg', 'png'];
            $file = $data->file('img');
            $extenstion = $file->getClientOriginalExtension();
            $check = in_array($extenstion, $allowedfileExtension);

            if ($check) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move('images/categories', $name);
                $category->img = $name;
            }
        }


        $category->desc = $data->input('desc');

        $category->save();

        return $category;
    }

    public function delete(string $identify)
    {
        $category = $this->getCategory($identify);

        return $category->delete();
    }
}
