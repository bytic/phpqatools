<?php

declare(strict_types=1);

namespace Bytic\Phpqa\Composer;

use Bytic\Phpqa\Composer\Command\Analyze\AnalyzeCommand;
use Bytic\Phpqa\Composer\Command\Ci\CiCommand;
use Bytic\Phpqa\Composer\Command\Fix\FixCommand;
use Bytic\Phpqa\Composer\Command\Test\TestCommand;
use Composer\Command\BaseCommand;
use Composer\Composer;
use Composer\Factory;
use Composer\IO\IOInterface;
use Composer\Plugin\Capability\CommandProvider;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;

use function dirname;
use function realpath;

/**
 * Provides a variety of Composer commands and events useful for PHP
 * library and application development
 */
class DevToolsPlugin implements
    Capable,
    CommandProvider,
    PluginInterface
{

    public static string $prefix = 'bytic';

    private static Composer $composer;
    private static IOInterface $io;

    private string $repoRoot;

    public function __construct()
    {
        $composerFile = Factory::getComposerFile();

        $this->repoRoot = (string) realpath(dirname($composerFile));
    }

    /**
     * @return array<string, string>
     */
    public function getCapabilities(): array
    {
        return [
            CommandProvider::class => self::class,
        ];
    }

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

    public function activate(Composer $composer, IOInterface $io): void
    {
        self::$composer = $composer;
        self::$io = $io;
    }

    public function deactivate(Composer $composer, IOInterface $io): void
    {
    }

    public function uninstall(Composer $composer, IOInterface $io): void
    {
    }

    /**
     * Use extra.command-prefix, if available, but extra.ramsey/devtools.command-prefix
     * takes precedence over extra.command-prefix.
     */
    private function getCommandPrefix(): string
    {
        $extra = self::$composer->getPackage()->getExtra();

        return $extra['bytic/devtools']['command-prefix'] ?? $extra['command-prefix'] ?? '';
    }
}