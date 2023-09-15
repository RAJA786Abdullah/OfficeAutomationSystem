<script>
    $(function () {
        $.hotkeys.options.filterInputAcceptingElements = false;
        $.hotkeys.options.filterContentEditable = false;
        $.hotkeys.options.filterTextInputs = false;

        $(document).bind('keydown', 'alt+p', function (e) {
            e.preventDefault();
            e.stopPropagation();
            document.location.href = '{{route('purchase.index')}}';
        });
        $(document).bind('keydown', 'alt+shift+p', function (e) {
            e.preventDefault();
            e.stopPropagation();
            document.location.href = '{{route('purchase.create')}}';
        });


        $(document).bind('keydown', 'alt+s', function (e) {
            e.preventDefault();
            e.stopPropagation();
            document.location.href = '{{route('sale.index')}}';
        });
        $(document).bind('keydown', 'alt+shift+s', function (e) {
            e.preventDefault();
            e.stopPropagation();
            document.location.href = '{{route('sale.create')}}';
        });

        $(document).bind('keydown', 'alt+c', function (e) {
            e.preventDefault();
            e.stopPropagation();
            document.location.href = '{{route('companyPayment.index')}}';
        });

        $(document).bind('keydown', 'alt+v', function (e) {
            e.preventDefault();
            e.stopPropagation();
            document.location.href = '{{route('partyPayment.index')}}';
        });

        $(document).bind('keydown', 'alt+d', function (e) {
            e.preventDefault();
            e.stopPropagation();
            document.location.href = '{{route('home')}}';
        });

        $(document).bind('keydown', 'alt+shift+d', function (e) {
            e.preventDefault();
            e.stopPropagation();
            document.location.href = '{{route('dailyReport.pdf')}}';
        });

        $(document).bind('keydown', 'alt+Backspace', function (e) {
            e.preventDefault();
            e.stopPropagation();
            document.location.href = '{{ url()->previous() }}';
        });

        $(document).bind('keydown', 'ctrl+s', function (e) {
            e.preventDefault();
            e.stopPropagation();
            if ($("button[type='submit']").length > 0) {
                var btn = $("button[type='submit']").first();
                $(btn).trigger('click');
            }
        });
    });
</script>
