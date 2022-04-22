<?php

declare (strict_types=1);
namespace RectorPrefix20220422;

use Rector\CodeQuality\Rector\FunctionLike\SimplifyUselessVariableRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\Array_\RemoveDuplicatedArrayKeyRector;
use Rector\DeadCode\Rector\Assign\RemoveDoubleAssignRector;
use Rector\DeadCode\Rector\Assign\RemoveUnusedVariableAssignRector;
use Rector\DeadCode\Rector\BinaryOp\RemoveDuplicatedInstanceOfRector;
use Rector\DeadCode\Rector\BooleanAnd\RemoveAndTrueRector;
use Rector\DeadCode\Rector\Cast\RecastingRemovalRector;
use Rector\DeadCode\Rector\ClassConst\RemoveUnusedPrivateClassConstantRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveDeadConstructorRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveDelegatingParentCallRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveEmptyClassMethodRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveLastReturnRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedConstructorParamRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedParamInRequiredAutowireRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodParameterRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector;
use Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector;
use Rector\DeadCode\Rector\Concat\RemoveConcatAutocastRector;
use Rector\DeadCode\Rector\Expression\RemoveDeadStmtRector;
use Rector\DeadCode\Rector\Expression\SimplifyMirrorAssignRector;
use Rector\DeadCode\Rector\For_\RemoveDeadContinueRector;
use Rector\DeadCode\Rector\For_\RemoveDeadIfForeachForRector;
use Rector\DeadCode\Rector\For_\RemoveDeadLoopRector;
use Rector\DeadCode\Rector\Foreach_\RemoveUnusedForeachKeyRector;
use Rector\DeadCode\Rector\FunctionLike\RemoveCodeAfterReturnRector;
use Rector\DeadCode\Rector\FunctionLike\RemoveDeadReturnRector;
use Rector\DeadCode\Rector\FunctionLike\RemoveDuplicatedIfReturnRector;
use Rector\DeadCode\Rector\FunctionLike\RemoveOverriddenValuesRector;
use Rector\DeadCode\Rector\If_\RemoveDeadInstanceOfRector;
use Rector\DeadCode\Rector\If_\RemoveUnusedNonEmptyArrayBeforeForeachRector;
use Rector\DeadCode\Rector\If_\SimplifyIfElseWithSameContentRector;
use Rector\DeadCode\Rector\If_\UnwrapFutureCompatibleIfFunctionExistsRector;
use Rector\DeadCode\Rector\If_\UnwrapFutureCompatibleIfPhpVersionRector;
use Rector\DeadCode\Rector\MethodCall\RemoveEmptyMethodCallRector;
use Rector\DeadCode\Rector\Node\RemoveNonExistingVarAnnotationRector;
use Rector\DeadCode\Rector\Property\RemoveUnusedPrivatePropertyRector;
use Rector\DeadCode\Rector\PropertyProperty\RemoveNullPropertyInitializationRector;
use Rector\DeadCode\Rector\Return_\RemoveDeadConditionAboveReturnRector;
use Rector\DeadCode\Rector\StaticCall\RemoveParentCallWithoutParentRector;
use Rector\DeadCode\Rector\Stmt\RemoveUnreachableStatementRector;
use Rector\DeadCode\Rector\Switch_\RemoveDuplicatedCaseInSwitchRector;
use Rector\DeadCode\Rector\Ternary\TernaryToBooleanOrFalseToBooleanAndRector;
use Rector\DeadCode\Rector\TryCatch\RemoveDeadTryCatchRector;
use Rector\PHPUnit\Rector\ClassMethod\RemoveEmptyTestMethodRector;
return static function (\Rector\Config\RectorConfig $rectorConfig) : void {
    $rectorConfig->rule(\Rector\DeadCode\Rector\If_\UnwrapFutureCompatibleIfFunctionExistsRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\If_\UnwrapFutureCompatibleIfPhpVersionRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Cast\RecastingRemovalRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Expression\RemoveDeadStmtRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Array_\RemoveDuplicatedArrayKeyRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Foreach_\RemoveUnusedForeachKeyRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\StaticCall\RemoveParentCallWithoutParentRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\ClassMethod\RemoveEmptyClassMethodRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Assign\RemoveDoubleAssignRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Expression\SimplifyMirrorAssignRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\FunctionLike\RemoveOverriddenValuesRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Property\RemoveUnusedPrivatePropertyRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\ClassConst\RemoveUnusedPrivateClassConstantRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\FunctionLike\RemoveCodeAfterReturnRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\ClassMethod\RemoveDeadConstructorRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\FunctionLike\RemoveDeadReturnRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\For_\RemoveDeadContinueRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\For_\RemoveDeadIfForeachForRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\BooleanAnd\RemoveAndTrueRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Concat\RemoveConcatAutocastRector::class);
    $rectorConfig->rule(\Rector\CodeQuality\Rector\FunctionLike\SimplifyUselessVariableRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\ClassMethod\RemoveDelegatingParentCallRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\BinaryOp\RemoveDuplicatedInstanceOfRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Switch_\RemoveDuplicatedCaseInSwitchRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\PropertyProperty\RemoveNullPropertyInitializationRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Stmt\RemoveUnreachableStatementRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\If_\SimplifyIfElseWithSameContentRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Ternary\TernaryToBooleanOrFalseToBooleanAndRector::class);
    $rectorConfig->rule(\Rector\PHPUnit\Rector\ClassMethod\RemoveEmptyTestMethodRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\TryCatch\RemoveDeadTryCatchRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Assign\RemoveUnusedVariableAssignRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\FunctionLike\RemoveDuplicatedIfReturnRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\If_\RemoveUnusedNonEmptyArrayBeforeForeachRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\MethodCall\RemoveEmptyMethodCallRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Return_\RemoveDeadConditionAboveReturnRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\ClassMethod\RemoveUnusedConstructorParamRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\If_\RemoveDeadInstanceOfRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\For_\RemoveDeadLoopRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodParameterRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\ClassMethod\RemoveUnusedParamInRequiredAutowireRector::class);
    // docblock
    $rectorConfig->rule(\Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\Node\RemoveNonExistingVarAnnotationRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector::class);
    $rectorConfig->rule(\Rector\DeadCode\Rector\ClassMethod\RemoveLastReturnRector::class);
};
