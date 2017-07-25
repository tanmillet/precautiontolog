<?php
/**
 * Created by PhpStorm.
 * User: Terry Lucas
 * Date: 2017/7/25
 * Time: 11:32
 */

namespace TerryLucasInterFaceLog\Logger;

use TerryLucasInterFaceLog\Logger\Concerns\PrecautionMessages;

/**
 * Class Logger
 * User: Terry Lucas
 * @package TerryLucasInterFaceLog\Logger
 */
class Logger implements ILogger
{
    use PrecautionMessages;

    /**
     * User: Terry Lucas
     * @param $method
     * @param array $options
     * @throws \Exception
     */
    public function write($method, array $options = [])
    {
        try {

        } catch (\Exception $e) {
            throw  $e;
        }
    }

}