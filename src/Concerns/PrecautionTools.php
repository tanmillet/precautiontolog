<?php

namespace TerryLucasInterFaceLog\Logger\Concerns;

use Carbon\Carbon;
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
        $items = $this->splitArr();

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
     * @param $granularity
     * @return array
     */
    public function splitArr()
    {
        $cont = $this->daySplit(1);
        $items = [];
        for ($i = 0; $i < $cont; $i++) {
            $items[] = 0;
        }

        return $items;
    }

    /**
     * User: Terry Lucas
     * @return mixed
     * @throws \Exception
     */
    public function getPrecautionTags()
    {
        $precautiontags = Config::get('precaution.precautiontags');
        if (!isset($precautiontags) || !is_array($precautiontags)) throw  new \Exception('The precautiontags is not configured');

        return $precautiontags;
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
     * @return mixed
     * @throws \Exception
     */
    public function getDateRangeValue()
    {
        $day = $this->getPreDateRange();
        $start = Carbon::parse()->subDays($day)->format('Y-m-d');
        $end = Carbon::parse()->subDay()->format('Y-m-d');

        return $dayMinMax = [$start, $end];
    }

    /**
     * User: Terry Lucas
     * @return mixed
     * @throws \Exception
     */
    public function getPreDateRange()
    {
        $setRules = Config::get('precaution.setrules');
        $rules = Config::get('precaution.rules');

        if (!isset($setRules) || !isset($rules[$setRules])) throw  new \Exception('Configuration rule error.');
        if (!isset($rules[$setRules]['avg']) || !is_numeric($rules[$setRules]['avg'])) throw  new \Exception('Configuration rule error,[avg] key is not set or set the error');

        return $rules[$setRules]['avg'];
    }

    /**
     * User: Terry Lucas
     * @return mixed
     * @throws \Exception
     */
    public function getPreRules()
    {
        $setRules = Config::get('precaution.setrules');
        $rules = Config::get('precaution.rules');

        if (!isset($setRules) || !isset($rules[$setRules])) throw  new \Exception('Configuration rule error.');

        return $rules[$setRules];
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

        return storage_path($storage . '/' . $date . "/laravel-analysis-info-" . $date . ".log");
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