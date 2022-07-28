<?php

namespace App\Controllers;

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
        return new TwigView('news-headline-index.html', [
            'articles' => $this->service->execute()->getAll()
        ]);
    }
}