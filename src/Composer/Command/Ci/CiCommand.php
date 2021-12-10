<?php
declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\Ci;

use Bytic\Phpqa\Composer\Command\NamespaceCommand;

/**
 *
 */
class CiCommand extends NamespaceCommand
{
    public function getBaseName(): string
    {
        return 'ci';
    }
}