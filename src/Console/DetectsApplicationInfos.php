<?php

namespace TerryLucasInterFaceLog\Logger\Console;

use Illuminate\Container\Container;

/**
 * Class DetectsApplicationInfos
 * User: Terry Lucas
 * @package TerryLucasInterFaceLog\Logger\Console
 */
trait DetectsApplicationInfos
{
    /**
     * Get the application namespace.
     *
     * @return string
     */
    protected function getAppNamespace()
    {
        return Container::getInstance()->getNamespace();
    }

    /**
     * User: Terry Lucas
     * @return string
     */
    protected function getAppVersion()
    {
        $version = Container::getInstance()->version();

        if (isset($version) && !empty(trim($version))) {
            $versionArr = explode('.', $version);

            if (isset($versionArr[0]) && isset($versionArr[1])) return $versionArr[0] . $versionArr[1];
        }

        return '';
    }
}