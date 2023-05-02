<?php $__currentLoopData = $groupedEndpoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <h1 id="<?php echo Str::slug($group['name']); ?>"><?php echo $group['name']; ?></h1>

    <?php echo Parsedown::instance()->text($group['description']); ?>


    <?php $__currentLoopData = $group['subgroups']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subgroupName => $subgroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($subgroupName !== ""): ?>
            <h2 id="<?php echo Str::slug($group['name']); ?>-<?php echo Str::slug($subgroupName); ?>"><?php echo e($subgroupName); ?></h2>
            <?php ($subgroupDescription = collect($subgroup)->first(fn ($e) => $e->metadata->subgroupDescription)?->metadata?->subgroupDescription); ?>
            <?php if($subgroupDescription): ?>
                <p>
                    <?php echo Parsedown::instance()->text($subgroupDescription); ?>

                </p>
            <?php endif; ?>
        <?php endif; ?>
        <?php $__currentLoopData = $subgroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $endpoint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make("scribe::themes.default.endpoint", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php /**PATH C:\Users\ADL\Desktop\laravel\sakaiLibrary\vendor\knuckleswtf\scribe\src/../resources/views//themes/default/groups.blade.php ENDPATH**/ ?>