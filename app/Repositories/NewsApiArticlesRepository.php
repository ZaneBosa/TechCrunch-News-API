<?php

namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticlesCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class NewsApiArticlesRepository implements NewsRepository
{
    /**
     * @throws GuzzleException
     */
    public function getAll(): ArticlesCollection
    {
        $client = new Client();
        $response = $client->request('GET', $_ENV['NEWS_API_URL'] . '/top-headlines?sources=TechCrunch&apiKey=' . $_ENV['NEWS_API_KEY']);
        $body = $response->getBody();
        $apiResponse = json_decode($body);

        $articles = [];

        foreach ($apiResponse->articles as $article) {
            $articles[] = new Article(
                (string)$article->author,
                (string)$article->title,
                (string)$article->description,
                (string)$article->url,
                (string)$article->urlToImage
            );
        }

        return new ArticlesCollection($articles);
    }
}