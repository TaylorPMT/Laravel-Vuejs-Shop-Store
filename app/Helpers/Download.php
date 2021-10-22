<?php

namespace App\Helpers;

use App\Models\Film;
use App\Models\Link;
use App\Helpers\Upload;

class Download
{
    use Upload;
    const LINK = "https://photos.google.com/share/AF1QipOBrTz8G6yKkAQW1fUP0LBOd5YaoWvNrR7nYZ1J2_T3fd4xHU_ApLJsA3htn6B2sg/photo/AF1QipP9fWt1Q2IvfjVo0Rg--6V0d5Yz287o0Oz_FlIj?key=cE1aNEEyWndqZFRJM2V5VGE2OHhCaHZycWp3dmVB";

    public static function  getLinkDownload($link)
    {
        try {
            $arrContextOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );
            $stringTagApi = 'https://video-downloads.googleusercontent.com';
            $curl = file_get_contents($link, false, stream_context_create($arrContextOptions));
            $domHTML = new \DOMDocument();
            $domHTML->loadHTML($curl);
            $getTagName = $domHTML->getElementsByTagName('script');
            foreach ($getTagName as $string) {
                if (strpos($string->nodeValue, $stringTagApi)) {
                    $startIndex = strpos($string->nodeValue, $stringTagApi);
                    $subStrDefault = substr($string->nodeValue, $startIndex);
                    $endIndex = strpos($subStrDefault, '"');
                    $linksDownload = substr($subStrDefault, 0, $endIndex);
                    return $linksDownload;
                }
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function saveLink()
    {
        libxml_use_internal_errors(true);
        ini_set('max_execution_time', 30000000000);
        $query =  Film::with(['chapters' => function ($q) {
        }])->where([['status', '=', Film::STATUS_PENDING]])->take(100)->get();
        foreach ($query as $film) {
            foreach ($film->chapters as $links) {
                $path_file  = str_replace('.', '-', $film->StrId);
                $name_file = $links->chapters . '-' . $links->StrId.'.mp4' ;
                $get_link_download = Download::getLinkDownload($links->links);
                if (Download::curlFileDownload($path_file, $name_file, $get_link_download))
                    break;
            }
            $film->update([
                'status' => Film::DOWNLOAD_FULL_CHAPTER
            ]);
        }
    }

    public static function saveFile($disk, $path, $fullName, $fileData)
    {
        $storage = \Storage::disk($disk);
        if (!$storage->exists($path)) {
            $storage->makeDirectory($path);
        }

        $storage->put($path . '/' . $fullName, $fileData);
    }

    public static function createFolder($path)
    {
        if (!\File::exists($path)) {
            \File::makeDirectory($path);
        }
    }

    public static function curlFileDownload($folders, $file_name, $url)
    {

        try {
            $ch = curl_init($url);
            Download::createFolder($folders);
            $dir = './' . $folders;
            $save_file_loc = $dir . '/' . $file_name;
            $fp = fopen($save_file_loc, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function appendFile($disk, $path, $fullName, $fileData)
    {
        $storage = \Storage::disk($disk);
        if (!$storage->exists($path)) {
            $storage->makeDirectory($path);
        }
        $storage->append($path . '/' . $fullName, $fileData, null);
    }

    public static function moveFile($disk, $formFullPath, $toPath, $saveFullName)
    {
        $storage = \Storage::disk($disk);

        if (!$storage->exists($formFullPath)) {
            return;
        }
        if (!$storage->exists($toPath)) {
            $storage->makeDirectory($toPath);
        }
        $storage->move($formFullPath, $toPath . '/' . $saveFullName);
    }

    public static function deleteFile($disk, $fullPath)
    {
        \Storage::disk($disk)->delete($fullPath);
    }
}
