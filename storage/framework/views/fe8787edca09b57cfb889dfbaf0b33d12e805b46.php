<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title><?php echo e($global_settings->site_name); ?></title>

        <meta name="description" content="<?php echo e($global_settings->site_description); ?>" />

        <link href="humans.txt" rel="author" />

        <link rel="apple-touch-icon" sizes="180x180" href="/favicon-180x180.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css']); ?>
    
    </head>
    <body>

        <div id="app">
        </div>
            

        <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>
    </body>
</html>
<?php /**PATH D:\openserver2\domains\laravel-filament-spa-i18n-vite-vue\resources\views/index.blade.php ENDPATH**/ ?>