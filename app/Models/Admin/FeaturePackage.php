<?php

namespace App\Models\Admin;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;

/**
 * App\Models\Admin\FeaturePackage
 *
 * @property int $id
 * @property int $feature_id
 * @property int $package_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|FeaturePackage newModelQuery()
 * @method static Builder|FeaturePackage newQuery()
 * @method static Builder|FeaturePackage query()
 * @method static Builder|FeaturePackage whereCreatedAt($value)
 * @method static Builder|FeaturePackage whereFeatureId($value)
 * @method static Builder|FeaturePackage whereId($value)
 * @method static Builder|FeaturePackage wherePackageId($value)
 * @method static Builder|FeaturePackage whereUpdatedAt($value)
 * @mixin Eloquent
 */
class FeaturePackage extends Pivot
{
    public $incrementing = true;
    protected $table = 'feature_package';
}
