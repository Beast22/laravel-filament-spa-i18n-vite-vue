<div
    <?php echo $getId() ? "id=\"{$getId()}\"" : null; ?>

    <?php echo e($attributes->merge($getExtraAttributes())->class([
            'filament-forms-card-component rounded-xl border border-gray-300 bg-white p-6',
            'dark:border-gray-600 dark:bg-gray-800' => config('forms.dark_mode'),
        ])); ?>

>
    <?php echo e($getChildComponentContainer()); ?>

</div>
<?php /**PATH D:\openserver2\domains\laravel-filament-spa-i18n-vite-vue\vendor\filament\forms\src\/../resources/views/components/card.blade.php ENDPATH**/ ?>