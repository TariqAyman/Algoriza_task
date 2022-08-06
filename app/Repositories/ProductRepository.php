<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\AbstractRepository\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository
{
    /**
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Builder[]|Collection
     */
    public function getLatest()
    {
        return $this->model::query()->latest()->get();
    }

    /**
     * @param $validated
     * @return void
     */
    public function create($validated)
    {
        $data = $validated->all();

        $data['image'] = $this->uploadImage($validated);

        $this->store($data);
    }

    /**
     * @param $id
     * @param $validated
     * @return void
     */
    public function updateWithImage($id, $validated)
    {
        $data = $validated->all();

        if ($validated->hasFile('image')) {
            $data['image'] = $this->uploadImage($validated);
        }

        $this->update($id, $data);
    }

    /**
     * @param $image
     * @return string
     */
    private function uploadImage($image)
    {
        $uploadedFile = $image->file('image');

        $filename = time() . md5(time() . $uploadedFile->getClientOriginalName()) . ".{$uploadedFile->getClientOriginalExtension()}";

        $uploadedFile->move('uploads/products/images', $filename);

        return 'uploads/products/images/' . $filename;
    }

    /**
     * @param int $countPerPage
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginateWithSearch(int $countPerPage, Request $request)
    {
        $query = $this->model::query();

        if ($request->has('category')) {
            $query = $query->where('category_id', $request->get('category'));
        }

        return $query->paginate($countPerPage);
    }
}
