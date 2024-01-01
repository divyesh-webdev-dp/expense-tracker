<script>
    var options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
</script>

@if (session()->has('success'))
    <script>
        toastr.success("{{ session()->get('success') }}", 'Success', options);
    </script>
@endif


@if (session()->has('error'))
    <script>
        toastr.error("{{ session()->get('error') }}", 'Error', options);
    </script>
@endif

