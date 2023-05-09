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
                <x-form-control.group :heading="$child->name">
                    @foreach($child->options as $option)
                        <x-radio-option
                            :id="$option->id"
                            :label="$option->name"
            :href="$option->link"
            model="foo"
                        >
                            {!! $option->description !!}
                            <x-slot name="tags">
                                {{-- TODO --}}
                            </x-slot>
                        </x-radio-option>
                    @endforeach
                </x-form-control.group>
            @endif

            @if($child instanceof Option)
                <x-initializer::option
                    :id="$child->id"
                    :heading="$child->name"
                    :href="$child->link"
                >
                    {!! $child->description !!}
                    <x-slot name="tags">
                        {{-- TODO --}}
                    </x-slot>
                </x-initializer::option>
            @endif
        @endforeach
    </x-form-section>
@endforeach