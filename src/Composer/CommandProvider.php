<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer;

use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;
use Bytic\Phpqa\Composer\Command\Analyze\AnalyzeCommand;
use Bytic\Phpqa\Composer\Command\Ci\CiCommand;
use Bytic\Phpqa\Composer\Command\Fix\FixCommand;
use Bytic\Phpqa\Composer\Command\Test\TestCommand;
use Composer\Command\BaseCommand;

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
            new AnalyzeCommand(),
            new CiCommand(),
            new FixCommand(),
            new TestCommand(),
        ];
    }

}