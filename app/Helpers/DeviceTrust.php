<?php

namespace App\Helpers;

use shell_exec;

class DeviceTrust
{
    static function settings($var)
    {
        $Default_settings = [
            'DEFAULT_LANGUAGE' => "en",
            'BACKEND_PATH' => "dashboard",
            'BACKEND_PAGINATION' => 25,
            'FRONTEND_PAGINATION' => 5,
            'AUTH_STATUS' => true,
            'ARTICLES_STATUS' => true,
            'COMMENT_STATUS' => false,
            'USERS_LIMIT' => 0,
        ];
        return @$Default_settings[$var];
    }
}

?>