<footer class="footer">
    <div class="container">
        <div class="content">
            <div class="columns">
                <div class="column">
                    {{--You can change it or delete as you want--}}
                    @if (\Lang::has('halfdream::front.copyright'))
                        <p>
                            {!! __('halfdream::front.copyright.made') !!}
                        </p>
                        <p>
                            <small>
                                {{ __('halfdream::front.copyright.license') }}
                                <a href="http://opensource.org/licenses/mit-license.php" target="_blank">MIT</a>.
                            </small>
                        </p>
                    @endif

                    @include('modules.menu.includes.socialmenu', ['items' => menu('social')])
                </div>
                <div class="column">
                    @include('modules.menu.includes.footermenu', ['items' => menu('footer')])
            </div>
        </div>
    </div>
</footer>
