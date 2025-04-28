<?php

declare(strict_types=1);

namespace App\UseCase\ExecuteCode;

use App\Domain\DTO\CodeVO;
use App\Domain\Service\LexicalAnalyserService;
use App\Domain\Service\Parser;
use App\Infrastructure\Core\Context;
use App\Infrastructure\Core\Interpreter;

final readonly class ExecuteCodeUseCase
{
    public function __construct(
        private LexicalAnalyserService $lexicalAnalyserService,
        private Parser $parser,
        private Interpreter $interpreter,
    ) {
    }

    public function __invoke(ExecuteCodeinput $input): mixed // ExecuteCodeOutput
    {

        $tokens = $this->lexicalAnalyserService->tokenize($input->code);

        $ast = $this->parser->parse($tokens);

        $codeVo = new CodeVO($ast, $input->args);

        $result = $this->interpreter->run($ast, $codeVo->args);
        print_r($result);

        return $result;
    }


}