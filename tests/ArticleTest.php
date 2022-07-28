<?php

use App\Models\Article;

test('Articles collection works perfectly', function() {
    $article = new Article('Codelex', 'abc', 'good one','https://codelex.io');

    expect($article->getAuthor())->toBe('Codelex');
    expect($article->getTitle())->toBe('abc');
    expect($article->getDescription())->toBe('good one');
    expect($article->getUrl())->toBe('https://codelex.io');
});