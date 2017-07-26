<?php

namespace TerryLucasInterFaceLog\Logger;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LucasAnalysis
 * User: Terry Lucas
 * @package TerryLucasInterFaceLog\Logger
 */
class LucasAnalysis extends Model
{
    /**
     * User: Terry Lucas
     *
     * @var string
     */
    protected $table = 'lucas_analysis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'precautiontags', 'recordate','datainfo'
    ];

}
