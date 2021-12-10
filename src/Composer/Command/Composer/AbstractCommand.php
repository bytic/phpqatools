<?php
declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\Composer;

use Bytic\Phpqa\Composer\Command\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
abstract class AbstractCommand extends BaseCommand
{
    protected function doExecute(InputInterface $input, OutputInterface $output): int
    {
        $command = $this->getApplication()->find($this->composerCommand());
        return $command->run($input, $output);
    }

    abstract protected function composerCommand(): string;
}