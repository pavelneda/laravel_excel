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
 * @property int $user_id
 * @property int|null $file_id
 * @property int $status
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUserId($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $guarded = false;


    const STATUS_PROCESS = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_ERROR = 3;


    public static function getStatuses()
    {
        return [
            self::STATUS_PROCESS => 'In process',
            self::STATUS_SUCCESS => 'Success',
            self::STATUS_ERROR => 'Error',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function file()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

    public function failedRows()
    {
        return $this->hasMany(FailedRow::class, 'task_id', 'id');
    }
}
