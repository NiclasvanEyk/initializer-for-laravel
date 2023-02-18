<?php

namespace App\View;

enum Options: string
{
    case FlysystemFtp = 'flysystem-ftp' ;
    case FlysystemS3 = 'flysystem-aws-s3' ;
    case FlysystemScoped = 'flysystem-scoped' ;
    case FlysystemSftp = 'flysystem-sftp' ;
    case FlysystemReadonly = 'flysystem-readonly' ;
    case Fortify = 'fortify';
    case MinIO = 'minio';
    case Passport = 'passport';
    case Socialite = 'socialite';
}
