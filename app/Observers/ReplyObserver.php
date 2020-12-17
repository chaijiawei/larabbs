<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\ReplyNotify;

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'topic');
    }

    public function created(Reply $reply)
    {
        $reply->topic->updateReplyCount();

        $reply->topic->user->notify(new ReplyNotify($reply));
    }

    public function deleted(Reply $reply)
    {
        $reply->topic->updateReplyCount();
    }
}
