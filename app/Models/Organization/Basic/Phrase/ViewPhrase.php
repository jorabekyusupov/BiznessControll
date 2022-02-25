<?php

namespace App\Models\Organization\Basic\Phrase;

use App\Models\Organization\Organization;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewPhrase extends Organization
{
    use SoftDeletes;
}
