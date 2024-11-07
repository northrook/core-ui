<?php

namespace Core\UI\View;

/**
 * @extends \Core\UI\View\Component
 */
trait InnerContent
{
    protected array $content = [];

    /**
     * Set inner content for this {@see Component}.
     *
     * @param array|string $content
     *
     * @return self
     */
    public function setContent( array|string $content ) : self
    {
        if ( \is_array( $content ) ) {
            $this->content = \array_merge( $this->content, $content );
        }
        else {
            $this->content['content'] = $content;
        }
        return $this;
    }
}
