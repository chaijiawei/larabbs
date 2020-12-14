<?php

namespace App\Observers;

use App\Models\Topic;
use Illuminate\Support\Str;
use App\Jobs\Slug as SlugJob;

class TopicObserver
{
    public function saving(Topic $topic)
    {
        $topic->body = clean($topic->body, 'topic');
        $topic->excerpt = $this->makeExcerpt($topic->body);
    }

    public function saved(Topic $topic)
    {
        if($topic->isDirty('title')) {
            dispatch(new SlugJob($topic));
        }
    }

    protected function makeExcerpt($body)
    {
        $body = preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($body));
        return Str::limit($body, 200);
    }

}
