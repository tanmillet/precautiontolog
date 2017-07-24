<?php
/**
 * Created by PhpStorm.
 * User: Terry Lucas
 * Date: 2017/7/20
 * Time: 16:43
 */

namespace TerryLucasInterFaceLog\Logger;

use Illuminate\Support\Facades\Log;

/**
 * Created by PhpStorm.
 * User: Terry Lucas
 * Date: 2017/7/21
 * Time: 10:20
 */
class MyLogs
{
    public function writeToFile(array $options = [])
    {
        $contents = isset($options) && !empty($options) ? json_encode($options, JSON_UNESCAPED_UNICODE) : 'Without any content!';

        Log::info($contents);
    }
}