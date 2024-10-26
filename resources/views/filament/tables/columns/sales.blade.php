<?php use App\Models\User;?>
<span>
    {{User::respOptions()[$getState()] ?? null}}
</span>
