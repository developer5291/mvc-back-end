<?php 

namespace App\Classes;

class Validator {

    private $request;
    private $errors = [];

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function validate($array)
    {
        foreach($array as $field => $rules){
            foreach($rules as $rule){
                if(str_contains($rule, ":")){
                    $rule = explode(':', $rule);
                    $ruleName = $rule[0]; 
                    $ruleValue = $rule[1];
                    if($error = $this->{$ruleName}($field, $ruleValue)){
                        $this->errors[$field] = $error;
                        break;
                    }
                }
                else {
                    if($error = $this->{$rule}[$field]){
                        $this->error[$field] = $error;
                        break;
                    }                    
                }
            }
        }
        return $this;
    }

    public function hasError()
    {
        return count($this->errors) ? true : false;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    private function required($field)
    {
        if(is_null($this->request->get($field)))
            return "please fill $field";
            
        if(empty($this->request->get($field)))
            return "please fill $field";
    }

    private function email($field)
    {
        if(filter_var($this->request->{$field}, FILTER_VALIDATE_EMAIL))
            return "is invalid email";
    }

    private function min($field, $value)
    {
        if(strlen($this->request->{$field}) < $value)
            return "$field chars length is smaller than $value";

        return false;
    }
    
    private function max($field, $value)
    {
        if(strlen($this->request->{$field}) > $value)
            return "$field chars length is bigger than $value";
        
        return false;
    }


}