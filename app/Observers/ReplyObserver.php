<?php

namespace App\Observers;

use App\Models\Reply;

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
    }
}
