@if(Session::has('success'))
    <script>
        swal("{{Session::get('success')}}", "", "success");
    </script>
@endif

@if(Session::has('alert'))
    <script>
        swal("{{Session::get('alert')}}", "", "warning");
    </script>
@endif