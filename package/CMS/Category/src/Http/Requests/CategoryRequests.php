<?php

namespace CMS\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Traits\TraitValidator;

class CategoryRequests extends FormRequest
{
    use TraitValidator;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];
        $request = request()->segments();
        if (!empty($request)) {
            $data = request()->all();
            switch (@$request[3]) {
                case 'show':
                    return $this->handleShowValidator($data);
                case 'update':
                    return $this->handleUpdateValidator($data);
            }
        }


        return $rules;
    }


    public function handleShowValidator($request)
    {
        return  [];
    }

    public function handleUpdateValidator($request)
    {
        return [
            'id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'unique:categories,name,' . @$request['id']],
        ];
    }

    public function handleCreateValidator()
    {
    }
}