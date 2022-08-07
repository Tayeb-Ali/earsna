<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Admin\BusinessField
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\Admin\BusinessFieldFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessField query()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessField whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BusinessField extends Model
{
    use HasFactory;

    protected $guarded = [];
}
