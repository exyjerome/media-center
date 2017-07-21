<?php

class Spotify extends Controller_Base {

    public function Auth ()
    {
        if (isset($this->GET()->code, $this->api)) {
            $this->session->requestAccessToken($this->GET()->code);
            $this->api->setAccessToken($this->session->getAccessToken());
            Session::write('accessToken', $this->session->getAccessToken());            
        }
        $this->redirect('/');
    }

    public function Pause ()
    {
        if ($token = Session::read('accessToken')) {
            $this->api->setAccessToken($token);
            $this->api->pause();
        }
    }

    public function Play ()
    {
        if ($token = Session::read('accessToken')) {
           $this->api->setAccessToken($token);
           $this->api->play();
        }
    }

    public function Skip ()
    {
        if ($token = Session::read('accessToken')) {
           $this->api->setAccessToken($token);
           $this->api->next();
        }
    }

    public function Previous ()
    {
        if ($token = Session::read('accessToken')) {
           $this->api->setAccessToken($token);
           $this->api->previous();
        }
    }

    public function LoginUrl ()
    {
        $options = [
            'scope' => [
                'playlist-read-private',
                'user-read-private',
                'streaming'
            ],
        ];

        return $this->session->getAuthorizeUrl($options);
    }
}