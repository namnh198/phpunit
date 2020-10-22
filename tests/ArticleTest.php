<?php

namespace Tests;

use App\Article;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{

    protected $article;

    public function setUp() : void
    {
        $this->article = new Article;
    }

    public function tearDown() : void
    {
        $this->article = null;
    }

    public function testTitleIsEmptyByDefault()
    {
        $this->assertEmpty($this->article->title);
    }

    public function testSlugIsEmptyWithNoTitle()
    {
        $this->assertSame($this->article->getSlug(), '');
    }

    public function getTitleProvider()
    {
        return [
            'Slug Has Spaces Replaced By Underscores' => [
                "An example article",
                "An_example_article"
            ],
            'Slug Has Whitespace Replaced By Single Underscore' => [
                "An    example    \n    article",
                "An_example_article"
            ],
            'Slug Does Not Start Or End With An Underscore' => [
                " An example article ",
                "An_example_article"
            ],
            'Slug Does Not Have Any Non Word Characters' => [
                "Read! This! Now!",
                "Read_This_Now"
            ]
        ];
    }

    /**
     * @dataProvider getTitleProvider
     */
    public function testSlug($title, $slug)
    {
        $this->article->title = $title;

        $this->assertSame($this->article->getSlug(), $slug);
    }
}
