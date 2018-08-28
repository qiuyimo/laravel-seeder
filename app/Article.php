<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function belongsToUser()
    {
        return $this->belongsTo('User', 'user_id', 'id');
    }
}
