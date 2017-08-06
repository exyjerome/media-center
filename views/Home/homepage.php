<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <? if ($this->spotifyAuthed): ?>
                    <?= $this->spotifyAuthed->id ?>
                <? endif; ?>
            </a>
        </div>
        <div class="nav navbar-nav navbar-right navbar-form text-center">
            <? if (!$this->spotifyAuthed): ?>
                <a href="<?= $this->spotify ?>" class="btn btn-success">
                    Login with Spotify
                </a>
            <? endif; ?>
            <a data-action="previous" class="btn btn-info">
                <i class="fa fa-step-backward"></i>
            </a>
            <a data-action="play" class="btn btn-success">
                <i class="fa fa-play"></i>
            </a>
            <a data-action="pause" class="btn btn-danger">
                <i class="fa fa-stop"></i>
            </a>
            <a data-action="skip" class="btn btn-info">
                <i class="fa fa-step-forward"></i>
            </a>
            <a data-action="volume_down" class="btn btn-success">
                <i class="fa fa-minus-circle"></i>
            </a>
            <a data-action="volume_up" class="btn btn-success">
                <i class="fa fa-plus-circle"></i>
            </a>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <? if (true == false): //$current = $this->currentlyPlaying): ?>
                <div id="currentlyPlaying" class="media">
                    <div class="media-left hidden-xs">
                        <a href="">
                            <img width="192" height="192" class="media-object" src="">
                        </a>
                    </div>
                    <div class="media-body media-middle">
                        <h2 class="media-heading">
                            <span id="artist"></span><hr><span id="song"></span>
                        </h2>
                        Playing on <span id="device"></span>
                    </div>
                </div>
                <script>
                    $.getJSON('/spotify/current', function(json){
                        var current = $('#currentlyPlaying');
                        current.find('#artist').text(json.artist);
                        current.find('#song').text(json.name);
                        current.find('img').attr('src', json.album.url);
                        current.find('#device').text(json.device.name);
                    });
                    setInterval(function(){
                        $.getJSON('/spotify/current', function(json){
                            var current = $('#currentlyPlaying');
                            current.find('#artist').text(json.artist);
                            current.find('#song').text(json.name);
                            current.find('img').attr('src', json.album.url);
                            current.find('#device').text(json.device.name);
                        });
                    }, 2500);
                </script>
            <? endif ?>
        </div>
    </div>
</div>

<script>
    $('a.btn').on('click', function (){
        var d = $(this).attr('data-action');
        if (d !== undefined) {
            $.get('http://localhost/spotify/' + d);
        }       
    })
</script>
