<a href="{{ route('admin.module.edit', ['module' => $key, 'id' => $id]) }}" class="button">
    <span class="icon">
        <font-awesome-icon icon="pencil-alt"></font-awesome-icon>
    </span>
</a>
<confirm-delete-link href="{{ route('admin.module.destroy', ['module' => $key, 'id' => $id]) }}" class="button" :lang="{{ json_encode($lang['delete']) }}">
    <span class="icon">
        <font-awesome-icon icon="trash"></font-awesome-icon>
    </span>
</confirm-delete-link>
