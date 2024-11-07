<?php

declare(strict_types=1);

namespace Core\UI\View;

use Stringable;
use function Support\classBasename;

abstract class Component implements Stringable
{

    /**
     * Called when the Component is stringified.
     *
     * @return string
     */
    abstract protected function build() : string;

    final public function __toString() : string
    {
        return $this->build();
    }

    final public function componentName() : string
    {
        return \strtolower( classBasename( $this::class ) );
    }

    final public function componentHash() : string
    {
        return \hash( algo : 'xxh3', data : \spl_object_id( $this ).\serialize( $this ) );
    }
}
