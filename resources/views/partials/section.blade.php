@php use InitializerForLaravel\Core\Configuration\Option;use InitializerForLaravel\Core\Configuration\Section; @endphp
@php
    /** @var Section $section */
@endphp

<x-form-section :name="$section->name">
    @foreach($section->children as $child)
        @if($child instanceof Option)
            <x-option>
                <x-form-control.checkbox
                        id="{{ $child->id }}"
                        href="{{ $child->link }}"
                        {{-- TODO :checked="request(old(checked))" --}}
                        heading="{{ $sftpDriver->name() }}"
                >
                    {{-- TODO: Markdown? --}}
                    {{ $child->description }}

                    @if($child->fromCommunity)
                        <x-tag.community/>
                    @endif

                    @if($child->service)
                        <x-tag.sail/>
                    @endif
                </x-form-control.checkbox>
            </x-option>
        @endif
    @endforeach
</x-form-section>