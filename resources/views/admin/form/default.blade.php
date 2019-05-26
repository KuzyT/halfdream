<form method="POST" action="{{ $id ? route('admin.module.update', ['module' => $key, 'id' => $id]) : route('admin.module.store', $key) }}" >
    @if ($id)
        @method('PUT')
    @endif

    {{ csrf_field() }}

    @foreach($elements as $element)
        {!! $element->render() !!}
    @endforeach

</form>