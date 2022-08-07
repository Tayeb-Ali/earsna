<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\Admin\FeaturePackage
 *
 * @property int $id
 * @property int $feature_id
 * @property int $package_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturePackage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturePackage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturePackage query()
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturePackage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturePackage whereFeatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturePackage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturePackage wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FeaturePackage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FeaturePackage extends Pivot
{
    public $incrementing = true;
}
