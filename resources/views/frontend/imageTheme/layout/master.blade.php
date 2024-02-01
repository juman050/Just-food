@include('frontend.imageTheme.partials.header')
<script>
    var str_sts = '{{$storeDatas->store_extra_tiny_2}}';
    var store_extra = '{{$storeDatas->store_extra_tiny}}';
</script>
@yield('mainContent')

@include('frontend.imageTheme.partials.footer')