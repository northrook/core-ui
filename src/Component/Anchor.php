<?php

declare(strict_types=1);

namespace Core\UI\Component;

use Core\UI\View\{Component, InnerContent};

// Each Anchor component must have a unique, fixed id.
// This ID should be saved in a database, and be matched with an in-template pattern should the cache be cleared
// The idea is to have each in-code anchor tag be editable from the back-end

/**
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/a MDN
 */
final class Anchor extends Component
{
    use InnerContent;

    private string $href;

    /**
     * @param string                 $href
     * @param null|null|array|string $content
     * @param array                  $attributes
     */
    public function __construct(
        string       $href,
        string|array $content,
        array        $attributes = [],
    ) {
        $this->setHref( $href );
        $this->setContent( $content );
    }

    /**
     * @param string $set
     *
     * @return $this
     */
    public function setHref( string $set ) : self
    {
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

    public function setContent() {}

    protected function build() : string
    {
        return __CLASS__;
    }
}
