<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command;

use ReflectionException;
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

    /**
     * @throws ReflectionException
     */
    protected function doExecute(InputInterface $input, OutputInterface $output): int
    {
        $composer = $this->getComposer();
        $command = $this->getProcessCommand($input, $output);

        $command_line = array_shift($command) . ' ';
        $command_line .= implode(' ', $command);

        $cwd = dirname($composer->getConfig()->get('bin-dir'), 2);
        $output->writeln([
            sprintf(
                '<comment>Executing </comment><info>%s</info>'
                . '<comment> in </comment><info>[%s]</info>',
                $command_line,
                $cwd
            ),
        ]);

        return $this->doExecuteProcess($command_line, $cwd, $output);
    }

    protected function doExecuteProcess($command_line, $cwd, $output): int
    {
        if (method_exists('Symfony\Component\Process\Process', 'fromShellCommandline')) {
            $process = Process::fromShellCommandline($command_line, $cwd);
        } else {
            $process = new Process($command_line, $cwd);
        }

        $process->start();

        return $process->wait($this->getProcessCallback($output));
    }
}
