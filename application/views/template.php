<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $title; ?></title>
        
        <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet"/>
        <link href="<?php echo base_url() ?>assets/css/skins/green.css" rel="stylesheet"/>
        <link href="<?php echo base_url() ?>assets/css/custom.css" rel="stylesheet"/>
        <script src="<?php echo base_url() ?>assets/js/jquery-1.11.0.min.js"></script>
    </head>

    <body>
        <div class="">
            <h1 class="text-center">Optimum School System Installer</h1>
        </div>
        <div id="main">
            <?php echo $content; ?>
            <footer class="text-center">
                <p><b>&copy;left 2017 - optimum school system</b></p>
            </footer>
        </div>
    </body>
</html>		
