<?php

namespace App\Helpers;

use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use CMS\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;

class FullSiteSearch
{


    public static $keyword = '';
    public static function useModel()
    {
        return [
            '\\CMS\\Product\\Models\\' =>  '/package/CMS/Product/src/Models'
        ];
    }

    public static function filterSearchableModel(?string $class_name, $name_space)
    {
        if ($class_name == null) {
            return false;
        }
        $reflection  = new \ReflectionClass($name_space  . $class_name);
        $is_model = $reflection->isSubClassOf(Model::class);
        $search_able = $reflection->hasMethod('search');
        return $is_model && $search_able;
    }

    public static function search(string $keyword)
    {

        $path_file = app()->basePath();
        self::$keyword = $keyword;
        $data_result = [];
        // getting all the model files from the model folder
        collect(self::useModel())->map(function ($path, $name_space) use ($path_file, &$data_result) {
            $files = File::allFiles($path_file . $path);
            return collect($files)->map([self::class, 'parseModelNameFromFile'])->filter(function (?string $class_name) use ($name_space) {
                return self::filterSearchableModel($class_name, $name_space);
            })->map(function ($class_name) use ($name_space, &$data_result) {
                $model = app($name_space . $class_name);
                $fields = array_filter($model::SEARCHABLE_FIELDS, fn ($fields) => $fields !== 'id');
                $data_result =  $model::search(self::$keyword)->get()->filter(function ($model_record) use ($fields, $class_name) {
                    //for result
                    return self::createMatchAttribute($model_record, $fields, $class_name);
                });
            });
        });

        return $data_result;
    }


    public static function createMatchAttribute($model_record, array $fields, $class_name)
    {
        // only extracting the relevant fields from our model
        $field_data =  $model_record->only($fields);
        $key_word =
            self::$keyword;
        $image_link = $field_data['image'][0] ?? '';
        unset($field_data['image']);
        $serialized_values = collect($field_data)->join(' ');
        $search_pos = strpos(strtolower($serialized_values), strtolower($key_word));
        if ($search_pos !== false) {
            $start = $search_pos - $model_record::BUFFER;
            $start = $start < 0 ? 0 : $start;
            $length = strlen($key_word) + 2 * $model_record::BUFFER;
            $sliced = substr($serialized_values, $start, $length);
            $should_add_prefix = $start > 0;
            $should_add_post_fix = ($start + $length) < strlen($serialized_values);
            $sliced = $should_add_prefix ? '...' . $sliced : $sliced;
            $sliced = $should_add_post_fix ? $sliced . '....' : $sliced;
            $model_record->setAttribute('match', html_entity_decode(strip_tags($sliced)) ?? substr(html_entity_decode(strip_tags($serialized_values)), 0, 2 * $model_record::BUFFER) . '....');
            $model_record->setAttribute('model', $class_name);
            $model_record->setAttribute('view_link', self::createViewLink($model_record));
            $model_record->setAttribute('image', $image_link);
            return $model_record;
        }
        return null;
    }

    private static function createViewLink(Model $model)
    {
        $mapping = [
            Product::class  => '/product/{url}'
        ];
        $model_class = get_class($model);
        if (Arr::has($mapping, $model_class)) {
            return URL::to(str_replace('{url}', $model->link, $mapping[$model_class]));
        }
    }

    public static function parseModelNameFromFile(SplFileInfo $file)
    {
        $filename = $file->getRelativePathname();

        // assume model name is equal to file name
        /* making sure it is a php file*/
        if (substr($filename, -4) !== '.php') {
            return null;
        }
        // removing .php
        return substr($filename, 0, -4);
    }
}