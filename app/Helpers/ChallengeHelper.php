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
        // if ($challenge->level > count(config('challenge.levels'))) {
        //     throw new \Exception("invalid level: {$challenge->level}");
        // }
        $config = config('challenge.levels')[$challenge->level] ?? null;
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

    static public function stats()
    {
        return [
            ['label' => __('Register Consumers'),   'value' => User::where('level', User::REGISTER_CONSUMER)->count()],
            ['label' => __('Partner Consumers'),    'value' => User::where('level', User::PARTNER_CONSUMER)->count()],
            ['label' => __('Challengers'),          'value' => Challenge::whereIn('status', [Challenge::APPLYING, Challenge::CHALLENGING])->count()],
            ['label' => __('Successed Challengers'),'value' => Challenge::where('status', Challenge::SUCCESS)->orWhere('level', '>', User::CONSUMER_MERCHANT)->count()]
        ];
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

    static public function getRank(Challenge $challenge)
    {
        $res = Db::select("select count(id) as total from challenges where status ='challenging';");
        $total = $res[0]->total;

        $sql = "select row_num from (
                    SELECT row_number() over (order by level desc, id asc) row_num, id, level
                    FROM challenges
                    where status ='challenging'
                    order by level desc, id asc
                    ) as t
                    where t.id={$challenge->id};";
        $res = DB::select($sql);
        $rank = $res[0]->row_num ?? null;

        $behind = $total - $rank;

        $str = str_replace(
                ["{total}", "{rank}", "{behind}"],
                [$total, $rank, $behind],
                config("challenge.ranking.overview")
            );

        $percent = $rank * 100 / $total;
        return [
            "percent" => $percent,
            "text" => $str
        ];
    }
}
