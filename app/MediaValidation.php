<?php 
namespace App;
use App\Validation;

class MediaValidation extends Validation{
    public function validate(){
        $customize = [
            'required'=>['name'=>"Social Medium Name", (request()['logo_url'])?'logo_url':''=>(request()['logo_url'])?"Logo":'', 'url'=>"URL"],
            'string' => ['name'=>"Social Medium Name"],
            'regex' => ['url'=>["Url", " is not a valid address"]],
            'image'=> (request()['logo_url'])?['logo_url'=>"Logo"]:'' ,
            'image_max' => (request()['logo_url'])?['logo_url'=>["Logo", "1024 byte"]]:'',
            'max' => ['url'=>['URL', 100]]
        ];
        $customize = array_filter($customize);
        $customize = array_map(function($item){
            return array_filter($item);
        }, $customize);
        $data = request()->validate([
                'name'=>'required|string',
                (request()['logo_url']) ? 'logo_url' : '' => (request()['logo_url']) ?'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024':'',
                'url' => 'required|max:100|regex:/^(https:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/$/',

            ],
            $this->customValidationMessage($customize)
        );
        return $data;
    }
}