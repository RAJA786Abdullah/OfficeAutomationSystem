<script>
    $(document).bind('keydown', 'alt++', function (e) {
        e.preventDefault();
        e.stopPropagation();
        @if (isset($createURL))
            document.location.href = '{{$createURL}}';
        @else
            document.location.href += '/create';
        @endif
    });
</script>
