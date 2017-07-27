<?php

namespace TerryLucasInterFaceLog\Logger\Concerns;

use Illuminate\Support\Facades\DB;
use TerryLucasInterFaceLog\Logger\LucasAnalysis;
use TerryLucasInterFaceLog\Logger\LucasAnalysisRes;

/**
 * Class PrecautionMessages
 * User: Terry Lucas
 */
trait LucasAnalysisTrait
{
    /**
     * User: Terry Lucas
     * @param $datas
     * @param $date
     * @param $granularity
     * @return string
     */
    public function recored($datas, $date)
    {
        try {
            DB::beginTransaction();

            foreach ($datas as $key => $data) {
                LucasAnalysis::query()->updateOrCreate([
                    'recordate' => $date,
                    'precautiontags' => $key,
                ], [
                    'recordate' => $date,
                    'precautiontags' => $key,
                    'datainfo' => json_encode($data),
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return 'Error logging analysis result.';
        }

        return '';
    }

    /**
     * User: Terry Lucas
     * @param $date
     * @param $granularity
     * @param $precautiontags
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAnalysisDatas($date, $precautiontags)
    {
        return LucasAnalysis::query()->where('recordate', '>=', $date[0])
            ->where('recordate', '<=', $date[1])
            ->where('precautiontags', '=', $precautiontags)
            ->get();
    }

    /**
     * User: Terry Lucas
     * @param $datas
     * @return string
     */
    public function recordavg($datas)
    {
        try {
            DB::beginTransaction();

            foreach ($datas as $key => $data) {
                LucasAnalysisRes::query()->updateOrCreate([
                    'precautiontags' => $key,
                ], [
                    'precautiontags' => $key,
                    'preinfo' => json_encode($data),
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return 'Error LucasAnalysisRes update.';
        }

        return '';
    }

    /**
     * User: Terry Lucas
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPreInfo()
    {
        return LucasAnalysisRes::all();
    }

    /**
     * User: Terry Lucas
     * @param $precautiontags
     * @return \Illuminate\Support\Collection
     */
    public function getAnalysisLogInfo($precautiontags)
    {
        return LucasAnalysis::query()
            ->where('precautiontags', '=', $precautiontags)
            ->where('recordate', '=', date('Y-m-d'))
            ->pluck('datainfo');
    }
}