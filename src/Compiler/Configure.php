<?php

declare(strict_types=1);

namespace Core\UI\Compiler;

use Core\UI\Exception\ComponentNotFoundException;
use Core\UI\View\Component;
use Support\ClassInfo;

final class Configure
{
    public static function registerComponents( string|array $from ) : array
    {
        $components = [];
        if ( \is_string( $from ) && \str_ends_with( $from, '/*.php' ) ) {
            foreach ( \glob( $from ) ?: [] as $filePath ) {
                $component                         = new ClassInfo( $filePath );
                $components[$component->className] = $component;
            }
        }
        else {
            foreach ( $from as $componentClass ) {
                $component                       = new ClassInfo( $componentClass );
                $components[$component->className] = $component;
            }
        }

        dd( $components );

        // foreach ( $components as $name => $class ) {
        //     if ( ! \class_exists( $class ) || ! \is_subclass_of( $class, Component::class, true ) ) {
        //         throw new ComponentNotFoundException( $class );
        //     }
        //
        //     $
        //
        //     $componentName = $class::getName();
        //
        //     if ( $name !== $componentName ) {
        //         throw new \InvalidArgumentException( "The '" . $class::class . "' component name does not match the assigned key." );
        //     }
        // }

        return $components;
    }
}
