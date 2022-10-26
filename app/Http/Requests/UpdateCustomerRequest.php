<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $httpMethod = $this->method();
        if($httpMethod =='PUT'){
            return [
                'name'=> ['required'],
                'type'=>['required',Rule::in(['I','B','i','b'])],
                'email'=>['required','email'],
                'address'=>'required',
                'city'=>['required'],
                'state'=>'required',
                'postalCode'=>'required',
            ];
        }else{
            return [
                'name'=> ['sometimes','required'],
                'type'=>['sometimes','required',Rule::in(['I','B','i','b'])],
                'email'=>['sometimes','required','email'],
                'address'=>['sometimes','required'],
                'city'=>['sometimes','required'],
                'state'=>['sometimes','required'],
                'postalCode'=>['required'],
            ];
        }
        
    }

    protected function prepareForValidation(){
        if($this->postalCode){
            $this->merge([
                'postal_code'=>$this->postalCode
            ]);
        }
        
    }
}
