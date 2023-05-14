<?php

namespace Domains\ConfigAdjustment;

use Domains\ConfigAdjustment\Concerns\MakesArchiveAdjustments;
use Domains\CreateProjectForm\Sections\Scout\ScoutDriver;
use Domains\CreateProjectForm\Sections\Search;
use Domains\CreateProjectForm\Sections\Storage;
use Illuminate\Support\Str;
use PhpZip\ZipFile;

/**
 * Appends the default config to `config/filesystems.php` mentioned in
 * https://laravel.com/docs/filesystem#ftp-driver-configuration.
 */
class FlysystemAdjuster
{
    use MakesArchiveAdjustments;

    public function adjustDefaults(
        ZipFile $archive,
        Storage $storage,
    ) : void {
        $contents = $archive->getEntryContents("config/filesystems.php");

        $adjusted = $this->adjustContents($contents, $storage);
        $this->adjustEnvExample($archive, $storage);

        $archive->addFromString("config/filesystems.php", $adjusted);
    }

    private function adjustEnvExample(ZipFile $archive, Storage $storage) : void
    {
        if ($storage->usesFtp) {
            $this->addEnvExampleBlock($archive, <<<'ENV'
            FTP_USERNAME=
            FTP_HOST=
            FTP_PASSWORD=
            ENV);
        }

        if ($storage->usesSftp) {
            $this->addEnvExampleBlock($archive, <<<'ENV'
            SFTP_HOST
            SFTP_USERNAME
            SFTP_PASSWORD
            SFTP_PRIVATE_KEY
            SFTP_PASSPHRASE
            ENV);
        }
    }

    public function adjustContents(string $contents, Storage $storage) : string
    {
        if ($storage->usesFtp) {
            $contents = $this->prependFilesystemConfig($contents, $this->defaultFtpConfig());
        }

        if ($storage->usesSftp) {
            $contents = $this->prependFilesystemConfig($contents, $this->defaultSftpConfig());
        }

        return $contents;
    }

    private function prependFilesystemConfig(string $config, string $entry) : string
    {
        $marker = "        's3' => [";

        return Str::replace($marker, "$entry\n\n$marker", $config);
    }

    private function defaultFtpConfig() : string
    {
        $c = <<<'CONFIG'
                'ftp' => [
                    'driver' => 'ftp',
                    'host' => env('FTP_HOST'),
                    'username' => env('FTP_USERNAME'),
                    'password' => env('FTP_PASSWORD'),

                    // Optional FTP Settings...
                    // 'port' => env('FTP_PORT', 21),
                    // 'root' => env('FTP_ROOT'),
                    // 'passive' => true,
                    // 'ssl' => true,
                    // 'timeout' => 30,
                ],
        CONFIG;

        return $c;
    }

    private function defaultSftpConfig() : string
    {
        $c = <<<'CONFIG'
                'sftp' => [
                    'driver' => 'sftp',
                    'host' => env('SFTP_HOST'),

                    // Settings for basic authentication...
                    'username' => env('SFTP_USERNAME'),
                    'password' => env('SFTP_PASSWORD'),

                    // Settings for SSH key based authentication with encryption password...
                    'privateKey' => env('SFTP_PRIVATE_KEY'),
                    'passphrase' => env('SFTP_PASSPHRASE'),

                    // Settings for file / directory permissions...
                    'visibility' => 'private', // `private` = 0600, `public` = 0700
                    'directory_visibility' => 'private', // `private` = 0700, `public` = 0755

                    // Optional SFTP Settings...
                    // 'hostFingerprint' => env('SFTP_HOST_FINGERPRINT'),
                    // 'maxTries' => 4,
                    // 'passphrase' => env('SFTP_PASSPHRASE'),
                    // 'port' => env('SFTP_PORT', 22),
                    // 'root' => env('SFTP_ROOT', ''),
                    // 'timeout' => 30,
                    // 'useAgent' => true,
                ],
        CONFIG;

        return $c;
    }
}