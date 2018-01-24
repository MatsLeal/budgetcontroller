<?php if((bool) array_get($config, 'tableless_models')): ?>
    try {
        $<?php echo $name; ?> = app('<?php echo $class; ?>');
        $<?php echo $name; ?>_ = app('<?php echo $class; ?>');
        if (!function_exists('<?php echo $name; ?>')) {
            function <?php echo $name; ?>(...$args) {
                return '<?php echo $class; ?>';
            }
        }
    } catch (Throwable $e) {
        tinx_forget_name('<?php echo $class; ?>');
    } catch (Exception $e) {
        tinx_forget_name('<?php echo $class; ?>');
    }
<?php else: ?>
    tinx_forget_name('<?php echo $class; ?>');
<?php endif; ?>
