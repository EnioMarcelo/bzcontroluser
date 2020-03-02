<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitae879da1b34a5dbf6bf6849156918cc9
{
    public static $files = array (
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '72579e7bd17821bb1321b87411366eae' => __DIR__ . '/..' . '/illuminate/support/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Contracts\\Translation\\' => 30,
            'Symfony\\Component\\Translation\\' => 30,
            'Svg\\' => 4,
        ),
        'I' => 
        array (
            'Illuminate\\Support\\' => 19,
            'Illuminate\\Events\\' => 18,
            'Illuminate\\Database\\' => 20,
            'Illuminate\\Contracts\\' => 21,
            'Illuminate\\Container\\' => 21,
        ),
        'F' => 
        array (
            'FontLib\\' => 8,
        ),
        'D' => 
        array (
            'Dompdf\\' => 7,
            'Doctrine\\Common\\Inflector\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Contracts\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation-contracts',
        ),
        'Symfony\\Component\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation',
        ),
        'Svg\\' => 
        array (
            0 => __DIR__ . '/..' . '/phenx/php-svg-lib/src/Svg',
        ),
        'Illuminate\\Support\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/support',
        ),
        'Illuminate\\Events\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/events',
        ),
        'Illuminate\\Database\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/database',
        ),
        'Illuminate\\Contracts\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/contracts',
        ),
        'Illuminate\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/illuminate/container',
        ),
        'FontLib\\' => 
        array (
            0 => __DIR__ . '/..' . '/phenx/php-font-lib/src/FontLib',
        ),
        'Dompdf\\' => 
        array (
            0 => __DIR__ . '/..' . '/dompdf/dompdf/src',
        ),
        'Doctrine\\Common\\Inflector\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/inflector/lib/Doctrine/Common/Inflector',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/..' . '/nesbot/carbon/src',
    );

    public static $prefixesPsr0 = array (
        'U' => 
        array (
            'UpdateHelper\\' => 
            array (
                0 => __DIR__ . '/..' . '/kylekatarnls/update-helper/src',
            ),
        ),
        'S' => 
        array (
            'Sabberworm\\CSS' => 
            array (
                0 => __DIR__ . '/..' . '/sabberworm/php-css-parser/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Cpdf' => __DIR__ . '/..' . '/dompdf/dompdf/lib/Cpdf.php',
        'Create' => __DIR__ . '/../../..' . '/application/models/generic/Create.php',
        'Delete' => __DIR__ . '/../../..' . '/application/models/generic/Delete.php',
        'HTML5_Data' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/Data.php',
        'HTML5_InputStream' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/InputStream.php',
        'HTML5_Parser' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/Parser.php',
        'HTML5_Tokenizer' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/Tokenizer.php',
        'HTML5_TreeBuilder' => __DIR__ . '/..' . '/dompdf/dompdf/lib/html5lib/TreeBuilder.php',
        'MY_Controller' => __DIR__ . '/../../..' . '/application/core/MY_Controller.php',
        'MY_Form_validation' => __DIR__ . '/../../..' . '/application/libraries/MY_Form_validation.php',
        'MY_Lang' => __DIR__ . '/../../..' . '/application/core/MY_Lang.php',
        'MY_Loader' => __DIR__ . '/../../..' . '/application/core/MY_Loader.php',
        'MY_Model' => __DIR__ . '/../../..' . '/application/core/MY_Model.php',
        'MY_ModelEloquent' => __DIR__ . '/../../..' . '/application/core/MY_ModelEloquent.php',
        'MY_Router' => __DIR__ . '/../../..' . '/application/core/MY_Router.php',
        'MY_Upload' => __DIR__ . '/../../..' . '/application/libraries/MY_Upload.php',
        'Read' => __DIR__ . '/../../..' . '/application/models/generic/Read.php',
        'Settings_model' => __DIR__ . '/../../..' . '/application/models/Settings_model.php',
        'Update' => __DIR__ . '/../../..' . '/application/models/generic/Update.php',
        'User_acl_groups' => __DIR__ . '/../../..' . '/application/models/default/User_acl_groups.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitae879da1b34a5dbf6bf6849156918cc9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitae879da1b34a5dbf6bf6849156918cc9::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInitae879da1b34a5dbf6bf6849156918cc9::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitae879da1b34a5dbf6bf6849156918cc9::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitae879da1b34a5dbf6bf6849156918cc9::$classMap;

        }, null, ClassLoader::class);
    }
}
