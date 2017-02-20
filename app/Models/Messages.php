<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'messages';
    protected $guarded = [];
    public $timestamps = false;

    public static function destroy( $ids ){

        parent::destroy( $ids );

    }

}
