<?php
namespace App\Helpers;
use App\Models\User;
use App\Models\Challenge;
use App\Wechat;
use DB;

class ChallengeHelper
{
    static public function makeSuccess($challenge)
    {
        $challenge->update(['status' => Challenge::SUCCESS, 'success_at' => now()]);

        // update user's level
        $challenge->user->update(['level' => $challenge->level]);
    }

    static public function checkSuccess($challenge)
    {
        echo __FUNCTION__." $challenge->id \n";
        // $challenge->user
        if ($challenge->level > count(config("challenge"))) {
            throw new \Exception("invalid level: {$challenge->level}");
        }
        $config = config("challenge")[$challenge->level - 1] ?? null;
        if (!$config) {
        }
        // var_dump($config);
        echo "\t total team members: ".UserHelper::totalTeamMembers($challenge->user)."\n";
        echo "\t recommends ".$challenge->user->recommends->count()."\n";
        if (UserHelper::totalTeamMembers($challenge->user) >= $config['total_team_members']
            && $challenge->user->recommends->count() >= $config['recommend_members']) {
                echo "success, make success\n";
                self::makeSuccess($challenge);
        }
    }

    static public function range()
    {
        $str = cache1("challenge-range", function(){
            $res = DB::table('challenges as c')
                ->join("users as u", "u.id", "=", "c.user_id")
                ->selectRaw("u.id, u.nickname, u.mobile, c.level, c.success_at")
                ->where('c.status', '=', Challenge::SUCCESS)
                ->orderByDesc("level")
                ->orderBy("success_at")
                ->limit(10)
                ->get();
                // ->toArray();
            $data = [];
            $i=1;
            foreach ($res as $item) {
                $data[]  =[
                    'index' => $i++,
                    'label' => ($item->nickname ?? $item->mobile) . User::levelOptions()[$item->level],
                    'value' => $item->success_at
                ];
            }
            return $data;
            }, 3600 * 24);

        return json_decode($str);
    }


    // 'recommend_members' => 10,
    // 'total_team_members' => 100,
    // 'rules' => "	召集10个消费者合伙人，晋级为消费者服务商，简称：消费商。",
    // 'rules' => "	消费者总人数达100人，且保持10个消费者，晋升为社区服务站经理。",
    // 'rules' => "	消费者总人数达1000+1人，且发起20个消费者，晋升为县级运营中心总监。",
    // 'rules' => "	消费者总人数达10000+1人，且发起30个消费者，晋升为县级子公司。",
    // 'rules' => "	消费者总人数达100000+1人，且发起50个消费者，晋升为地级子公司。",
    // 'rules' => "	消费者总人数达1000000+1人，且发起100个消费者，晋升为省级巡视。",
}
