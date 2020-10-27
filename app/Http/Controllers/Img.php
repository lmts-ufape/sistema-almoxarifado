<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class Img {

    private static function nextIdTable($modelList) {

        $id = 0;
        $size = count($modelList);

        if($size) {
            $models = $modelList;
            $model = $models[$size-1];
            $id = $model->id;
            $id++;
        } else {
            $id++;
        }

        return sprintf('%u', $id);
    }

    private static function nameTextImage($name) {
        return Str::kebab($name);
    }

    private static function extensionImage($extension) {
        return '.'.$extension;
    }

    public static function nameNewImage($modelAll, $name, $extensionFile) {
        return self::nextIdTable($modelAll).self::nameTextImage($name).self::extensionImage($extensionFile);
    }

    public static function nameUpdateImage($nameImage) {
        return $nameImage;
    }

}