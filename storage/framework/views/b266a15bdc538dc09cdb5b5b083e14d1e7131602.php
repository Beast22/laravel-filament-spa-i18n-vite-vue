<div class="filament-page-select-action">
    <label for="<?php echo e($getId()); ?>" class="sr-only">
        <?php echo e($getLabel()); ?>

    </label>

    <select
        id="<?php echo e($getId()); ?>"
        wire:model="<?php echo e($getName()); ?>"
        <?php echo e($attributes->class([
                'block h-9 w-full rounded-lg border-gray-300 py-1 text-gray-900 shadow-sm outline-none transition duration-75 invalid:text-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-inset focus:ring-primary-500',
                'dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:focus:border-primary-500' => config('filament.dark_mode'),
            ])); ?>

    >
        <?php if(($placeholder = $getPlaceholder()) !== null): ?>
            <option value=""><?php echo e($placeholder); ?></option>
        <?php endif; ?>

        <?php $__currentLoopData = $getOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($value); ?>">
                <?php echo e($label); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<?php /**PATH D:\openserver2\domains\laravel-filament-spa-i18n-vite-vue\vendor\filament\filament\src\/../resources/views/pages/actions/select-action.blade.php ENDPATH**/ ?>