<script>
    var route_prefix = "{{ url('/admin/laravel-filemanager')}}";
</script>
<script src="{{asset('admin/dist/js/pages/stand-alone-button.js')}}"></script>
<script>
    $('.lfm').filemanager('image', {prefix: route_prefix});
    $('#lfm').filemanager('file', {prefix: route_prefix});
</script>


