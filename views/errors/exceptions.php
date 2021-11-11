<!doctype html>
<html lang="<?php echo app('lang'); ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon icon -->
  <link rel="icon" href="<?php asset('assets/images/favicon.ico'); ?>" type="image/x-icon">
  <title>CRUD</title>
  <link rel="stylesheet" media="all" href="<?php asset('assets/css/errors.css'); ?>"/>
</head>
<body>
<div id="clouds">
            <div class="cloud x1"></div>
            <div class="cloud x1_5"></div>
            <div class="cloud x2"></div>
            <div class="cloud x3"></div>
            <div class="cloud x4"></div>
            <div class="cloud x5"></div>
        </div>
        <div class='c'>
            <div class='_404'>500</div>
            <hr>
            <!--div class='_1'>A PÁGINA</div-->
            <div class='_2'><?php echo $error; ?></div>
            <!--a class='btn' href='<?php #url('/'); ?>'>VOLTAR AO INÍCIO</a-->
        </div>
</body>
</html>