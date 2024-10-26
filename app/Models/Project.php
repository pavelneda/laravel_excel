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
 * @property int $type_id
 * @property string $title
 * @property string $date_of_create
 * @property string $contracted_at
 * @property string|null $deadline
 * @property int|null $is_chain
 * @property int|null $is_on_time
 * @property int|null $has_outsource
 * @property int|null $has_investors
 * @property int|null $worker_count
 * @property int|null $service_count
 * @property int|null $payment_first_step
 * @property int|null $payment_second_step
 * @property int|null $payment_third_step
 * @property int|null $payment_fourth_step
 * @property string|null $comment
 * @property string|null $effectively
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereContractedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDateOfCreate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereEffectively($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereHasInvestors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereHasOutsource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereIsChain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereIsOnTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project wherePaymentFirstStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project wherePaymentFourthStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project wherePaymentSecondStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project wherePaymentThirdStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereServiceCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereWorkerCount($value)
 * @mixin \Eloquent
 */
class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $guarded = false;
    protected $casts = [
        'date_of_create' => 'datetime',
        'contracted_at' => 'datetime',
        'deadline' => 'datetime',
    ];


    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
