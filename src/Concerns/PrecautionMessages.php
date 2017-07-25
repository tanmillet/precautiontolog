<?php

namespace TerryLucasInterFaceLog\Logger\Concerns;

use Illuminate\Support\Facades\Config;

/**
 * Class PrecautionMessages
 * User: Terry Lucas
 */
trait PrecautionMessages
{
    /**
     * User: Terry Lucas
     * @return mixed
     * @throws \Exception
     */
    public function getHosts()
    {
        $precautions = Config::get('precaution');
        if(!isset($precautions['hosts']) || !is_array($precautions['hosts'])) throw  new \Exception('The log server is not configured');

        return $precautions['hosts'];
    }
}