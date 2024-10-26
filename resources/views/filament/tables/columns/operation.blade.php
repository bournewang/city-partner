<?php use App\Models\User;?>
<span>
    {{User::operationOptions()[$getState()] ?? null}}
</span>
