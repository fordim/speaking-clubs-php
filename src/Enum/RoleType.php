<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * @method static self admin()
 * @method static self user()
 * @method static self teacher()
 */
final class RoleType extends Enum
{
    private const admin = 'admin';
    private const user = 'user';
    private const teacher = 'teacher';
}
