<?php
declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command;

/**
 *
 */
abstract class NamespaceCommand extends BaseCommand
{
    public const COMMAND_NAMESPACE = null;

    public function __construct(string $name = null)
    {
        parent::__construct($name);

        if (static::COMMAND_NAMESPACE === null) {
            throw new \RuntimeException('COMMAND_NAMESPACE must be defined');
        }
    }
}
