<fieldset
    <?php echo $getId() ? "id=\"{$getId()}\"" : null; ?>

    <?php echo e($attributes
            ->merge($getExtraAttributes())
            ->class([
                'filament-forms-fieldset-component rounded-xl border border-gray-300 p-6 shadow-sm',
                'dark:border-gray-600 dark:text-gray-200' => config('forms.dark_mode'),
            ])); ?>

>
    <?php if(filled($label = $getLabel())): ?>
        <legend class="-ml-2 px-2 text-sm font-medium leading-tight">
            <?php echo e($label); ?>

        </legend>
    <?php endif; ?>

    <?php echo e($getChildComponentContainer()); ?>

</fieldset>
<?php /**PATH D:\openserver2\domains\laravel-filament-spa-i18n-vite-vue\vendor\filament\forms\src\/../resources/views/components/fieldset.blade.php ENDPATH**/ ?>