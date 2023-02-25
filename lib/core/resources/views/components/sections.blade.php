@php
    use InitializerForLaravel\Core\Configuration\{Section,Choice,Option,Paragraph};

    /** @var Section[] $sections */
@endphp

@foreach($sections as $section)
    <x-form-section :name="$section->name">
        <x-slot name="icon">
            {!! $section->icon !!}
        </x-slot>

        <x-slot name="description">
            {!! $section->description !!}
        </x-slot>

        @foreach($section->children as $child)
            @if($child instanceof Paragraph)
                {!! $child->text !!}
            @endif

            @if($child instanceof Choice)
                {{ $child->includesNone }}
            @endif

            @if($child instanceof Option)
            @endif
        @endforeach
    </x-form-section>
@endforeach