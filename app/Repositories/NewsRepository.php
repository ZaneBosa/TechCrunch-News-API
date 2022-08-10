<?php

namespace App\Repositories;

use App\Models\ArticlesCollection;

interface NewsRepository
{
    public function getAllByCategory(string $category): ArticlesCollection;
}