<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 *
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $path
 * @property string $mimo_type
 * @property string $title
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereMimoType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    use HasFactory;

    protected $table = 'files';
    protected $guarded = false;

    public static function putAndCreate($dataFile){

        $filePath = Storage::disk('public')->put('files', $dataFile);

         return File::create([
            'path' => $filePath,
            'mimo_type' => $dataFile->getClientOriginalExtension(),
            'title' => $dataFile->getClientOriginalName(),
        ]);

    }
}
