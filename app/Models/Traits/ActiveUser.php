<?php
namespace App\Models\Traits;

use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

trait ActiveUser
{
    protected $activeDays = 7;

    protected $topicScore = 4;

    protected $replyScore = 1;

    protected $activeUserNumber = 8;

    protected $activeUsers = [];

    protected $activeUserExpireDays = 7;
    protected $activeUserCacheKey = 'active_user_cache';

    public function getActiveUser()
    {
        $this->calcTopicScore();
        $this->calcReplyScore();
        arsort($this->activeUsers);
        $activeUsers = collect();
        collect($this->activeUsers)->slice(0, $this->activeUserNumber)
            ->each(function($score, $userId) use($activeUsers) {
                if($user = User::query()->find($userId)) {
                    $activeUsers->push($user);
                }
            });
        return $activeUsers;
    }

    public function getActiveUserByCache()
    {
        return Cache::remember($this->activeUserCacheKey, now()->addDays($this->activeUserExpireDays), function() {
            return $this->getActiveUser();
        });
    }

    public function refreshActiveUserCache()
    {
        return Cache::put($this->activeUserCacheKey, $this->getActiveUser(), now()->addDays($this->activeUserExpireDays));
    }

    protected function calcTopicScore()
    {
        $topics = Topic::query()
                ->selectRaw('user_id, count(*) as topic_num')
                ->where('created_at', '>=', now()->subDays($this->activeDays))
                ->groupBy('user_id')
                ->get();

        foreach($topics as $topic)
        {
            $this->addScoreToActiveUsers($topic->user_id, $topic->topic_num * $this->topicScore);
        }
    }

    protected function calcReplyScore()
    {
        $replies = Reply::query()
                    ->selectRaw('user_id, count(*) as reply_num')
                    ->where('created_at', '>=', now()->subDays($this->activeDays))
                    ->groupBy('user_id')
                    ->get();

        foreach($replies as $reply)
        {
            $this->addScoreToActiveUsers($reply->user_id, $reply->reply_num * $this->replyScore);
        }
    }

    protected function addScoreToActiveUsers($userId, $score)
    {
        if(isset($this->activeUsers[$userId])) {
            $this->activeUsers[$userId] += $score;
        } else {
            $this->activeUsers[$userId] = $score;
        }
    }

}
