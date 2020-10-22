<?php

namespace App;

class Article
{
    public $title;

    public function getSlug()
    {
        $slug = $this->title;
        $slug = preg_replace('/[^\w]+/', '_', $slug);
        $slug = preg_replace('/\s+/', '_', $slug);
        $slug = trim($slug, '_');

        return $slug;
    }
}
