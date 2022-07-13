@section('scripts')
    <script type="text/javascript">
        function Filter(){
            var options = $('#mySelect option');
            var query = $('#myText').val().toLowerCase();
            options.filter(function(){
                $(this).toggle($(this).text().toLowerCase().indexOf(query) > -1);
            });
        }
    </script>
@endsection