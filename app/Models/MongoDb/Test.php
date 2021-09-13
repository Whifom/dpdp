<?php

namespace App\Models\MongoDb;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Test extends Eloquent
{
    /**
     * @var string
     */
    protected $primaryKey = '_id';

    /**
     * @var string
     */
    protected $connection = 'mongodb';

    /**
     * @var string
     */
    protected $collection = 'test';

    /**
     * @var array
     */
    public $guarded = [];
}
