<?php

namespace Saad\AiBridge;

use Symfony\Component\Process\Process;

class AiService
{
    protected string $pythonBinary;
    protected string $scriptPath;

    public function __construct(?string $pythonBinary = null, ?string $scriptPath = null)
    {
        $this->pythonBinary = $pythonBinary ?? 'python3';
        $this->scriptPath   = $scriptPath ?? __DIR__ . '/../python/similarity.py';
    }

    public function similarity(string $text1, string $text2): float
    {
        $process = new Process([$this->pythonBinary, $this->scriptPath, $text1, $text2]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        return (float) trim($process->getOutput());
    }
}
