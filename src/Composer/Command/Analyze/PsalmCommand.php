<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer\Command\Analyze;

use Bytic\Phpqa\Composer\Command\NamespaceCommand;
use Bytic\Phpqa\Composer\Command\NamespaceCommands\IsNamespaceChildCommand;
use Bytic\Phpqa\Composer\Command\ProcessCommand;
use Bytic\Phpqa\Tools\Psalm\PsalmDetector;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class PsalmCommand extends ProcessCommand
{
    use IsNamespaceChildCommand;

    public function getBaseName(): string
    {
        return 'psalm';
    }

    public function getProcessCommand(InputInterface $input, OutputInterface $output): array
    {
        /** @var string[] $args */
        $args = $input->getArguments()['args'] ?? [];

        if ($input->getOption('psalm-help')) {
            // Ignore all other arguments and display PHPStan help.
            $args = ['--help'];
        }

        return array_merge(
            [
                $this->withBinPath('psalm'),
            ],
            $args,
        );
    }

    protected function configure()
    {
        parent::configure();
        $this->configureNamespaceCommandOption();
        $this->setAliasesWithNamespacePrefix([NamespaceCommand::CI, NamespaceCommand::ANALYZE]);
        $this
            ->setDescription('Runs the Psalm static analyzer.')
            ->addUsage('--psalm-help')
            ->addUsage('-- [<psalm-options>...]')
            ->setHelp($this->getHelpText())
            ->setDefinition([
                new InputArgument('args', InputArgument::IS_ARRAY | InputArgument::OPTIONAL, ''),
                new InputOption('psalm-help', null, InputOption::VALUE_NONE, 'Display Psalm help'),
            ]);
    }

    private function getHelpText(): string
    {
        return <<<'EOD'
            The <info>%command.name%</info> command executes Psalm, using any
            local configuration files (e.g., psalm.xml) available.
            To get started with Psalm, first generate a config file:
              <info>%command.full_name% -- --init</info>
            Then, run Psalm:
              <info>%command.full_name%</info>
            For more information on Psalm, see https://psalm.dev
            You may also pass additional arguments to Psalm. To do so, use a
            double-dash (<info>--</info>) to indicate all following arguments and options
            should be passed along directly to Psalm.
            For example:
              <info>%command.full_name% -- --update-baseline</info>
            To view Psalm help, use the <info>--psalm-help</info> option.
            <comment>Please Note:</comment> Composer captures some options early and, therefore,
            cannot easily pass them along to Psalm. These include standard
            options such as <info>--help</info>, <info>--version</info>, and <info>--quiet</info>. To use these options,
            invoke Psalm directly via <info>./vendor/bin/psalm</info>.
            EOD;
    }

    protected function doExecuteCheck(): bool
    {
        if (false == PsalmDetector::detectFromComposer($this->getComposer())) {
            return false;
        }
        return parent::doExecuteCheck();
    }
}
