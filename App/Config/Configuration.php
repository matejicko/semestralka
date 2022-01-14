<?php

namespace App\Config;

/**
 * Class Configuration
 * Main configuration for the application
 * @package App\Config
 */
class Configuration
{
    public const DB_HOST = 'localhost';
    public const DB_NAME = 'svetove_kuchyne';
    public const DB_USER = 'root';
    public const DB_PASS = 'dtb456';

    public const LOGIN_URL = '/';

    public const ROOT_LAYOUT = 'root.layout.view.php';

    public const UPLOAD_DIR_PROFILE_PHOTO = 'public/images/profiles/';
    public const UPLOAD_DIR_RECIPE_PHOTO = 'public/images/meals/';

    public const DEBUG_QUERY = false;
}