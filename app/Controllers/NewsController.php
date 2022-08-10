<?php

namespace App\Controllers;

use App\Models\ArticlesCollection;
use App\Services\ShowAllArticlesService;
use App\Views\TwigView;

class NewsController
{
    private ShowAllArticlesService $service;

    public function __construct(ShowAllArticlesService $service)
    {
        $this->service = $service;
    }


    public function show(): TwigView
    {
        $category = $_GET['category'] ?? 'TechCrunch';
        return new TwigView('news-headline-index.html', [
            'articles' => $this->service->execute($category)->getAll()
        ]);
    }

    public function create(ArticlesCollection $service) :TwigView
    {
        //$_GET
        //$_POST
        return new View('create-article');
    }
    public function  store(): void
    {

    }
}