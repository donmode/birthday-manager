<?php 
namespace App;
use App\Validation;

class MediumUsersValidation extends Validation{
    public function validate(){
        $customize = [
            'required'=>['medium_id'=>"Social Medium ",'handle'=>"Username "],
            'regex' => ['handle'=>["Social Medium Username", " is not a valid username "]],

        ];

        $customize = array_filter($customize);
        $customize = array_map(function($item){
            return array_filter($item);
        }, $customize);

        // try {
            $data = request()->validate([
                    'medium_id'=>'required',
                    'handle' => 'required|regex:/^(https:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/(\w){1,}$/',
    
                ],
                $this->customValidationMessage($customize)
            );

        // } catch (\Throwable $th){
        //     return $th;
        // }

        return $data;
    }
}