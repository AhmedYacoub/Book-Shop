<script>

    {{--  success  --}}
    @if (Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
    @endif

    {{--  info  --}}
    @if (Session::has('info'))
        toastr.info('{{ Session::get('info') }}');
    @endif

    {{--  warning  --}}
    @if (Session::has('warning'))
        toastr.warning('{{ Session::get('warning') }}');
    @endif

    {{--  danger  --}}
    @if (Session::has('danger'))
        toastr.error('{{ Session::get('danger') }}');
    @endif

</script>