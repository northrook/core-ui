<?php

declare(strict_types=1);

namespace Core\UI\Component;

use Core\UI\View\{Component};
use Core\UI\Compiler\Component\Node;
use Northrook\HTML\Element;
use Stringable;

// Each Anchor component must have a unique, fixed id.
// This ID should be saved in a database, and be matched with an in-template pattern should the cache be cleared
// The idea is to have each in-code anchor tag be editable from the back-end

/**
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/a MDN
 */
#[Node( 'a' )]
final class Anchor extends Component
{
    private string $href;

    /**
     * @param ?string                                    $href
     * @param array<array-key, string|Stringable>|string $content
     * @param array<string, mixed>                       $attributes
     */
    public function __construct(
        ?string      $href = null,
        string|array $content = [],
        array        $attributes = [],
    ) {
        $this->setHref( $href, $attributes );
        $this->setElement( 'a', $attributes, $content );
    }

    /**
     * @param ?string                 $set
     * @param array<array-key, mixed> $attributes
     *
     * @return $this
     */
    public function setHref( ?string $set, array &$attributes ) : self
    {
        if ( ! $set && \is_string( $attributes['href'] ?? null ) ) {
            $set = $attributes['href'];
            unset( $attributes['href'] );
        }
        else {
            $set = '#';
        }

        // TODO : Validate schema://example.com
        // TODO : parse mailto:, tel:, sms:, etc
        // TODO : handle executable prefix javascript:url.tld
        // TODO : hreflang
        // TODO : sniff rel=referrerPolicy
        // TODO : sniff _target
        // TODO : sniff type
        // TODO : sniff name|id

        $this->href = $set;

        return $this;
    }

    protected function build() : string
    {
        $this->attributes->set( 'href', $this->href );

        return (string) $this->element;
    }

    public function primary() : void
    {
        $this->element->class( 'primary' );
    }

    protected function alias() : array
    {
        return ['a'];
    }

    protected function subtypes() : array
    {
        return [
            'primary'   => [$this, 'primary'],
            'secondary' => [$this, 'secondary'],
        ];
    }
}
