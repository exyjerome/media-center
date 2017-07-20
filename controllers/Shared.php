<?php

class Shared extends Controller_Base {

    public function header ()
    {
        return $this->view('header', [
            'title' => 'My App'
        ]);
    }

    public function footer ()
    {
        return $this->view('footer', [
            'year' => date('Y')
        ]);
    }

}