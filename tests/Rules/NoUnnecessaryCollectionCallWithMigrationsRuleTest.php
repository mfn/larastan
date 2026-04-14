<?php

declare(strict_types=1);

namespace Tests\Rules;

use Larastan\Larastan\Properties\ModelPropertyExtension;
use Larastan\Larastan\Properties\ModelPropertyHelper;
use Larastan\Larastan\Rules\NoUnnecessaryCollectionCallRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/** @extends RuleTestCase<NoUnnecessaryCollectionCallRule> */
class NoUnnecessaryCollectionCallWithMigrationsRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NoUnnecessaryCollectionCallRule(
            $this->createReflectionProvider(),
            self::getContainer()->getByType(ModelPropertyExtension::class),
            self::getContainer()->getByType(ModelPropertyHelper::class),
            [],
            [],
        );
    }

    public function testPropertyTagDoesNotHideDatabaseColumn(): void
    {
        $this->analyse([__DIR__ . '/data/UnnecessaryCollectionCallsPropertyTag.php'], [
            ['Called \'pluck\' on Laravel collection, but could have been retrieved as a query.', 15],
        ]);
    }

    /** @return string[] */
    public static function getAdditionalConfigFiles(): array
    {
        return [__DIR__ . '/data/config-with-migrations.neon'];
    }
}
