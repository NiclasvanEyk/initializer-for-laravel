@php
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
    use Domains\Laravel\RelatedPackages\Infrastructure\Flysystem;

    $minIO = new \Domains\Laravel\Sail\MinIO();
    $minIOParameter = P::USES_MINIO;
    $usesMinIO = old($minIOParameter, request()->has($minIOParameter));

    $s3Driver = new Flysystem\S3Driver();
    $s3Parameter = P::USES_FLYSYSTEM_S3_DRIVER;
    $usesS3Driver = old($s3Parameter, request()->has($s3Parameter));

    $cachedAdapter = new Flysystem\CachedAdapter();
    $cachedParameter = P::USES_FLYSYSTEM_CACHED_ADAPTER;
    $usesCachedAdapter = old($cachedParameter, request()->has($cachedParameter));

    $sftpDriver = new Flysystem\SftpDriver();
    $sftpParameter = P::USES_FLYSYSTEM_SFTP_DRIVER;
    $usesSftpDriver = old($sftpParameter, request()->has($sftpParameter));
@endphp

<x-form-section name="Storage">
    <x-slot name="description">
        If you want to give your users the ability to execute full-text search
        queries, which go beyond what a simple <code>where</code> SQL clause
        could achieve, this section might be for you.
    </x-slot>

    <x-slot name="icon">
        <x-icons.storage />
    </x-slot>

    <x-form-control.checkbox
        id="{{ $sftpDriver->id() }}"
        href="{{ $sftpDriver->href() }}"
        :checked="$usesSftpDriver"
        heading="{{ $sftpDriver->name() }}"
    >
         {!! $sftpDriver->description() !!}
    </x-form-control.checkbox>

    <x-form-control.checkbox
        id="{{ $cachedAdapter->id() }}"
        href="{{ $cachedAdapter->href() }}"
        :checked="$usesCachedAdapter"
        heading="{{ $cachedAdapter->name() }}"
    >
        Boosts performance of filesystem operations by caching meta-data.
        For more information, consult the <x-link
            href="https://flysystem.thephpleague.com/v1/docs/advanced/caching"
        >Flysystem documentation</x-link>.
    </x-form-control.checkbox>

    <x-form-control.group heading="Cloud">
        <x-sail.option
            :name="$minIOParameter"
            :checked="$usesMinIO"
            :option="$minIO"
            flush
        />

        <x-form-control.checkbox
            id="{{ $s3Driver->id() }}"
            href="{{ $s3Driver->href() }}"
            :checked="$usesS3Driver"
            heading="{{ $s3Driver->name() }}"
            flush
        >
            Allows your application to store files on
            <x-link href="https://laravel.com/docs/filesystem#amazon-s3-compatible-filesystems">
                S3 and compatible filesystems
            </x-link>, like Digital Ocean Spaces or MinIO.
        </x-form-control.checkbox>
    </x-form-control.group>
</x-form-section>
