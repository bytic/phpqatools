<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer;

use Bytic\Phpqa\Tools\PhpStan\Composer\PhpStanCommand;
use Bytic\Phpqa\Tools\Psalm\Composer\PsalmCommand;
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

            new PsalmCommand(),
            new PhpStanCommand(),

            new Command\CsFixer\CsFixerCommand(),
        ];
    }

}