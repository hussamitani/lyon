<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FamilyAttributePivot extends Pivot
{
    protected $table = 'family_attributes';
}
