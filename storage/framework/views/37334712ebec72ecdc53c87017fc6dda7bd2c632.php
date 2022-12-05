<?php if(Session::has('error')): ?>
    <script type="text/javascript">
        toastr.error('Error!', "<?php echo e(\Session::get('error')); ?>",{
            positionClass: 'toast-top-center',
            iconClass:'toast-error',
        });
    </script>
<?php endif; ?>
<?php if(Session::has('success')): ?>
    <script type="text/javascript">
        toastr.success('Success!', "<?php echo e(\Session::get('success')); ?>",{
            positionClass: 'toast-top-center',
            iconClass:'toast-success',
        });
    </script>
<?php endif; ?>
<?php if(Session::has('warning')): ?>
    <script type="text/javascript">
        toastr.warning('Warning!', "<?php echo e(\Session::get('warning')); ?>",{
            positionClass: 'toast-top-center',
            iconClass:'toast-warning',
        });
    </script>
<?php endif; ?><?php /**PATH E:\laragon\www\adaajaipur\resources\views/partials/sweetalert.blade.php ENDPATH**/ ?>