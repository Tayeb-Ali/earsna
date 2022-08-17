<?php

namespace App\Models\Admin;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Admin\Feature
 *
 * @property int $id
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Feature newModelQuery()
 * @method static Builder|Feature newQuery()
 * @method static Builder|Feature query()
 * @method static Builder|Feature whereCreatedAt($value)
 * @method static Builder|Feature whereDescription($value)
 * @method static Builder|Feature whereId($value)
 * @method static Builder|Feature whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Feature extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function package(): BelongsToMany
    {
        return $this->belongsToMany(Package::class, 'feature_package', 'package_id', 'feature_id');
    }


}
