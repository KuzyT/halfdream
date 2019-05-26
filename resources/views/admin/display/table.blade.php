<table class="table is-bordered is-striped is-narrow is-fullwidth">
    <thead>
    <tr>
        @foreach ($columns as $column)
            <th {!! $column->renderTitleAttributes() !!}>
                {!! $column->getLabel() !!}
            </th>
        @endforeach
    </tr>
    </thead>

    <tbody>
    @forelse ($collection as $model)
        <tr>
            @foreach ($columns as $column)
                @php
                    $column->setModel($model);
                @endphp
                <td {!! $column->renderAttributes() !!}>
                    {!! $column->render() !!}
                </td>
            @endforeach
        </tr>
    @empty
        <tr>
            <td colspan="{{ count($columns) }}">
                {{ __('halfdream::admin.empty') }}
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

@if ($collection->isNotEmpty() && ($collection instanceof Illuminate\Pagination\LengthAwarePaginator))
    {{ $collection->links('halfdream::vendor.pagination.bulma') }}
@endif