<?php
use App\Models\User;
use App\Models\Challenge;
return [
    "ranking" => [
        "overview" => "共有{total}名挑战者参与，<br/>您处在{rank}位，您后面还有{behind}位挑战者。<br/>请继续努力。"
    ],
    "status" => [
        Challenge::APPLYING     => ["icon" => "time", "text" => "您的挑战已提交，请您耐心等待审核通过。"],
        Challenge::CHALLENGING  => ["icon" => "rocket", "text" => "您的挑战资格已确认。<br/>目前等级为{level}，正在挑战{new_level}。<br/>可截屏保存下面推荐码转发该给其他人开始挑战。"],
        Challenge::SUCCESS      => ["icon" => "check-circle", "text" => null],
        Challenge::CANCELED     => ["icon" => "close-octagon", "text" => "您已挑战资格已取消。"]
    ],
    "levels" => [
        User::NONE_REGISTER => [
            'level' => User::NONE_REGISTER,
            'label' => "未注册用户" // user only have openid
        ],
        User::REGISTER_CONSUMER => [
            'level' => User::REGISTER_CONSUMER,
            'label' => "消费者",   // register consumer
            'icon' => 'user',
        ],
        User::PARTNER_CONSUMER => [
            'level' => User::PARTNER_CONSUMER,
            'label' => "入伙消费者",   // partner Consumer
            'icon' => 'user',
        ],
        User::CONSUMER_MERCHANT => [
            'level' => User::CONSUMER_MERCHANT,
            'label' => "消费商",
            'icon' => 'user',
            'recommend_members' => 10,
            'total_team_members' => 10,
            'rules' => "	召集10个消费者合伙人，晋级为消费者服务商，简称：消费商。",
            "success_text" => "	您已具备成为消费商资格，是否选择进一步提升为一级身份待遇。",
            "bonus_text" => "（一）【消费商身份】经营权<br/>
    ①　线下城市合伙人：在成功完成挑战后，您将获得成为线下《消费者合作社》发起人的资格。取得消费商身份，您将能够在线上开设O2O网店。<br/>
    ②　在挑战过程中，如果参与者选择中途退出，我们将在七个工作日内全额退还挑战金。<br/>
    （二）【消费商身份】收益权 <br/>
    ②　线下城市合伙人：消费商召集消费者合伙人终身享受的团购消费0.5%通路服务费。
    "
        ],
        User::COMMUNITY_STATION => [
            'level' => User::COMMUNITY_STATION,
            'label' => "社区服务站",
            'icon' => 'usergroup',
            'recommend_members' => 10,
            'total_team_members' => 100,
            'rules' => "	消费者总人数达100人，且保持10个消费者，晋升为社区服务站经理。",
            "success_text" => "	您已具备一级社区服务站经理的资格，是否考虑进一步晋升为二级身份待遇。",
            "bonus_text" => "（一）【经理身份】经营权授权<br/>
    ①　线上城市合伙人：在成功完成挑战后，您将获得线上开设O2O网点的资格。作为消费商身份，享受1年免费期线上开设社区O2O网店。<br/>
    ②　在挑战过程中，如果参与者选择中途退出，我们将在七个工作日内全额退还挑战金。<br/>
    （二）【经营身份】收益权<br/>
    ①　线下城市合伙人：消费商召集消费者合伙人终身享受的团购消费0.5%通路服务费。
    "
        ],
        User::RUN_CENTER_DIRECTOR => [
            'level' => User::RUN_CENTER_DIRECTOR,
            'label' => "商业运营中心",
            'icon' => 'user-avatar',
            'recommend_members' => 20,
            'total_team_members' => 1000,
            'rules' => "	消费者总人数达1000+1人，且发起20个消费者，晋升为县级运营中心总监。",
            "success_text" => "	恭喜您成功完成了挑战。根据挑战者的排名顺序，我们将为排名前2000名的挑战者颁发奖励。您将以县级运营中心总监的身份依次获得奖励。<br/>
    	如果您决定继续接受挑战，本轮将视为您主动放弃总监本轮奖金，并晋升为四等级身份待遇，即挑战县级子公司总经理。",
            "reject_text" => "您已选择放弃晋级挑战，本轮您将享受总裁身份待遇，本轮依照挑战者排序为前20个挑战者发放奖励。",
            "bonus_text" => "（一）【总监身份】经营权授权<br/>
    ①　线上城市合伙人：成功完成挑战后，将获得线上城市合伙人资格。总监身份待遇，可以在线上全网设立O2O网点。<br/>
    ②　线下城市合伙人：成功完成挑战也可转为线下成为城市合伙人的资格，级别降低一级。总监身份待遇，可以在全国范围内选择任意县级单位设立社区服务站。<br/>
    （二）【总监身份】创业扶助奖励规则：<br/>
    每当全网认证消费者数量达到10万+20位的整数时，公司将给予最高300万元的奖励，其中<br/>
    ①　【总监2000位（每人500元，总计100万）】
    "
        ],
        User::COUNTY_MANAGER => [
            'level' => User::COUNTY_MANAGER,
            'label' => "县级子公司",
            'icon' => 'user-list',
            'recommend_members' => 30,
            'total_team_members' => 10000,
            'rules' => "	消费者总人数达10000+1人，且发起30个消费者，晋升为县级子公司。",
            "success_text" => "	恭喜您成功完成了挑战。根据挑战者的排名顺序，我们将为排名前200名的挑战者颁发奖励。您将以县级子公司总经理的身份依次获得奖励。<br/>
    	如果您决定继续接受挑战，本轮将视为您主动放弃总经理本轮奖金，并晋升为五等级身份待遇，即挑战地级子公司总裁。",
            "reject_text" => "您已选择放弃晋级挑战，本轮您将享受总裁身份待遇，本轮依照挑战者排序为前20个挑战者发放奖励。",
            "bonus_text" => "（一）【总经理身份】经营权授权<br/>
    ①　线上城市合伙人：成功完成挑战后，将获得线上城市合伙人资格。总经理身份待遇，可以在线上全网设立地级经销商。<br/>
    ②　线下城市合伙人：成功完成挑战也可转为线下成为城市合伙人的资格，级别降低一级。总经理身份待遇，可以在全国范围内选择任意县级运营中心。<br/>
    （二）【总经理身份】创业扶助奖励规则：<br/>
    每当全网认证消费者数量达到10万+20位的整数时，公司将给予最高300万元的奖励。我们将为这些挑战者提供以下奖励：<br/>
    ①　【董事2位（每人50万元，总计100万元）】 <br/>
    ②　总裁20位（每人5万元，总计100万元）<br/>
    <view class='red-text' style='color: red;'>③　总经理200位（每人5000元，总计100万）</view> <br/>
    "
        ],
        User::AREA_PRESIDENT => [
            'level' => User::AREA_PRESIDENT,
            'label' => "地级子公司",
            'icon' => 'user-setting',
            'recommend_members' => 50,
            'total_team_members' => 100000,
            'rules' => "	消费者总人数达100000+1人，且发起50个消费者，晋升为地级子公司。",
            "success_text" => "<div>	恭喜您成功完成了挑战。根据挑战者的排名顺序，我们将为排名前20名的挑战者颁发奖励。您将以地级子公司总裁的身份依次获得奖励。<br>
    	如果您决定继续接受挑战，本轮将视为您主动放弃总裁本轮奖金，并晋升为六等级身份待遇，即挑战省级巡视执行长。</div>",
            "reject_text" => "您已选择放弃晋级挑战，本轮您将享受总裁身份待遇，本轮依照挑战者排序为前20个挑战者发放奖励。",
            "bonus_text" => "<div>（一）【总裁身份】经营权授权<br/>
    ①　线上城市合伙人：成功完成挑战后，将获得线上城市合伙人资格。总裁身份待遇，可以在线上全网设立地级经销商。<br/>
    ②　线下城市合伙人：成功完成挑战也可转为线下成为城市合伙人的资格，级别降低一级。总裁身份待遇，可以在全国范围内选择任意县级市设立县级子公司。<br/>
    （二）【总裁身份】创业扶助三级奖励规则：<br/>
    每当全网认证消费者数量达到10万+20位的整数时，公司将给予最高300万元的奖励。我们将为这些挑战者提供以下奖励：<br/>
    <view style='color:red;'>①　【董事2位（每人50万元，总计100万元）】</view><br/>
    <p><font color='red'>②　总裁20位（每人5万元，总计100万元）</font></p>
    ③　总经理200位（每人5000元，总计100万）</dir>
    "
        ],
        User::PROVINCE_CEO => [
            'level' => User::PROVINCE_CEO,
            'label' => "省级巡视长",
            'icon' => 'user-checked-1',
            'recommend_members' => 100,
            'total_team_members' => 1000000,
            'rules' => "	消费者总人数达1000000+1人，且发起100个消费者，晋升为省级巡视。",
            "success_text" => "	恭喜您成功完成了挑战。根据挑战者的排名顺序，我们将为排名前2位的挑战者颁发奖励。您将以省级巡视执行长的身份依次获得奖励。",
            "bonus_text" => "（一）【董事身份】经营权授权规则<br/>
    ①　线上城市合伙人：成功完成挑战后，将获得线上城市合伙人资格。董事身份待遇，可以在线上全网设立省级经销商。<br/>
    ②　线下城市合伙人：成功完成挑战也可转为线下成为城市合伙人的资格，级别降低一级。董事身份待遇，可以在全国范围内选择任意地级市设立县级子公司。<br/>
    （二）【董事身份】创业扶助奖励规则：<br/>
    每当全网认证消费者数量达到100万+2位的整数时，公司将给予最高300万元的奖励。我们将为这些挑战者提供以下奖励：<br/>
    <view class='red-text' style='color: red;'>①　【董事2位（每人50万元，总计100万元）】</view><br/>
    ②　总裁20位（每人5万元，总计100万元）<br/>
    ③　总经理200位（每人5000元，总计100万）
    "
        ],
    ]
];
