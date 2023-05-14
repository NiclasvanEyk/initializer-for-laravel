@php
    use Domains\CreateProjectForm\Http\Request\CreateProjectRequest\CreateProjectRequestParameter as P;
    use Domains\Laravel\RelatedPackages\Infrastructure\Flysystem;
    
    $minIO = new \Domains\Laravel\Sail\MinIO();
    $minIOParameter = P::USES_MINIO;
    $usesMinIO = checkbox_checked($minIOParameter);
    
    $s3Driver = new Flysystem\S3Driver();
    $s3Parameter = P::USES_FLYSYSTEM_S3_DRIVER;
    $usesS3Driver = checkbox_checked($s3Parameter);
    
    $sftpDriver = new Flysystem\SftpDriver();
    $sftpParameter = P::USES_FLYSYSTEM_SFTP_DRIVER;
    $usesSftpDriver = checkbox_checked($sftpParameter);
    
    $ftpDriver = new Flysystem\FtpDriver();
    $ftpParameter = P::USES_FLYSYSTEM_FTP_DRIVER;
    $usesFtpDriver = checkbox_checked($ftpParameter);
    
    $readonlyDriver = new Flysystem\ReadonlyDriver();
    $readonlyParameter = P::USES_FLYSYSTEM_READONLY_DRIVER;
    $usesReadonlyDriver = checkbox_checked($readonlyParameter);
    
    $scopedDriver = new Flysystem\ScopedDriver();
    $scopedParameter = P::USES_FLYSYSTEM_SCOPED_DRIVER;
    $usesScopedDriver = checkbox_checked($scopedParameter);
@endphp

<x-form-section name="File Storage">
    <x-slot name="description">
        <p>
            Laravel integrates uses
            <x-link href="https://flysystem.thephpleague.com">Flysystem</x-link>
            to abstract away any filesystem, like your storage folder,
            remote FTP servers or cloud storage like Amazon S3.
        </p>

        <p>
            Some filesystems are not as popular, so they are not supported out
            of the box. Choose the ones you need from the options below. To
            simulate a
            <x-link href="https://laravel.com/docs/filesystem#amazon-s3-compatible-filesystems">S3-like</x-link>
            filesystem, you can choose to include the MinIO sail service, which
            is api compatible with S3, but runs locally so you don't need to
            configure cloud storage for your local development needs.
        </p>
    </x-slot>

    <x-slot name="icon">
        <x-icons.storage />
    </x-slot>

    <x-form-control.group heading="Utility">
        <x-form-control.checkbox id="{{ $scopedParameter }}" href="{{ $scopedDriver->href() }}" :checked="$usesScopedDriver"
            heading="{{ $scopedDriver->name() }}" flush>
            {!! $scopedDriver->description() !!}
        </x-form-control.checkbox>

        <x-form-control.checkbox id="{{ $readonlyParameter }}" href="{{ $readonlyDriver->href() }}" :checked="$usesReadonlyDriver"
            heading="{{ $readonlyDriver->name() }}" flush>
            {!! $readonlyDriver->description() !!}
        </x-form-control.checkbox>
    </x-form-control.group>


    <x-form-control.group heading="Traditional Servers">
        <x-form-control.checkbox id="{{ $ftpParameter }}" href="{{ $ftpDriver->href() }}" :checked="$usesFtpDriver"
            heading="{{ $ftpDriver->name() }}" flush>
            {!! $ftpDriver->description() !!}
        </x-form-control.checkbox>

        <x-form-control.checkbox id="{{ $sftpParameter }}" href="{{ $sftpDriver->href() }}" :checked="$usesSftpDriver"
            heading="{{ $sftpDriver->name() }}" flush>
            {!! $sftpDriver->description() !!}
        </x-form-control.checkbox>
    </x-form-control.group>

    <x-form-control.group heading="Cloud">
        <x-sail.option :name="$minIOParameter" :checked="$usesMinIO" :option="$minIO" flush />

        <x-form-control.checkbox id="{{ $s3Parameter }}" href="{{ $s3Driver->href() }}" :checked="$usesS3Driver"
            heading="{{ $s3Driver->name() }}" flush>
            Allows your application to store files on
            <x-link href="https://laravel.com/docs/filesystem#amazon-s3-compatible-filesystems">
                S3 and compatible filesystems
            </x-link>, like Digital Ocean Spaces or MinIO.
        </x-form-control.checkbox>
    </x-form-control.group>
</x-form-section>
