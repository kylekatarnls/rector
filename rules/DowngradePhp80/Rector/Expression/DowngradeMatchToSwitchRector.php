<?php

declare (strict_types=1);
namespace Rector\DowngradePhp80\Rector\Expression;

use PhpParser\Node;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\Match_;
use PhpParser\Node\Expr\Throw_;
use PhpParser\Node\MatchArm;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Break_;
use PhpParser\Node\Stmt\Case_;
use PhpParser\Node\Stmt\Echo_;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\Return_;
use PhpParser\Node\Stmt\Switch_;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @changelog https://wiki.php.net/rfc/match_expression_v2
 *
 * @see \Rector\Tests\DowngradePhp80\Rector\Expression\DowngradeMatchToSwitchRector\DowngradeMatchToSwitchRectorTest
 */
final class DowngradeMatchToSwitchRector extends \Rector\Core\Rector\AbstractRector
{
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Downgrade match() to switch()', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(<<<'CODE_SAMPLE'
class SomeClass
{
    public function run()
    {
        $message = match ($statusCode) {
            200, 300 => null,
            400 => 'not found',
            default => 'unknown status code',
        };
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
class SomeClass
{
    public function run()
    {
        switch ($statusCode) {
            case 200:
            case 300:
                $message = null;
                break;
            case 400:
                $message = 'not found';
                break;
            default:
                $message = 'unknown status code';
                break;
        }
    }
}
CODE_SAMPLE
)]);
    }
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes() : array
    {
        return [\PhpParser\Node\Stmt\Echo_::class, \PhpParser\Node\Stmt\Expression::class, \PhpParser\Node\Stmt\Return_::class];
    }
    /**
     * @param Echo_|Expression|Return_ $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        $match = $this->betterNodeFinder->findFirst($node, function (\PhpParser\Node $subNode) : bool {
            return $subNode instanceof \PhpParser\Node\Expr\Match_;
        });
        if (!$match instanceof \PhpParser\Node\Expr\Match_) {
            return null;
        }
        if ($this->shouldSkip($match)) {
            return null;
        }
        $switchCases = $this->createSwitchCasesFromMatchArms($node, $match->arms);
        return new \PhpParser\Node\Stmt\Switch_($match->cond, $switchCases);
    }
    private function shouldSkip(\PhpParser\Node\Expr\Match_ $match) : bool
    {
        return (bool) $this->betterNodeFinder->findFirst($match, function (\PhpParser\Node $subNode) : bool {
            return $subNode instanceof \PhpParser\Node\Expr\ArrayItem && $subNode->unpack;
        });
    }
    /**
     * @param MatchArm[] $matchArms
     * @return Case_[]
     * @param \PhpParser\Node\Stmt\Echo_|\PhpParser\Node\Stmt\Expression|\PhpParser\Node\Stmt\Return_ $node
     */
    private function createSwitchCasesFromMatchArms($node, array $matchArms) : array
    {
        $switchCases = [];
        foreach ($matchArms as $matchArm) {
            if (\count((array) $matchArm->conds) > 1) {
                $lastCase = null;
                foreach ((array) $matchArm->conds as $matchArmCond) {
                    $lastCase = new \PhpParser\Node\Stmt\Case_($matchArmCond);
                    $switchCases[] = $lastCase;
                }
                if (!$lastCase instanceof \PhpParser\Node\Stmt\Case_) {
                    throw new \Rector\Core\Exception\ShouldNotHappenException();
                }
                $lastCase->stmts = $this->createSwitchStmts($node, $matchArm);
            } else {
                $stmts = $this->createSwitchStmts($node, $matchArm);
                $switchCases[] = new \PhpParser\Node\Stmt\Case_($matchArm->conds[0] ?? null, $stmts);
            }
        }
        return $switchCases;
    }
    /**
     * @return Stmt[]
     * @param \PhpParser\Node\Stmt\Echo_|\PhpParser\Node\Stmt\Expression|\PhpParser\Node\Stmt\Return_ $node
     */
    private function createSwitchStmts($node, \PhpParser\Node\MatchArm $matchArm) : array
    {
        $stmts = [];
        if ($matchArm->body instanceof \PhpParser\Node\Expr\Throw_) {
            $stmts[] = new \PhpParser\Node\Stmt\Expression($matchArm->body);
        } elseif ($node instanceof \PhpParser\Node\Stmt\Return_) {
            $stmts[] = new \PhpParser\Node\Stmt\Return_($matchArm->body);
        } elseif ($node instanceof \PhpParser\Node\Stmt\Echo_) {
            $stmts[] = new \PhpParser\Node\Stmt\Echo_([$matchArm->body]);
            $stmts[] = new \PhpParser\Node\Stmt\Break_();
        } elseif ($node->expr instanceof \PhpParser\Node\Expr\Assign) {
            /** @var Assign $assign */
            $assign = $node->expr;
            $stmts[] = new \PhpParser\Node\Stmt\Expression(new \PhpParser\Node\Expr\Assign($assign->var, $matchArm->body));
            $stmts[] = new \PhpParser\Node\Stmt\Break_();
        } elseif ($node->expr instanceof \PhpParser\Node\Expr\Match_) {
            $stmts[] = new \PhpParser\Node\Stmt\Expression($matchArm->body);
            $stmts[] = new \PhpParser\Node\Stmt\Break_();
        }
        return $stmts;
    }
}
