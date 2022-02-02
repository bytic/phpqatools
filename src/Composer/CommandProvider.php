<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer;

use Composer\Command\BaseCommand;
use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;

/**
 *
 */
class CommandProvider implements CommandProviderCapability
{
    /**
     * @return BaseCommand[]
     */
    public function getCommands(): array
    {
        return [
            new Command\Analyze\AnalyzeCommand(),
            new Command\Ci\CiCommand(),
            new Command\Fix\FixCommand(),
            new Command\Test\TestCommand(),

            new Command\Composer\ValidateCommand(),
            new Command\Composer\NormalizeCommand(),

            new Command\Analyze\PsalmCommand(),

            new Command\CsFixer\CsFixerCommand(),
        ];
    }

}