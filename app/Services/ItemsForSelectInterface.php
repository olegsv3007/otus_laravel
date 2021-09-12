<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

interface ItemsForSelectInterface
{
    function getItemsForSelect(): Collection;
}
