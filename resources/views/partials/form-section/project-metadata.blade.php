<x-form-section name="Metadata">
    <x-slot name="description">
        Information about the project you are creating.
    </x-slot>

    <x-slot name="icon">
        <svg class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
        </svg>
    </x-slot>

    <div class="col-span-6 sm:col-span-3">
        <label for="project_vendor" class="block text-sm font-medium text-gray-700">Vendor Name</label>
        <input type="text" name="project_vendor" id="project_vendor" value="laravel" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>

    <div class="col-span-6 sm:col-span-3">
        <label for="project_name" class="block text-sm font-medium text-gray-700">Project Name</label>
        <input type="text" name="project_name" id="project_name" value="laravel" class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>

    <div class="col-span-6">
        <label for="project_description" class="block text-sm font-medium text-gray-700">
            Description
        </label>
        <div class="mt-1">
            <textarea id="project_description" name="project_description" rows="3" class="shadow-sm focus:ring-red-500 focus:border-red-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="A beautiful place for people to built awesome stuff."></textarea>
        </div>
    </div>
</x-form-section>
