<?php

namespace App\Classes\Application;

class AppHelper
{
    /**
     * Return active nav classes if the current path name matches this path name.
     *
     * @param string   $pathName
     * @param array    $classes
     * @param boolean  $isPartialPath
     *
     * @return string
     */
    public static function setActive($pathName, $classes = [], $isPartialPath = false): string
    {
        if(\Route::currentRouteName() == $pathName || ($isPartialPath && \Request::is($pathName.'*'))){
            $classes = array_merge($classes, ['nav-active', 'active']);
        }

        return ' class="'.implode(' ', $classes).'"';
    }

    /**
     * @param $value
     * @param $includeExt
     * @param $forLink
     *
     * @return string
     */
    public static function formatPhone($value, $includeExt = false, $forLink = false): string
    {

        if(is_string($value) && strpos($value, ' x') !== false){
            return preg_replace(
                !$forLink ? "/^(\d{3})(\d{3})(\d{4})(\d{1,6})$/" : '/^(\d{10})(\d{1,6})$/',
                !$forLink ? '($1) $2-$3 ext. $4' : '$1;$2',
                preg_replace("/[^0-9]/", '', $value)
            );
        }

        return is_string($value) ?
            preg_replace(
                !$forLink ? "/^(\d{3})(\d{3})(\d{4})$/" : "/^(\d{10})$/",
                !$forLink ? '($1) $2-$3' : '$1',
                preg_replace("/[^0-9]/", '', $value)
            ) : '';
    }
}
