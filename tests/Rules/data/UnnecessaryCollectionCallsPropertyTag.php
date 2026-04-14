<?php

declare(strict_types=1);

namespace Tests\Rules\Data;

use App\Group;
use Illuminate\Support\Collection;

class UnnecessaryCollectionCallsPropertyTag
{
    /** @return Collection<int, mixed> */
    public function pluckNameWithPropertyTag(): Collection
    {
        return Group::all()->pluck('name');
    }
}
