<?php

namespace App\Repositories\CategoryRepository;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Categoria $category
     */
    public function __construct(Categoria $category)
    {
        $this->model = $category;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        if (null == $category = $this->model->find($id)) {
            throw new ModelNotFoundException("Post not found");
        }

        return $category;
    }

    public function principalCategories ()
    {
        return $this->model->whereNull('categoria_padre_id')->get();
    }

    public function allByMainCategory()
    {
        return $this->model->with('categoriaPadre')->ordenadas()->get();
    }
}
