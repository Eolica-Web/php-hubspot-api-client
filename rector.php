<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector;
use Rector\Config\RectorConfig;
use Rector\Php83\Rector\ClassMethod\AddOverrideAttributeToOverriddenMethodsRector;

return RectorConfig::configure()
    ->withParallel()
    ->withRootFiles()
    ->withPaths([__DIR__.'/src', __DIR__.'/tests'])
    ->withPhpSets(php83: true)
    ->withPreparedSets(deadCode: true, codeQuality: true)
    ->withSkip([
        AddOverrideAttributeToOverriddenMethodsRector::class,
        FlipTypeControlToUseExclusiveTypeRector::class,
    ])
;
