@if(Session::has('error'))
    <script type="text/javascript">
        toastr.error('Error!', "{{\Session::get('error')}}",{
            positionClass: 'toast-top-center',
            iconClass:'toast-error',
        });
    </script>
@endif
@if(Session::has('success'))
    <script type="text/javascript">
        toastr.success('Success!', "{{\Session::get('success')}}",{
            positionClass: 'toast-top-center',
            iconClass:'toast-success',
        });
    </script>
@endif
@if(Session::has('warning'))
    <script type="text/javascript">
        toastr.warning('Warning!', "{{\Session::get('warning')}}",{
            positionClass: 'toast-top-center',
            iconClass:'toast-warning',
        });
    </script>
@endif