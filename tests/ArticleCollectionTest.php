<?php

use App\Models\Article;
use App\Models\ArticlesCollection;

test('Article works perfectly', function() {

    $collection = new ArticlesCollection([
        new Article('Codelex', 'abc', 'good one','https://codelex.io'),
        new Article('Google', 'def', 'good one too','https://google.com'),
        new Article('Draugiem', 'ghi', 'another good one','https://draugiem.lv'),
    ]);
    expect(count($collection->getAll()))->toBe(3);

});