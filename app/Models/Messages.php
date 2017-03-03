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

    //replace link to preview container
    public static function findLink($text) {
        $reg_exUrl = "/((http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?)/";
        if(preg_match($reg_exUrl, $text)) {
            preg_match_all($reg_exUrl, $text, $matches);
            $link_items = array();
            foreach ($matches[1] as $match){
                $link_item = file_get_contents('http://api.linkpreview.net/?key=58b96fd7125876b6205366b32c13ea20b33fad32f992e&q='.$match);
                $link_item = json_decode($link_item);
                $link_items[] = view('frontend.includes.preview-link', compact(['link_item']))->render();
            }
            foreach ($matches[1] as $key => $mat) {
                $text = str_replace($mat, $link_items[$key], $text);
            }
        }
        return $text;
    }

}
