<?php

class Template {
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

class Controller_Base {

    public function __construct () 
    {
        Session::start();
        $this->GET = new \stdClass();
        $this->PAGE = new \stdClass();
        $this->template = new \Template();
        $this->session = new SpotifyWebAPI\Session(
            '3c6c1a3c78c0483bb84e968c4999ae63',
            'ba245a2fde4c48a5a8b3a525847b20fc',
            'http://localhost/spotify/login'
        );
        $this->api = new SpotifyWebAPI\SpotifyWebAPI();
    }

    public function GET ()
    {
        foreach ($_GET as $k => $v) {
            if (isset($this->GET->{$k})) continue;
            @$this->GET->{$k} = $v;
        }
        return $this->GET;
    }

    public function partial ($controller_method)
    {
        $parts      = explode('@', $controller_method);
        $controller = new $parts[0]();
        $method     = $controller->{$parts[1]}();
        return $method;
    }

    public function redirect($path, $permanent = false)
    {
        if (true == $permanent) {
            Header("HTTP/1.1 301");
        } else {
            Header("HTTP/1.1 302");
        }
        Header("Location: " . $path);
        return $this;
    }

    public function param ($key, $value)
    {
        $this->PAGE->{$key} = $value;
        return $this;
    }

    public function view ()
    {
        return $this->template;
    }

    public function render ($name, $additional = false)
    {
        if (true == file_exists(__DIR__ . './../views/' . $name . '.php')) {
            if (false != $additional) {
                extract($additional);
            }
            ob_start();
                include __DIR__ . './../views/' . $name . '.php';
                $compiled = ob_get_contents();
            ob_end_clean();
            print $compiled;
        }
        return $this;
    }

    public function __get ($param)
    {
        if (isset($this->{$param})) {
            return $this->{$param};
        }
        // return $this->template->get($param);
        var_dump($this->template);
    }

    public function call ($controller, $method)
    {
        $controller = new $controller;
        return $controller->{$method}();
    }

}