<?php
namespace App;

abstract class Validation{
    public function customValidationMessage(Array $validations){
        $customised = [];
        foreach($validations as $key => $validation){
            $validation = array_chunk($validation, 1, true);
            if($key ==  'required'){
                $customised[] = array_map(function($field){
                    return [array_key_first($field).'.required' => $field[array_key_first($field)]." is required"];},
                    $validation);
                    continue;
            }

            if($key ==  'string'){
                $customised[] = array_map(function($field){
                    return [array_key_first($field).'.string' => $field[array_key_first($field)]." must be string"];},
                    $validation);
                    continue;

            }

            if($key ==  'numeric'){
                $customised[] = array_map(function($field){
                    return [array_key_first($field).'.numeric' => $field[array_key_first($field)]." must be numeric"];},
                    $validation);
                    continue;

            }

            if($key ==  'image'){
                $customised[] = array_map(function($field){
                    return [array_key_first($field).'.image' => $field[array_key_first($field)]." must be an image of any of the following types: jpeg, png, jpg, gif, svg"];},
                    $validation);
                    continue;

            }

            if($key ==  'image_max'){
                $customised[] = array_map(function($field){
                    return [array_key_first($field).'.uploaded' => $field[array_key_first($field)][0]." size must not be greater than ".$field[array_key_first($field)][1]];},
                    $validation);
                    continue;

            }
            

            if($key ==  'regex'){
                $customised[] = array_map(function($field){
                    return [array_key_first($field).'.regex' => $field[array_key_first($field)][0].$field[array_key_first($field)][1]];},
                    $validation);
                    continue;

            }

            if($key ==  'min'){
                $customised[] = array_map(function($field){
                    return [array_key_first($field).'.min' => $field[array_key_first($field)][0]." must be more than ".$field[array_key_first($field)][1]];},
                    $validation);
                    continue;

            }

            if($key ==  'max'){
                $customised[] = array_map(function($field){
                    return [array_key_first($field).'.max' => $field[array_key_first($field)][0]." must be less than ".$field[array_key_first($field)][1]];},
                    $validation);
                    continue;

            }
        }
        $finalArray = [];
        array_map(
            function($single) use (&$finalArray){
                array_map(
                    function($final) use (&$finalArray){
                        $finalArray[] = $final;
                    },$single
                );
            },$customised
        );
        if($finalArray)
            return (array_merge(...$finalArray));
    }

    abstract protected function validate();
}