<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Infrastructure\Core\Kernel;

echo PHP_EOL . ">>>>>>>>>> Result <<<<<<<<<<" . PHP_EOL;

// Bindings
(new Kernel())->run($argv);
