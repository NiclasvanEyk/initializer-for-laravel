@php
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
    use Domains\CreateProjectForm\Sections\Broadcasting\BroadcastingChannelOption as Channel;
    use Domains\Laravel\RelatedPackages\Broadcasting as BroadcastingPackages;
    
    $driverParameter = P::BROADCASTING_CHANNEL;
    $driver = enum_option_selected($driverParameter, Channel::default())->value;
    $model = Str::studly($driverParameter);
    
    $pusher = new BroadcastingPackages\Pusher();
    $laravelWebsockets = new BroadcastingPackages\LaravelWebsockets();
    $soketi = new BroadcastingPackages\Soketi();
    $ably = new BroadcastingPackages\Ably();
@endphp

<x-form-section name="Broadcasting">
    <x-slot name="description">
        <p>
            Websockets enable <i>real-time</i> updates for events in your
            applications. This is realized on the client-side by installing
            <x-link href="https://laravel.com/docs/broadcasting#client-side-installation">Laravel Echo</x-link>,
            but the server needs a long-running component to push updates to
            the clients.
        </p>

        <p>
            Laravel supports services such as Pusher or Ably, but the community
            has developed several packages as well, that let you self-host the
            websocket server for free alongside your application.
        </p>
    </x-slot>

    <x-slot name="icon">
        <x-icons.megaphone />
    </x-slot>

    <x-form-control.group heading="Additional Channel" x-data="{ '{{ $model }}': '{{ $driver }}' }">
        <x-radio-option-none :model="$model" :name="$driverParameter" />

        <x-radio-option :id="$pusher->id()" :label="$pusher->name()" :href="$pusher->href()" :model="$model" :name="$driverParameter">
            {{ $pusher->description() }}
        </x-radio-option>

        {{--    Does not currently work with Laravel 9    --}}
        {{--        <x-radio-option --}}
        {{--            :id="$laravelWebsockets->id()" --}}
        {{--            :label="$laravelWebsockets->name()" --}}
        {{--            :href="$laravelWebsockets->href()" --}}
        {{--            :model="$model" --}}
        {{--            :name="$driverParameter" --}}
        {{--        > --}}
        {{--            {{ $laravelWebsockets->description() }} --}}

        {{--            <x-slot name="tags"> --}}
        {{--                <x-tags.community /> --}}
        {{--            </x-slot> --}}
        {{--        </x-radio-option> --}}

        <x-radio-option :id="$soketi->id()" :label="$soketi->name()" :href="$soketi->href()" :model="$model" :name="$driverParameter">
            {{ $soketi->description() }}

            <x-slot name="tags">
                <x-tags.community />
                <x-tags.sail />
            </x-slot>
        </x-radio-option>

        <x-radio-option :id="$ably->id()" :label="$ably->name()" :href="$ably->href()" :model="$model" :name="$driverParameter">
            {{ $ably->description() }}
        </x-radio-option>
    </x-form-control.group>
</x-form-section>
