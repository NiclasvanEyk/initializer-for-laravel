@php

@endphp

<x-form-section name="Notifications">
    <x-slot name="description">
        <p>
            Notifications are everywhere and Laravel supports multiple ways of
            sending those to you users. You can store them in the database,
        </p>
    </x-slot>

    <x-slot name="icon">
        <x-icons.bell />
    </x-slot>

    <x-form-control.group
        heading="Additional Driver"
{{--        href="https://laravel.com/docs/mail#driver-prerequisites"--}}
    >
{{--        <x-radio-option--}}
{{--            :id="$mailgunOption"--}}
{{--            :label="$mailgun->name()"--}}
{{--            :href="$mailgun->href()"--}}
{{--            :model="$model"--}}
{{--            :name="$driverParameter"--}}
{{--        >--}}
{{--            {{ $mailgun->description() }}--}}
{{--        </x-radio-option>--}}

{{--        <x-radio-option--}}
{{--            :id="$postmarkOption"--}}
{{--            :label="$postmark->name()"--}}
{{--            :href="$postmark->href()"--}}
{{--            :model="$model"--}}
{{--            :name="$driverParameter"--}}
{{--        >--}}
{{--            {{ $postmark->description() }}--}}
{{--        </x-radio-option>--}}
    </x-form-control.group>
</x-form-section>