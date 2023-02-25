@php
    use InitializerForLaravel\Core\Configuration\{
        Section,
        Choice,
        Option,
        Paragraph
    };

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
                Choice {{ $child->name }}<br>
                @foreach($child->options as $option)
                    Option {{ $option->name }}<br>
                @endforeach
            @endif

            @if($child instanceof Option)
                <x-form-control.checkbox
                    :id="$child->id"
                    :heading="$child->name"
                    :href="$child->link"
                >
                    {!! $child->description !!}
                    <x-slot name="tags">
                        {{-- TODO --}}
                    </x-slot>
                </x-form-control.checkbox>
            @endif
        @endforeach
    </x-form-section>
@endforeach