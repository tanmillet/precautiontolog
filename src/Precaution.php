<?php

namespace TerryLucasInterFaceLog\Logger;

use Carbon\Carbon;
use Illuminate\Log\Writer;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;
use TerryLucasInterFaceLog\Logger\Concerns\LucasAnalysisTrait;
use TerryLucasInterFaceLog\Logger\Concerns\PrecautionTools;

/**
 * Class Precaution
 * User: Terry Lucas
 * @package TerryLucasInterFaceLog\Logger
 */
class Precaution
{
    use  PrecautionTools, LucasAnalysisTrait;

    /**
     * User: Terry Lucas
     * @var Writer
     */
    protected $ilogger;

    /**
     * @author: Terry Lucas
     * Precaution constructor.
     * @param ILogger $logger
     */
    public function __construct()
    {
        $this->ilogger = new Writer(new Logger(''));
    }

    /**
     * User: Terry Lucas
     * @param $date
     * @return string
     */
    public function pre($date)
    {
        try {
            //Preprocess the data that needs to be updated
            $datas = $this->precautionContainer();

            //Log the server path
            $filePath = $this->getFilePath($date);
            if (!file_exists($filePath)) {
                return 'Parsing log files does not exist.';
            }

            $content = file_get_contents($filePath);
            preg_match_all('|\[[\d-]+\s([\d:]+)\]\s[^:]*:\s([a-zA-Z1-9-_]+)|', $content, $matches);
            if (!$matches[1] || !isset($matches[2])) {
                return 'Parse log file failed.';
            }

            foreach ($matches[2] as $k => $v) {
                if (!isset($datas[$v])) {
                    continue;
                }

                $ind = Carbon::parse($matches[1][$k])->hour * 60 + Carbon::parse($matches[1][$k])->minute;
                $datas[$v][$ind] += 1;
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $msg = (!empty($datas)) ? $this->recored($datas, $date) : 'Parsing logs have no data.';

        return (empty($msg)) ? 'Resolve log file success.' : $msg;
    }

    /**
     * User: Terry Lucas
     * @param $interfacetag uniqueid
     * @param array $options
     * @return mixed
     */
    public function precordlog($interfacetag, array $options = [])
    {
        try {
            $dirpath = storage_path() . '/logs/' . date('Y-m-d', time());
            $this->ilogger->useDailyFiles($dirpath . '/laravel-analysis-info.log', 30);
            $this->ilogger->write('info', $interfacetag . ' ' . json_encode($options));

        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }


    /**
     * User: Terry Lucas
     * @return string
     */
    public function preport()
    {
        try {
            //
            $mimx = $this->getDateRangeValue();
            if (!isset($mimx[0]) || !isset($mimx[1])) throw new \Exception('The rules of the Settings is not reasonable');

            //
            $precautiontags = $this->getPrecautionTags();
            $temps = [];
            foreach ($precautiontags as $precautiontag) {
                $analysisDatas = $this->getAnalysisDatas($mimx, $precautiontag['uniqueid']);
                if(empty($analysisDatas)) continue;

                //
                $collection = collect($analysisDatas->toArray());
                $filtered = $collection->pluck(['datainfo']);
                $analysisDatas = $filtered->all();
                if(empty($analysisDatas)) continue;

                //
                $day = $this->getPreDateRange();
                $avgs = $this->splitArr($this->daySplit());
                foreach ($analysisDatas as $analysisData) {
                    $andata = explode(',' , trim(trim($analysisData , ']') , '['));
                    foreach ($andata as $key=>$item) {
                        $avgs[$key] += $item;
                    }
                }

                //
                foreach ($avgs as &$s){
                    $s = (int)ceil($s / $day);
                }

                $temps[$precautiontag['uniqueid']] = $avgs;
            }

            //data update to db
            $msg = (!empty($temps)) ? $this->recordavg($temps) : 'Early warning analysis reports have no data.';

            return (empty($msg)) ? 'Early warning analysis reports generate success.' : $msg;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}