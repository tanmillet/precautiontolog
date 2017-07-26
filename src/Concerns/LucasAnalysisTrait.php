<?php

namespace TerryLucasInterFaceLog\Logger\Concerns;

use Illuminate\Support\Facades\DB;
use TerryLucasInterFaceLog\Logger\LucasAnalysis;

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
}