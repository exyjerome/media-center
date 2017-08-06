<?php

class Spotify extends DefaultController {

    public function __construct ()
    {
        parent::__construct();
        $this->session = new SpotifyWebAPI\Session(
            '3c6c1a3c78c0483bb84e968c4999ae63',
            'ba245a2fde4c48a5a8b3a525847b20fc',
            'http://localhost/spotify/login'
        );
        $this->api = new SpotifyWebAPI\SpotifyWebAPI();
        if ($token = Session::read('accessToken')) {
            $this->api->setAccessToken($token);
            $this->tokenSet = true;
        } else {
            $this->tokenSet = false;
        }
    }

    public function Auth ()
    {
        if (isset($this->GET()->code, $this->api)) {
            $this->session->requestAccessToken($this->GET()->code);
            $this->api->setAccessToken($this->session->getAccessToken());
            Session::write('accessToken', $this->session->getAccessToken());            
        }
        $this->redirect('/');
    }

    public function Authed ()
    {
        return ($this->tokenSet ? $this->api->me() : false);
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
                'streaming',
                'user-read-playback-state',
            ],
        ];

        return $this->session->getAuthorizeUrl($options);
    }

    public function VolumeUp ()
    {
        if (true == $this->tokenSet) {
            $device = $this->api->getMyCurrentPlaybackInfo();
            $volume = $device->device->volume_percent;
            $newVol = $volume + 5;
            if ($newVol > 100) {
                $newVol = 100;
            }
            $this->api->changeVolume([
                'volume_percent' => $newVol
            ]);
        }
    }

    public function VolumeDown ()
    {
        if (true == $this->tokenSet) {
            $device = $this->api->getMyCurrentPlaybackInfo();
            $volume = $device->device->volume_percent;
            $newVol = $volume - 5;
            if ($newVol < 0) {
                $newVol = 0;
            }
            $this->api->changeVolume([
                'volume_percent' => $newVol
            ]);
        }
    }

    public function Current ()
    {
        if (true == $this->tokenSet) {
            $current = $this->api->getMyCurrentTrack();
            $device  = $this->api->getMyCurrentPlaybackInfo(); 
            return json_encode([
                'album'  => $current->item->album->images[1],
                'artist' => $current->item->artists[0]->name,
                'name'   => $current->item->name,
                'device' => $device->device,
            ]);
        }
    }
}