<?php

class Form {
    public function __construct () {}
    public function input ($type, $name, $class = false)
    {
        $this->inputs[] = [
            'type'  => $type,
            'name'  => $name,
            'class' => $class ?? '',
        ];
        return $this;
    }
    public function render ()
    {
        if (0 < count($this->inputs)) {

        }
    }
}