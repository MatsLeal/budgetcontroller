<?php $__env->startSection('title','Hello'); ?>



<?php $__env->startSection('content'); ?>


Hello    


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>