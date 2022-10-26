<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
       /* data:[
            {}
             'data.*.customerId'=> ['required','integer'],
        ]*/

        return [
            '*.customerId'=> ['required','integer'],
            '*.amount'=>['required','numeric'],
            '*.status'=>['required',Rule::in(['B','P','V','b','p','v'])],
            '*.billedDate'=>['required','date_format:Y-m-d H:i:s'],
            '*.paidDate'=>['date_format:Y-m-d H:i:s','nullable'],
        ];
    }

    protected function prepareForValidation(){
        $data = [];
        foreach($this->toArray() as $object){
            $object['customer_id'] = $object['customerId'] ?? null;
            $object['billed_date'] = $object['billedDate'] ?? null;
            $object['paid_date'] = $object['paidDate'] ?? null;
            $data[] = $object;
        }
        $this->merge($data);
    }
}
