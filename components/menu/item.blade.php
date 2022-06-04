@props([
    'text',
])

<x-deprecated-list.item text="{{ $text }}" role="menuitem">{{ $slot }}</x-deprecated-list.item>
