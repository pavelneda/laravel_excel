<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $key
 * @property string $message
 * @property int $task_id
 * @method static \Illuminate\Database\Eloquent\Builder|FailedRow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FailedRow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FailedRow query()
 * @method static \Illuminate\Database\Eloquent\Builder|FailedRow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedRow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedRow whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedRow whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedRow whereTaskId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FailedRow whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FailedRow extends Model
{
    use HasFactory;

    protected $table = 'failed_rows';
    protected $guarded = false;

    public static function insertRows($items)
    {
        foreach ($items as $item) {
            self::create($item);
        }
    }
}
