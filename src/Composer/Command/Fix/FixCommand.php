<?php
declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\Fix;

use Bytic\Phpqa\Composer\Command\NamespaceCommand;

/**
 *
 */
class FixCommand extends NamespaceCommand
{
    public function getBaseName(): string
    {
        return 'fix';
    }
}