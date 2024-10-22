<div
    <?php echo e($attributes
            ->merge($getExtraAttributes())
            ->class([
                'filament-tables-image-column',
                'px-4 py-3' => ! $isInline(),
            ])); ?>

>
    <?php
        $height = $getHeight();
        $width = $getWidth() ?? ($isCircular() || $isSquare() ? $height : null);
    ?>

    <div
        style="
            <?php echo $height !== null ? "height: {$height};" : null; ?>

            <?php echo $width !== null ? "width: {$width};" : null; ?>

        "
        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
            'overflow-hidden' => $isCircular() || $isSquare(),
            'rounded-full' => $isCircular(),
        ]) ?>"
    >
        <?php if($path = $getImagePath()): ?>
            <img
                src="<?php echo e($path); ?>"
                style="
                    <?php echo $height !== null ? "height: {$height};" : null; ?>

                    <?php echo $width !== null ? "width: {$width};" : null; ?>

                "
                <?php echo e($getExtraImgAttributeBag()->class([
                        'object-cover object-center' => $isCircular() || $isSquare(),
                    ])); ?>

            />
        <?php endif; ?>
    </div>
</div>
<?php /**PATH D:\openserver2\domains\laravel-filament-spa-i18n-vite-vue\vendor\filament\tables\src\/../resources/views/columns/image-column.blade.php ENDPATH**/ ?>