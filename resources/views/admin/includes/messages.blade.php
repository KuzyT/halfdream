@if (isset($errors) && $errors->any() && isset($showerrors) && $showerrors)
    <script>
        Window.app.$toast.open({
            duration: {{ config('halfdream.admin.messages_duration') }},
            message:
                '@foreach ($errors->all() as $error)
                {!! $error !!}<br/>
                @endforeach'
            ,
            type: 'is-danger'
        })
    </script>
@elseif (session()->get('flash_success'))
    <script>
        Window.app.$toast.open({
            duration: {{ config('halfdream.admin.messages_duration') }},
            message:
                    @if(is_array(json_decode(session()->get('flash_success'), true)))
                        '{!! implode('', session()->get('flash_success')->all(':message<br/>')) !!}'
            @else
            '{!! session()->get('flash_success') !!}'
            @endif
            ,
            type: 'is-success'
        })
    </script>
@elseif (session()->get('flash_warning'))
    <script>
        Window.app.$toast.open({
            duration: {{ config('halfdream.admin.messages_duration') }},
            message:
                    @if(is_array(json_decode(session()->get('flash_warning'), true)))
                        '{!! implode('', session()->get('flash_warning')->all(':message<br/>')) !!}'
            @else
            '{!! session()->get('flash_warning') !!}'
            @endif
            ,
            type: 'is-warning'
        })
    </script>
@elseif (session()->get('flash_info'))
    <script>
        Window.app.$toast.open({
            duration: {{ config('halfdream.admin.messages_duration') }},
            message:
                    @if(is_array(json_decode(session()->get('flash_info'), true)))
                        '{!! implode('', session()->get('flash_info')->all(':message<br/>')) !!}'
            @else
            '{!! session()->get('flash_info') !!}'
            @endif
            ,
            type: 'is-info'
        })
    </script>
@elseif (session()->get('flash_danger'))
    <script>
        Window.app.$toast.open({
            duration: {{ config('halfdream.admin.messages_duration') }},
            message:
                    @if(is_array(json_decode(session()->get('flash_danger'), true)))
                        '{!! implode('', session()->get('flash_danger')->all(':message<br/>')) !!}'
            @else
            '{!! session()->get('flash_danger') !!}'
            @endif
            ,
            type: 'is-danger'
        })
    </script>
@elseif (session()->get('flash_message'))
    <script>
        Window.app.$toast.open({
            duration: {{ config('halfdream.admin.messages_duration') }},
            message:
            @if(is_array(json_decode(session()->get('flash_message'), true)))
            '{!! implode('', session()->get('flash_message')->all(':message<br/>')) !!}'
            @else
            '{!! session()->get('flash_message') !!}'
            @endif
        })
    </script>
@endif