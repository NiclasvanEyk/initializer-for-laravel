<label
    for="{{$id}}"
    class="
        flex-1 flex flex-col items-center justify-center
        overflow-hidden border
        rounded-md bg-white shadow transition
    "
    x-bind:class="{{$model}} === '{{$id}}' ? '{{$backgroundSelectedStyles}} shadow-md' : 'dark:bg-black'"
>
    <header class="p-4 flex flex-row dark:bg-opacity-0 dark:text-gray-100 w-full justify-center items-center">
        <a href="{{$href}}" target="_blank">
            <img src="{{$logoSrc}}" alt="{{$logoAlt}}" class="max-h-[48px] w-auto" />
        </a>

        <span class="ml-3 text-4xl">{{$heading}}</span>
    </header>

    <div class="flex-1 dark:text-gray-100 flex flex-col items-center my-2 w-full px-4">
        {{$slot}}
    </div>

    <div
        class="p-4 w-full flex items-center justify-center transition"
        x-bind:class="{{$model}} === '{{$id}}' ? '{{$backgroundInputStyles}} {{$attributes['class']}}' : 'bg-gray-100 dark:bg-gray-900'"
    >
        <input
            type="radio" id="{{$id}}" name="{{$model}}" value="{{$id}}"
            x-model="{{$model}}"
            class="{{$focusStyles}} transition"
        />
    </div>
</label>
