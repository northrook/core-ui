<?php

declare(strict_types=1);

namespace Core\UI\View;

use Northrook\HTML\Element;
use Northrook\HTML\Element\Attributes;
use Stringable;
use function Support\classBasename;

abstract class Component implements Stringable
{
    protected const array ARGUMENTS = [];

    private readonly string $hash;

    protected readonly Element $element;

    protected readonly Attributes $attributes;

    final protected function setElement( string $tag, array $attributes = [], mixed $content = null ) : void
    {
        $this->element    = new Element( $tag, $attributes, $content );
        $this->attributes = $this->element->attributes;
    }

    /**
     * Called when the Component is stringified.
     *
     * @return string
     */
    abstract protected function build() : string;

    /**
     * @return string[]
     */
    protected function alias() : array
    {
        return [];
    }

    /**
     * @return array<string, callable>
     */
    protected function subtypes() : array
    {
        return [];
    }

    final public function __toString() : string
    {
        return $this->build();
    }

    /**
     * @return string[]
     */
    final public function componentTags() : array
    {
        $tags    = [];
        $aliases = [$this->componentName(), ...$this->alias()];

        foreach ( $aliases as $alias ) {
            $tags[] = $alias;

            foreach ( $this->subtypes() as $subtype => $callback ) {
                $tags[] = "{$alias}:{$subtype}";
            }
        }

        return $tags;
    }

    final public function componentName() : string
    {
        return \strtolower( classBasename( self::class ) );
    }

    final public function componentHash() : string
    {
        if ( ! isset( $this->hash ) ) {
            $this->setHash();
        }
        return $this->hash;
    }

    final public function setHash( ?string $hash = null ) : void
    {
        if ( ! $hash ) {
            $this->hash ??= \hash( algo : 'xxh3', data : \spl_object_id( $this ).\serialize( $this ) );
            return;
        }
        if ( \strlen( $hash ) === 16 && \ctype_alnum( $hash ) ) {
            $this->hash ??= \strtolower( $hash );
            return;
        }
        $this->hash ??= \hash( algo : 'xxh3', data : $hash );
    }
}
