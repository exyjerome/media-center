<?php

class View {
    
    public function __construct ()
    {
        @$this->variables = new \stdClass();
    }
    
    public function get($key)
    {
        if (isset($this->variables->{$key})) {
            return $this->variables->{$key};
        } else {
            return '';
        }
    }

    public function __set ($key, $value)
    {
        $this->variables->{$key} = $value;
    }
}