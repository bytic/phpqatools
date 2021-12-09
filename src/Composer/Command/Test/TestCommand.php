<?php
declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\Test;

use Bytic\Phpqa\Composer\Command\NamespaceCommand;

/**
 *
 */
class TestCommand extends NamespaceCommand
{
    public function getBaseName(): string
    {
        return 'test';
    }
}