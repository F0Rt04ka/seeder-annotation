<?php
declare(strict_types=1);

namespace Fortochka\SeederAnnotation;

use Doctrine\Common\Annotations\AnnotationReader;

/**
 * @mixin \Orchestra\Testbench\TestCase
 */
trait SeederLoader
{
    /** @var AnnotationReader */
    protected static $annotationReader;

    protected function loadSeedsFromAnnotations(): void
    {
        /** @var Seeder|null $annotation */
        $annotation = $this
            ->getAnnotationReader()
            ->getMethodAnnotation(
                new \ReflectionMethod(static::class, $this->getName(false)),
                Seeder::class
            );

        if ($annotation) {
            foreach ($annotation->seederClasses as $seederClass) {
                $this->seed($seederClass);
            }
        }
    }

    protected function ignoredAnnotations(): array
    {
        return [
            'dataProvider',
        ];
    }

    protected function getAnnotationReader()
    {
        if (!self::$annotationReader) {
            foreach ($this->ignoredAnnotations() as $ignoredAnnotation) {
                AnnotationReader::addGlobalIgnoredName($ignoredAnnotation);
            }

            self::$annotationReader = new AnnotationReader();
        }

        return self::$annotationReader;
    }
}
