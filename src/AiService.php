<?php

namespace Saad\AiBridge;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class AiService
{
    protected string $pythonBinary;
    protected string $scriptPath;

    public function __construct(string $pythonBinary = null, string $scriptPath = null)
    {
        $this->pythonBinary = $pythonBinary
            ?? config('ai-bridge.python_binary')
            ?? $this->detectPythonBinary();

        $this->scriptPath = $scriptPath ?? realpath(__DIR__ . '/../python/similarity.py');
        if (!$this->scriptPath) {
            throw new \RuntimeException("Python script not found at expected path.");
        }
    }

    public function similarity(string $text1, string $text2): float
    {
        // هنشغل الـ Python script
        $process = new Process([$this->pythonBinary, $this->scriptPath]);

        // نجهز البيانات ونبعتها في stdin
        $payload = json_encode(['text1' => $text1, 'text2' => $text2], JSON_UNESCAPED_UNICODE);

        $process->setInput($payload);
        $process->setTimeout(60);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output = trim($process->getOutput());

        // متوقع يرجع JSON
        $data = json_decode($output, true);

        if (json_last_error() === JSON_ERROR_NONE && isset($data['similarity'])) {
            return (float)$data['similarity'];
        }

        throw new \RuntimeException("Invalid response from Python script: " . $output);
    }

    protected function detectPythonBinary(): string
    {
        foreach (['py', 'python', 'python3'] as $cmd) {
            try {
                $p = new Process([$cmd, '--version']);
                $p->run();
                if ($p->isSuccessful()) {
                    return $cmd;
                }
            } catch (\Throwable $e) {
                // ignore and try next
            }
        }
        throw new \RuntimeException("No python executable found. Set a python path in AiService constructor or config.");
    }
}
