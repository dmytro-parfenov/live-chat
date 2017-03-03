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

    //all <a> tag for all links in message
    public static function autolink($text) {
        $reg_exUrl = "/((http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?)/";
        if(preg_match($reg_exUrl, $text)) {
            return preg_replace($reg_exUrl, '<a href="${1}" target="_blank">${1}</a> ', $text);
        } else {
            return $text;
        }
    }

}
