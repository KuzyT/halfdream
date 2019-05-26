@if ($scripts)
    <script>
        @foreach($scripts as $script)
        {!! $script->render() !!}
        @endforeach
    </script>
@endif