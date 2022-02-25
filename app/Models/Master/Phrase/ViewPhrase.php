<?php

namespace App\Models\Master\Phrase;

use App\Models\Master\Master;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Organization\Basic\Phrase\Phrase;

class ViewPhrase extends Master
{
    use SoftDeletes;

    public function translate()
    {
        return $this->hasOne(Phrase::class, 'id', 'id');
    }
}
