<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

/**
 *
 */
abstract class ProcessCommand extends BaseCommand
{
    /**
     * @return string[]
     */
    abstract public function getProcessCommand(InputInterface $input, OutputInterface $output): array;

    protected function getProcessCallback(OutputInterface $output): callable
    {
        return function (string $_type, string $buffer) use ($output): void {
            $output->write($buffer);
        };
    }

    protected function doExecute(InputInterface $input, OutputInterface $output): int
    {
        $composer = $this->getComposer();
        $command = $this->getProcessCommand($input, $output);

        $cwd = dirname($composer->getConfig()->get('bin-dir'), 2);
        $output->writeln([
            sprintf(
                '<comment>Executing </comment><info>%s</info>'
                . '<comment> in </comment><info>[%s]</info>',
                implode(' ', $command),
                $cwd
            ),
        ]);
        if (false === $this->doExecuteCheck()) {
            $output->writeln([
                '<comment>Tool not detected. Skipping</comment>'
            ]);
            return 0;
        }
        return $this->doExecuteProcess($command, $cwd, $output);
    }

    protected function doExecuteCheck(): bool
    {
        return true;
    }

    protected function doExecuteProcess(array $command, string $cwd, OutputInterface $output): int
    {
        $process = new Process($command, $cwd);
        $process->start();

        return $process->wait($this->getProcessCallback($output));
    }
}
