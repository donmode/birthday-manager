<?php 
namespace App;
use App\Validation;

class UserValidation extends Validation{
    public function validate(){
        $customize = [
            'required'=>['firstname'=>"First Name", 'lastname'=>"Last Name", 'address' => "Address", 'phone1' => "Primary Phone Number"],
            'string' => ['firstname'=>"First Name", 'lastname'=>"Last Name", (request()['middlename'])?'middlename':''=>(request()['middlename'])?"Middle Name":''],
            'numeric' => ['phone1'=>"Primary Phone Number", (request()['phone2'])?'phone2':''=>(request()['phone2'])?"Alternative Phone Number":''],
            (request()['picture_url'])?'image':'' => ['picture_url'=>"Profile Picture"],
            'min' => ['firstname'=>['First Name', 50],
            (request()['middlename'])?'middlename':''=>(request()['middlename'])?['Middle Name', 50]:'',
                    'last'=>['Last Name', 255], 
                    'address'=>['Address', 50], 
                    'phone1'=>['Primary Phone Number', 13], 
                    (request()['phone2'])?'phone2':''=>(request()['phone2'])?['Alternative Phone Number', 10]:''],
            (request()['picture_url'])?'image_max':'' => ['picture_url'=>["Profile Picture", "1024 byte"]],
        ];

        $customize = array_filter($customize);
        $customize = array_map(function($item){
            return array_filter($item);
        }, $customize);
        $data = request()->validate([
                'firstname'=>'required|string|max:50',
                (request()['middlename']) ? 'middlename': ''=> (request()['middlename']) ? 'string|max:50' : '',
                'lastname'=>'required|string|max:50',
                'phone1'=>['required', 'min:13', 'numeric'],
                (request()['phone2'])?'phone2':''=> (request()['phone2'])?['min:13', 'numeric']:'',
                'address'=>'required|max:255',
                (request()['picture_url'])?'picture_url':'' => (request()['picture_url'])?'image|mimes:jpeg,png,jpg,gif,svg|max:1024':'',
            ],
            $this->customValidationMessage($customize)
        );
        return $data;
    }
}