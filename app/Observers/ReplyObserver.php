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
        $replyCount = $reply->topic->replies()->count();
        $reply->topic->update([
            'reply_count' => $replyCount,
        ]);

        $reply->topic->user->notify(new ReplyNotify($reply));
    }
}
