@php
    use Domains\Laravel\ComposerPackages\Packages\Horizon;
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
    use Domains\Laravel\Sail;
    use Domains\CreateProjectForm\Sections\Queue;
    use Domains\CreateProjectForm\Sections\Queue\QueueDriverOption;

    $queueParameter = P::QUEUE_DRIVER;
    $horizonParameter = P::USES_HORIZON;
    $usesHorizon = checkbox_checked($horizonParameter);

    $model = Str::studly($queueParameter);
    $default = option_selected($queueParameter, QueueDriverOption::NONE);

    $redis = new Sail\Redis();
    $beanstalkd = new Queue\BeanstalkdQueueDriver();
    $sqs = new Queue\SqsQueueDriver();
    $horizon = new Horizon()
@endphp

<x-form-section name="Queue">
    <x-slot name="description">
        <p class="mb-2">
            While building your web application, you may have some tasks, such
            as parsing and storing an uploaded CSV file, that take too long to
            perform during a typical web request. Thankfully, Laravel allows you
            to easily create queued jobs that may be processed in the
            background. By moving time intensive tasks to a queue, your
            application can respond to web requests with blazing speed and
            provide a better user experience to your customers.
        </p>

        <p>
            <x-link href="https://laravel.com/docs/queues">
                Laravel queues
            </x-link> provide a unified queueing API across a variety of
            different queue backends, such as
            <x-link href="https://aws.amazon.com/sqs">Amazon SQS</x-link>,
            <x-link href="https://laravel.com/docs/redis">Redis</x-link>,
            or even a relational database.
        </p>
    </x-slot>

    <x-slot name="icon">
        <x-icons.dots />
    </x-slot>

    <x-form-control.group
        heading="Driver"
        href="https://laravel.com/docs/queues#introduction"
        x-data="{'{{ $model }}': '{{ $default }}'}"
    >
        <x-radio-option-none
            :model="$model"
            :name="$queueParameter"
        />

        <x-radio-option
            :id="$redis->id() . '-queue'"
            :value="$redis->id()"
            :label="$redis->name()"
            :href="$redis->href()"
            :model="$model"
            :name="$queueParameter"
        >
            {{ $redis->description() }}

            <x-slot name="tags">
                <x-tags.sail />
            </x-slot>
        </x-radio-option>

        <x-radio-option
            :id="$beanstalkd->id()"
            :label="$beanstalkd->name()"
            :href="$beanstalkd->href()"
            :model="$model"
            :name="$queueParameter"
        >
            {{ $beanstalkd->description() }}
        </x-radio-option>

        <x-radio-option
            :id="$sqs->id()"
            :label="$sqs->name()"
            :href="$sqs->href()"
            :model="$model"
            :name="$queueParameter"
        >
            {{ $sqs->description() }}
        </x-radio-option>
    </x-form-control.group>

    <p class="text-gray-600 dark:text-gray-400">
        If you choose to use Redis for your queues, it makes sense to also
        include Laravel Horizon. Horizon allows you to easily monitor key
        metrics of your queue system such as job throughput, runtime, and job
        failures.
    </p>

    <x-first-party-package.option
        :id="$horizonParameter"
        :checked="$usesHorizon"
        :package="$horizon"
    ></x-first-party-package.option>
</x-form-section>