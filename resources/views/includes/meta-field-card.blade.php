@php
    $show = false;    
@endphp

@switch($type)
    @case('group')
        <x-meta.card.group
            :id="$id ?? null"
            :name="$name ?? null"
            :slug="$slug ?? null"
            :showParams="$show"
            :parentId="$parent_id ?? null"
            >
            @if($children)
                @foreach($children ?? [] as $key => $child)
                    @include('includes.meta-field-card', [
                        'id'        => $child->id,
                        'name'      => $child->name,
                        'slug'      => $child->slug,
                        'type'      => $child->type,
                        'options'   => $child->options,
                        'parent_id' => $child->parent_id,
                        'children'  => $child->children ?? [],
                    ])
                @endforeach
            @endif
        </x-meta.card.group>
        @break

    @case('text')
        <x-meta.card.text
            :id="$id ?? null"
            :name="$name ?? null"
            :slug="$slug ?? null"
            :showParams="$show"
            :parentId="$parent_id ?? null"
            >
        </x-meta.card.text>
        @break

    @case('textarea')
        <x-meta.card.textarea
            :id="$id ?? null"
            :name="$name ?? null"
            :slug="$slug ?? null"
            :showParams="$show"
            :parentId="$parent_id ?? null"
            >
        </x-meta.card.textarea>
        @break

    @case('number')
        <x-meta.card.number
            :id="$id ?? null"
            :name="$name ?? null"
            :slug="$slug ?? null"
            :showParams="$show"
            :parentId="$parent_id ?? null"
            >
        </x-meta.card.number>
        @break

    @case('url')
        <x-meta.card.url
            :id="$id ?? null"
            :name="$name ?? null"
            :slug="$slug ?? null"
            :showParams="$show"
            :parentId="$parent_id ?? null"
            >
        </x-meta.card.url>
        @break

    @case('email')
        <x-meta.card.email
            :id="$id ?? null"
            :name="$name ?? null"
            :slug="$slug ?? null"
            :showParams="$show"
            :parentId="$parent_id ?? null"
            >
        </x-meta.card.email>
        @break

    @case('select')
        <x-meta.card.select
            :id="$id ?? null"
            :name="$name ?? null"
            :slug="$slug ?? null"
            :options="$options ?? null"
            :showParams="$show"
            :parentId="$parent_id ?? null"
            >
        </x-meta.card.select>
        @break

    @case('password')
        <x-meta.card.password
            :id="$id ?? null"
            :name="$name ?? null"
            :slug="$slug ?? null"
            :showParams="$show"
            :parentId="$parent_id ?? null"
            >
        </x-meta.card.password>
        @break

    @case('image')
        <x-meta.card.image
            :id="$id ?? null"
            :name="$name ?? null"
            :slug="$slug ?? null"
            :showParams="$show"
            :parentId="$parent_id ?? null"
            >
        </x-meta.card.image>
        @break

    @case('images_gallery')
        <x-meta.card.images_gallery
            :id="$id ?? null"
            :name="$name ?? null"
            :slug="$slug ?? null"
            :showParams="$show"
            :parentId="$parent_id ?? null"
            >
        </x-meta.card.images_gallery>
        @break

    @default
        
@endswitch