<?php

namespace App\Services;

use App\Repositories\CategoryRepository\CategoryRepository;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    public $bagErrors;
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $bagErros = [];
        $this->categoryRepository = $categoryRepository;
    }

    public function allByMainCategory()
    {
        return $this->categoryRepository->allByMainCategory();
    }

    public function principalCategories()
    {
        return $this->categoryRepository->principalCategories();
    }

    public function store(array $data)
    {
        try {
            unset($data['nombre']);
            return $this->categoryRepository->create($data);
        } catch (\PDOException $exception) {
            Log::error($exception->getMessage());
            $this->bagErrors = 'ERROR AL GUARDAR DATOS';
            return false;
        }catch (\Exception $exception) {
            $this->bagErrors = $exception->getMessage();
        }
    }

    public function update()
    {

    }

    public function view()
    {

    }

    public function destroy()
    {

    }


}
