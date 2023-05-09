<label
    for="{{$id}}"
    class="flex flex-col items-center justify-center flex-1 overflow-hidden transition bg-white border rounded-md shadow "
    x-bind:class="{{$model}} === '{{$id}}' ? '{{$backgroundSelectedStyles}} shadow-md' : 'dark:bg-gray-900'"
>
    <header class="flex flex-row items-center justify-center w-full p-4 dark:bg-opacity-0 dark:text-gray-100">
        <a href="{{$href}}" target="_blank">
            <img src="{{$logoSrc}}" alt="{{$logoAlt}}" class="max-h-[48px] w-auto" />
        </a>

        <span class="ml-3 tracking-tight text-4xl">{{$heading}}</span>
    </header>

    <div class="flex flex-col items-center flex-1 w-full px-4 my-2 dark:text-gray-100">
        {{$slot}}
    </div>

    <div
        class="flex items-center justify-center w-full p-4 transition"
        x-bind:class="{{$model}} === '{{$id}}' ? '{{$backgroundInputStyles}} {{$attributes['class']}}' : 'bg-gray-100 dark:bg-gray-800'"
    >
        <input
            type="radio" id="{{$id}}" name="{{$model}}" value="{{$id}}"
            x-model="{{$model}}"
            class="{{$focusStyles}} transition"
        />
    </div>
</label>