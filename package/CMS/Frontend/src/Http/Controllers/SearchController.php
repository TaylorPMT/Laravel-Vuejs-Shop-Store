<?php

namespace CMS\Frontend\Http\Controllers;

use App\Http\Controllers\BaseController;
use CMS\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Symfony\Component\Finder\SplFileInfo;

class SearchController extends BaseController
{

    public function search(Request $request)
    {
        $path_file = app()->basePath();
        $model_folder = [
            '\\CMS\\Product\\Models\\' =>  '/package/CMS/Product/src/Models'
        ];
        $data_result = [];
        collect($model_folder)->map(function ($path, $name_space) use ($path_file, &$data_result) {
            $files = File::allFiles($path_file . $path);

            return collect($files)->map(function (SplFileInfo $file) {
                $file_name = $file->getRelativePathname();
                if (substr($file_name, -4) !== '.php') {
                    return null;
                }
                return substr($file_name, 0, -4);
            })->filter(function (?string $class_name) use ($name_space) {
                if ($class_name == null) {
                    return false;
                }

                $reflection  = new \ReflectionClass($name_space  . $class_name);
                $is_model = $reflection->isSubClassOf(Model::class);
                $search_able = $reflection->hasMethod('search');
                return $is_model && $search_able;
            })->map(function ($class_name) use ($name_space, &$data_result) {
                $model = app($name_space . $class_name);
                $fields = array_filter($model::SEARCHABLE_FIELDS, fn ($fields) => $fields !== 'id');

                $data_result =  $model::search(request()->keyword)->get()->map(function ($model_record) use ($fields, $class_name) {
                    //for result
                    $field_data =  $model_record->only($fields);
                    $key_word = request()->keyword;
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
                    }
                    $model_record->setAttribute('match', $sliced ?? substr($serialized_values, 0, 2 * $model_record::BUFFER) . '....');
                    $model_record->setAttribute('model', $class_name);
                    $model_record->setAttribute('view_link', $this->createViewLink($model_record));
                    $model_record->setAttribute('image', $image_link);
                    return $model_record;
                });
            });
        });
        return $this->responseJson(false, 200, 'Thành công', $data_result);
    }

    private function createViewLink(Model $model)
    {
        $mapping = [
            Product::class  => '/product/{url}'
        ];
        $model_class = get_class($model);
        if (Arr::has($mapping, $model_class)) {
            return URL::to(str_replace('{url}', $model->link, $mapping[$model_class]));
        }
    }
}