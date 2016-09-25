<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'android/berita-add'
        ,'android/mendaftar'
        ,'android/ceklogin'
        ,'android/berita-deleted'
        ,'android/komentar-add'
        ,'android/komentar-deleted'
        ,'android/profileuseredit'
        ,'android/profilegantipassword'
        ,'android/lokasiadd'
    ];
}
