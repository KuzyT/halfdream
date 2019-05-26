<div {!! $attributes !!}>
    @foreach($elements as $element)
        {!! $element->render() !!}
    @endforeach
</div>