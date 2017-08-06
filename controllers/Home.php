<?php

class Home extends DefaultController 
{
    public function Page ()
    {
        $this->view()->title = 'My App';
        $this->view()->spotify = $this->call('Spotify', 'LoginUrl');
        if ($authed = $this->call('Spotify', 'Authed')) {
            $this->view()->spotifyAuthed = $authed;
            $this->view()->currentlyPlaying = $this->call('Spotify', 'Current');
        } else {
            $this->view()->spotifyAuthed = false;
        }
        $this->render('header');
        $this->render('homepage');
        $this->render('footer');
    }
}
