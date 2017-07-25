<?php

namespace TerryLucasInterFaceLog\Logger\Concerns;

use Illuminate\Support\Facades\Config;

/**
 * Class PrecautionMessages
 * User: Terry Lucas
 */
trait PrecautionTools
{
    /**
     * User: Terry Lucas
     * @return mixed
     * @throws \Exception
     */
    public function precautionContainer()
    {
        //获取系统的预警粒度
        $granularity = (int)Config::get('precaution.granularity');
        if (!is_numeric($granularity)) throw new \Exception('The granularity of the Settings is not reasonable');
        $cont = $this->daySplit($granularity);

        $items = [];
        for ($i = 0; $i < $cont; $i++) {
            $items[] = 0;
        }

        //进行预警或者监控的接口
        $datas = [];
        $precautiontags = Config::get('precaution.precautiontags');
        if (!isset($precautiontags) || !is_array($precautiontags)) throw new \Exception('The precaution tags of the Settings is not reasonable');
        foreach ($precautiontags as $precautiontag) {
            if (!isset($precautiontag['uniqueid']) || empty($precautiontag['uniqueid'])) {
                continue;
            }
            $datas[$precautiontag['uniqueid']] = $items;
        }

        return $datas;
    }

    /**
     * User: Terry Lucas
     * @return mixed
     * @throws \Exception
     */
    public function getHosts()
    {
        $precautions = Config::get('precaution.hosts');
        if (!isset($precautions) || !is_array($precautions)) throw  new \Exception('The log server is not configured');

        return $precautions;
    }

    /**
     * User: Terry Lucas
     * @param $serverUniqueId
     * @param $date
     * @return string
     */
    public function getFilePath($date)
    {
        $storage = Config::get('precaution.storage');

        return storage_path($storage . "/laravel-analysis-info-" . $date . ".log");
    }

    /**
     * User: Terry Lucas
     * @param int $granularity
     * @return float
     */
    public function daySplit($granularity = 1)
    {
        return ceil(1440 / $granularity);
    }
}