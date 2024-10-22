<button
    type="button"
    <?php echo e($attributes->class([
            'filament-forms-rich-editor-component-toolbar-button h-full cursor-pointer rounded-lg border border-gray-300 bg-white px-3 py-1 text-sm font-medium text-gray-800 shadow-sm transition duration-200 hover:bg-gray-100 focus:ring focus:ring-primary-200 focus:ring-opacity-50',
            'dark:border-gray-600 dark:bg-gray-700 dark:text-white' => config('forms.dark_mode'),
        ])); ?>

>
    <?php echo e($slot); ?>

</button>
<?php /**PATH D:\openserver2\domains\laravel-filament-spa-i18n-vite-vue\vendor\filament\forms\src\/../resources/views/components/rich-editor/toolbar-button.blade.php ENDPATH**/ ?>