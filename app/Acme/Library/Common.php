<?php namespace Acme\Library;

use Input;
use Redirect;
use File;

class Common {

    public static function getFileFromParams($url) {
        $geturl = urldecode($url['params']['filelink']);
        $filelink = str_replace('_','-',$geturl);
        if (File::exists($filelink)) {
            $filePeople  = file_get_contents($filelink);
            return $filePeople;
        }
    }

    public static function uploadExtFile($folder) 
    {
        if (Input::file('file')) {
            $file = Input::file('file');
            $extension = $file->getClientOriginalExtension();
            $destinationPath = $folder;

            if ($extension == 'json' OR $extension == 'xml') {
                $filename = $file->getClientOriginalName();
                try {
                    $upload_success = $file->move($destinationPath, $filename);
                    return Redirect::back()->with('success', 'File uploaded successfully. You can now do stuff with it.');
                 
                } catch(Exception $e) {
                    return Redirect::back()->with('error', $e);
                }
            }
            else {
                return Redirect::back()->with('error', 'Wrong file type. Please try again.');
            }
        }
        else {
            return Redirect::back()->with('error', 'A file was not selected. Please try again.');
        }
    }

    public static function mapColumnNames($key, array $map) {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                if (isset($map[$k]) AND $k != $map[$k]) {
                    $newkey = $map[$k];
                }
                else {
                    $newkey = $k;
                }
            }
        }
        elseif (!is_array($key)) {
            //echo 'not array';
            if (isset($map[$key]) AND $key != $map[$key]) {
                $newkey = $map[$key];
            }
            else {
                $newkey = $key;
            }
        }
        return $newkey;
    }

    public static function sluggify($string)
    {
        $slug = strtolower($string);
        $slug = str_replace(' ','-',$slug);
        return $slug;
    }

    


    /*public static function getFromParams($url, $string) {
        $geturl = urldecode($url['params'][$string]);
        return $geturl;
    }

    public static function getParams($url, $array)
    {
        foreach ($array as $param) {
            $geturl[] = urldecode($url['params'][$param]);
        }
        
        return $geturl;
    }*/



}    

// EOF
