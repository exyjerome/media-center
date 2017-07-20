<?php

class Home extends Controller_Base 
{
    public function Page ()
    {
        $this->view()->title = 'My App';
        $this->view()->spotify = $this->call('Spotify', 'LoginUrl');

        $this->render('header');
        $this->render('homepage');
        $this->render('footer');
    }

}