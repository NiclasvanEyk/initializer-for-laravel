@props(['name', 'description', 'icon' => null, 'open' => true])

<div class="mt-10 sm:mt-0" x-data="{ open: {{$open}} }">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1 relative w-full">
            <div class="px-4 sm:px-0 sticky top-3">
                <button class="flex w-full" @click="open = !open">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 flex">
                        {{ $icon }} {{ $name }}
                    </h3>

                    <div class="flex-1"></div>

                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <p class="mt-1 text-sm text-gray-600">
                    {{ $description }}
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2" x-show="open">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
