<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Illuminate\Support\Carbon;


/**
 * App\Models\Admin\Tenant
 *
 * @property int $id
 * @property string domain
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Tenant newModelQuery()
 * @method static Builder|Tenant newQuery()
 * @method static Builder|Tenant query()
 * @method static Builder|Tenant whereCreatedAt($value)
 * @method static Builder|Tenant whereId($value)
 * @method static Builder|Tenant whereName($value)
 * @method static Builder|Tenant wherePrice($value)
 * @method static Builder|Tenant whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;
}