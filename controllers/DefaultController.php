<?php
/**
 * 
 * Base Controller , needs to be separated.
 * 
 */
class DefaultController {

    public function __construct () 
    {
        Session::start();
        $this->PAGE = new \stdClass();
        $this->view = new \View();
        $this->GET();
        $this->POST();
    }

    public function GET ()
    {
        if ($this->GET) {
            return $this->GET;
        }
        $this->GET = new \stdClass();
        foreach ($_GET as $k => $v) {
            if (isset($this->GET->{$k})) continue;
            @$this->GET->{$k} = $v;
        }
        return $this->GET;
    }

    public function POST ()
    {
        if ($this->POST) {
            return $this->POST;
        }
        $this->POST = new \stdClass();
        foreach ($_POST as $k => $v) {
            if (isset($this->POST->{$k})) continue;
            @$this->POST->{$k} = $v;
        }
        return $this->POST;
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
        return $this->view;
    }

    public function renderGroup ($views)
    {
        $class = get_class($this);
        foreach ($views as $view) {
            $file   = __DIR__ . '/../views/' . $class . '/' . $view . '.php';
            if (true == file_exists($file)) {
                ob_start();
                    include $file;
                    $compiled = ob_get_contents();
                ob_end_clean();
                print $compiled;
            }
        }
    }

    public function render ($name, $additional = false)
    {
        $class = get_class($this);
        $file   = __DIR__ . '/../views/' . $class . '/' . $name . '.php';
        if (true == file_exists($file)) {
            if (false != $additional) {
                extract($additional);
            }
            ob_start();
                include $file;
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
        return $this->view->get($param);
    }

    public function call ($controller, $method)
    {
        $controller = new $controller;
        return $controller->{$method}();
    }

}
