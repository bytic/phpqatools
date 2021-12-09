<?php
declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\Analyze;

use Bytic\Phpqa\Composer\Command\NamespaceCommand;

/**
 *
 */
class AnalyzeCommand extends NamespaceCommand
{
    public function getBaseName(): string
    {
        return 'analyze:all';
    }

    /**
     * Supports the use of `composer analyze`, without the command prefix/namespace
     *
     * @return string[]
     */
    public function getAliases(): array
    {
        return ['analyze'];
    }
}