<?php

declare(strict_types=1);

namespace Fortochka\SeederAnnotation;

use Doctrine\Common\Annotations\AnnotationException;

/**
 * @Annotation
 * @Target("METHOD")
 */
class Seeder
{
    public array $seederClasses;

    public function __construct(array $values)
    {
        if (empty($values['value'])) {
            throw new AnnotationException('Required seeder class or array of seeder classes');
        }
        $value = $values['value'];

        $this->seederClasses = (array)$value;

        foreach ($this->seederClasses as $seederClass) {
            if (!class_exists($seederClass)) {
                throw new AnnotationException("Seeder class \"$seederClass\" not exists");
            }
        }
    }
}
