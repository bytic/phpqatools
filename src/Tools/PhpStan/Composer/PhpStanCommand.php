<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Tools\PhpStan\Composer;

use Bytic\Phpqa\Composer\Command\NamespaceCommand;
use Bytic\Phpqa\Composer\Command\NamespaceCommands\IsNamespaceChildCommand;
use Bytic\Phpqa\Composer\Command\ProcessCommand;
use Bytic\Phpqa\Tools\PhpStan\PhpStanDetector;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class PhpStanCommand extends ProcessCommand
{
    public const NAME_BASE = 'phpstan';

    use IsNamespaceChildCommand;

    public function getBaseName(): string
    {
        return self::NAME_BASE;
    }

    public function getProcessCommand(InputInterface $input, OutputInterface $output): array
    {
        /** @var string[] $args */
        $args = $input->getArguments()['args'] ?? [];

        if ($input->getOption('phpstan-help')) {
            // Ignore all other arguments and display PHPStan help.
            $args = ['--help'];
        }

        return array_merge(
            [
                $this->withBinPath('phpstan'),
                'analyse',
                '--ansi',
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
            ->setDescription('Runs the PHPStan static analyzer.')
            ->addUsage('--phpstan-help')
            ->addUsage('-- [<phpstan-options>...]')
            ->setHelp($this->getHelpText())
            ->setDefinition([
                new InputArgument('args', InputArgument::IS_ARRAY | InputArgument::OPTIONAL, ''),
                new InputOption('phpstan-help', null, InputOption::VALUE_NONE, 'Display PHPStan help'),
            ]);
    }

    private function getHelpText(): string
    {
        return <<<'EOD'
              The <info>%command.name%</info> command executes PHPStan, using any
            local configuration files (e.g., phpstan.neon) available.
            If you don't have a configuration file yet, you can get started with:
              <info>%command.full_name% -- src tests</info>
            For more information on PHPStan, see https://phpstan.org
            You may also pass additional arguments to PHPStan. To do so, use a
            double-dash (<info>--</info>) to indicate all following arguments and options
            should be passed along directly to PHPStan.
            For example:
              <info>%command.full_name% -- --error-format=json</info>
            To view PHPStan help, use the <info>--phpstan-help</info> option.
            <comment>Please Note:</comment> Composer captures some options early and, therefore,
            cannot easily pass them along to PHPStan. These include standard
            options such as <info>--help</info>, <info>--version</info>, and <info>--quiet</info>. To use these options,
            invoke PHPStan directly via <info>./vendor/bin/phpstan</info>.
            EOD;
    }

    protected function doExecuteCheck(): bool
    {
        if (false == PhpStanDetector::detectFromComposer($this->getComposer())) {
            return false;
        }
        return parent::doExecuteCheck();
    }
}
