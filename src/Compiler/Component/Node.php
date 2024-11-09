<?php

namespace Core\UI\Compiler\Component;

use Attribute;
use JetBrains\PhpStorm\ExpectedValues;
use Northrook\HTML\Element\Tag;

// used to take over an HTML node, skipping the <ui: prefix

#[Attribute( Attribute::TARGET_CLASS )]
final readonly class Node
{

    public array $tags;

    public function __construct(
        #[ExpectedValues( Tag::TAGS )]  string ...$tag,
    ) {
        $this->tags = $tag;
        // must be extending Component::class
        // set trigger conditions: tag[], attribute, etc
    }

}
