<?php
namespace App\Models\Traits;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redis;

trait LastLoginTime
{
    protected $lastLoginTimeHashKeyPrefix = 'last_login_time_hash_';

    public function recordLastLoginTime()
    {
        Redis::hSet($this->getLastLoginTimeHashKey(), "user_$this->id", now()->toDateTimeString());
    }

    public function getLastLoginTime()
    {
        return Redis::hGet($this->getLastLoginTimeHashKey(), "user_$this->id");
    }

    public function syncLastLoginTimeToDatabase($date = null)
    {
        if($date === null) {
            $date = Carbon::yesterday()->toDateString();
        }

        $hashKey = $this->getLastLoginTimeHashKey($date);
        $successNum = 0;
        if($all = Redis::hGetAll($hashKey)) {
            foreach($all as $key => $lastLoginTime) {
                $userId = explode('_', $key)[1];
                User::query()->find($userId)->update([
                    'last_login_time' => $lastLoginTime,
                ]);
                $successNum++;
            }
        }
        Redis::del($hashKey);
        return $successNum;
    }

    protected function getLastLoginTimeHashKey($date = null)
    {
        if($date === null) {
            $date = now()->toDateString();
        }
        return $this->lastLoginTimeHashKeyPrefix . $date;
    }
}
