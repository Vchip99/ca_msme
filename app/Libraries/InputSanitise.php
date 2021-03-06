<?php

namespace App\Libraries;
use Illuminate\Http\Request;
use DB, Cache, File;

class InputSanitise{

	public static function stripTrim($str){
		return strip_tags(trim($str));
	}

	public static function inputString($str){
		return static::stripTrim(filter_var( $str, FILTER_SANITIZE_STRING));
	}

	public static function inputInt($str){
		return static::stripTrim(filter_var( $str, FILTER_SANITIZE_NUMBER_INT));
	}

    public static function delFolder($dir) {
        if(is_dir($dir)){
            $files = array_diff(scandir($dir), array('.','..'));
            if(count($files) > 0){
                foreach ($files as $file) {
                  (is_dir("$dir/$file")) ? static::delFolder("$dir/$file") : unlink("$dir/$file");
                }
                return rmdir($dir);
            }
        }
        return;
    }

    public static function checkClientImagesDirForCkeditor($subdomain){
        // create client/subdomain dir in kcfinder upload dir
        $path = public_path().'/documents';
        if(!is_dir($path)){
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        return;
    }

}