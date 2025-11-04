<?php

namespace App\Repositories\CategoryRepository;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function principalCategories ();
    public function allByMainCategory();
}
