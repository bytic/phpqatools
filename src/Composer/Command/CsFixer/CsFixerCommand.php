<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\CsFixer;

use Bytic\Phpqa\Composer\Command\Fix\HasFixOption;
use Bytic\Phpqa\Composer\Command\ProcessCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class CsFixerCommand extends ProcessCommand
{
    use HasFixOption;

    public function getBaseName(): string
    {
        return 'cs-fixer';
    }

    public function getProcessCommand(InputInterface $input, OutputInterface $output): array
    {
        $args = ['fix'];

        if (false === $this->inputHasFixOption($input)) {
            $args[] = '-v --dry-run --using-cache no --diff';
        }

        return array_merge(
            [
                $this->withBinPath('php-cs-fixer'),
            ],
            $args,
        );
    }

    protected function configure()
    {
        parent::configure();
        $this->setAliasesWithPrefix([
            'fix:' . $this->getBaseName(),
            'ci:' . $this->getBaseName()
        ]);
    }
}
