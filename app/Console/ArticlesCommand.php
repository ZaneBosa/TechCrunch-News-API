<?php

namespace App\Console;

use App\Models\Article;
use App\Services\ShowAllArticlesService;

class ArticlesCommand
{
    private ShowAllArticlesService $service;

    public function __construct(ShowAllArticlesService $service)
    {
        $this->service = $service;
    }

    public function execute(string $category): int
    {
        /** @var Article[] $articles */
        $articles = $this->service->execute($category)->getAll();

        foreach ($articles as $article) {
            echo $article->getTitle() . PHP_EOL;
        }


            return 0;
    }
}