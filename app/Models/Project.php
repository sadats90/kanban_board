<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function betterment_fees(){
        return $this->hasMany(BettermentFee::class);
    }

}
