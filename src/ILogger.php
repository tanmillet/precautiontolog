<?php
/**
 * Created by PhpStorm.
 * User: Terry Lucas
 * Date: 2017/7/25
 * Time: 11:33
 */

namespace TerryLucasInterFaceLog\Logger;


interface ILogger
{
        public function write($method , array $options = []);
}