<?php use App\Models\Challenge;?>
<span class="{{[
    Challenge::APPLYING      => 'text-gray-600',
    Challenge::CHALLENGING   => 'text-primary-600',
    Challenge::SUCCESS       => 'text-primary-600',
    Challenge::CANCELED      => 'text-danger-600'
][$getState()]}}">
    {{Challenge::statusOptions()[$getState()]}}
</span>
