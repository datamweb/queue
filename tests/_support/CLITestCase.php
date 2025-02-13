<?php

declare(strict_types=1);

namespace Tests\Support;

use CodeIgniter\CLI\CLI;
use CodeIgniter\I18n\Time;
use CodeIgniter\Test\ReflectionHelper;
use Exception;

abstract class CLITestCase extends TestCase
{
    use ReflectionHelper;

    private array $lines = [];

    /**
     * @throws Exception
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        // Reset the current time.
        Time::setTestNow();
    }

    protected function parseOutput(string $output): string
    {
        $this->lines = [];
        $output      = $this->removeColorCodes($output);
        $this->lines = explode("\n", $output);

        return $output;
    }

    protected function getLine(int $line = 0): ?string
    {
        return $this->lines[$line] ?? null;
    }

    protected function getLines(): string
    {
        return implode('', $this->lines);
    }

    protected function removeColorCodes(string $output): string
    {
        $colors = $this->getPrivateProperty(CLI::class, 'foreground_colors');
        $colors = array_values(array_map(static fn ($color) => "\033[" . $color . 'm', $colors));
        $colors = array_merge(["\033[0m"], $colors);

        $output = str_replace($colors, '', trim($output));

        if (is_windows()) {
            $output = str_replace("\r\n", "\n", $output);
        }

        return $output;
    }
}
