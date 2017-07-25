<?php
/**
 * Created by PhpStorm.
 * User: Terry Lucas
 * Date: 2017/7/24
 * Time: 14:58
 */

namespace TerryLucasInterFaceLog\Logger;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use TerryLucasInterFaceLog\Logger\Concerns\PrecautionTools;

/**
 * Class Precaution
 * User: Terry Lucas
 * @package TerryLucasInterFaceLog\Logger
 */
class Precaution
{
    use  PrecautionTools;

    protected $ilogger;

    /**
     * @author: Terry Lucas
     * Precaution constructor.
     * @param ILogger $logger
     */
    public function __construct(ILogger $logger)
    {
        $this->ilogger = $logger;
    }

    public function preLogInfo($date)
    {
        try {
            //进行需要更新的数据进行预处理
            $datas = $this->precautionContainer();

            //日志存储服务器地址
            // $hosts = $this->getHosts();
            // foreach ($hosts as $host) {
            $filePath = $this->getFilePath($date);
            if (!file_exists($filePath)) {
                return '';
            }

            $content = file_get_contents($filePath);
            preg_match_all('|\[[\d-]+\s([\d:]+)\]\s[^:]*:\s([a-zA-Z1-9-_]+)|', $content, $matches);
            if (!$matches[1] || !isset($matches[2])) {
                return '';
            }
            foreach ($matches[2] as $k => $v) {
                if (!isset($datas[$v])) {
                    continue;
                }
                $ind = Carbon::parse($matches[1][$k])->hour * 60 + Carbon::parse($matches[1][$k])->minute;
                $datas[$v][$ind] += 1;
            }
            // }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        Log::info(json_encode($datas));
    }
}