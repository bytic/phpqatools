<?php
declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\Fix;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 *
 */
trait HasFixOption
{

    protected function configure()
    {
        parent::configure();
        $this->addOptionFix();
    }

    protected function inputHasFixOption(InputInterface $input): bool
    {
        return $input->hasOption(FixCommand::FIX_ARGUMENT);
    }

    protected function addOptionFix()
    {
        $this->addOption(
            FixCommand::FIX_ARGUMENT,
            null,
            InputOption::VALUE_OPTIONAL
        );
    }
}