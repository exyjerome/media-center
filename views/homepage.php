<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Brand</a>
        </div>
        <div class="nav navbar-nav navbar-right navbar-form">
            <a href="<?= $this->spotify ?>" class="btn btn-success">
                Login with Spotify
            </a>
            <a data-action="" class="btn btn-info">
                <i class="fa fa-step-backward"></i>
            </a>
            <a data-action="play" class="btn btn-success">
                <i class="fa fa-play"></i>
            </a>
            <a data-action="pause" class="btn btn-danger">
                <i class="fa fa-stop"></i>
            </a>
            <a class="btn btn-info">
                <i class="fa fa-step-forward"></i>
            </a>
        </div>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h1>Media Control Center</h1>
        </div>
        <div class="col-md-6">
            <?= var_dump($this) ?>
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
