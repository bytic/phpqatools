<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
abstract class NamespaceCommand extends BaseCommand
{

    /**
     * @inheritdoc
     */
    protected function doExecute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Executing ' . $this->getName());

        $exitCode = 0;

        $childCommands = $this->getChildCommands();
        foreach ($childCommands as $command) {
            $output->writeln(['', sprintf('<comment>Executing %s</comment>', (string)$command->getName())]);
            $exitCode += $command->run($input, $output);
        }
        return $exitCode;
    }

    protected function getChildCommands(): array
    {
        return $this->getApplication()->all($this->getName());
    }
}
