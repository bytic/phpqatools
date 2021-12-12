<?php
declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\Test;

use Bytic\Phpqa\Composer\Command\NamespaceCommand;

/**
 *
 */
class TestCommand extends NamespaceCommand
{
    public const NAMESPACE_NAME = self::TEST;
}