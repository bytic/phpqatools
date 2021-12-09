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
    public const COMMAND_NAMESPACE = null;

    public function __construct(string $name = null)
    {
        parent::__construct($name);

        if (static::COMMAND_NAMESPACE === null) {
            throw new \RuntimeException('COMMAND_NAMESPACE must be defined');
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Executing ' . $this->getName());
    }

}
