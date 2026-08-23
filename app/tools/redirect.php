<?php

namespace app\tools;

class Redirect
{
    public static function to(string $controller, string $action):never
    {
        error_log('DANS Redirect');
        header(
            "Location: index.php?controller={$controller}&action={$action}"
        );

        exit;
    }
}