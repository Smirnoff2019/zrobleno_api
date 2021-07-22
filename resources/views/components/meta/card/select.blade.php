{{-- meta-field-card --}}
<x-meta.card :id="'meta-field-'.$id">
    
    <input type="hidden" id="_data-field"        name="fields[{{ $id }}][id]"        value="{{ $id }}">
    <input type="hidden" id="_data-parent-field" name="fields[{{ $id }}][parent_id]" value="{{ $parentId }}">
    
    {{-- Card header --}}
    <x-meta.card-header>

        {{-- Meta field controls --}}
        <x-meta.card-header.controls>

            {{-- Meta field params collapse control --}}
            <x-meta.collapse-control :target="$collapse['params']['target'] ?? ''" :checked="(bool) $collapse['params']['show']">
                <i class="fas {{ $collapse['params']['icon'] ?? 'fa-cogs' }}"></i>
            </x-meta.collapse-control>

        </x-meta.card-header.controls>

        {{-- Meta field name --}}
        <x-meta.card-header.name :target="$collapse['params']['target'] ?? ''">
            {{ $name }}
        </x-meta.card-header.name>

        {{-- Meta field slug --}}
        <x-meta.card-header.slug>
            {{ $slug }}
        </x-meta.card-header.slug>

        {{-- Meta field slug --}}
        <x-meta.card-header.type>
            @metaFieldTypeName($type)
        </x-meta.card-header.type>

    </x-meta.card-header>

    {{-- meta-field-card-body --}}
    <div class="meta-field-card-body col-12 px-0">

        {{-- Field Params Collapse --}}
        <x-meta.collapse-area.table
            class="meta-field-card-body--params {{ ((bool) $collapse['params']['show']) ? 'show' : '' }}"
            :id="$collapse['params']['target'] ?? ''" 
            :aria-labelledby="$collapse['params']['labelledby'] ?? ''"
            >

            {{-- Name param field --}}
            <x-meta.card-params.name
                :id="$params['name']['id']"
                :title="$params['name']['title']"
                :description="$params['name']['description']"
                :name="$params['name']['name']"
                :value="$params['name']['value']"
                data-toggle="change-sync"
                data-target="#meta-field-{{ $id }} .meta-field-card-header .meta-field-card-header--name"
            />

            {{-- Slug param field --}}
            <x-meta.card-params.slug
                :id="$params['slug']['id']"
                :title="$params['slug']['title']"
                :description="$params['slug']['description']"
                :name="$params['slug']['name']"
                :value="$params['slug']['value']"
                data-slugify="#meta-field-{{ $id }} input#{{ $params['name']['id'] }}"
                data-toggle="change-sync"
                data-target="#meta-field-{{ $id }} .meta-field-card-header .meta-field-card-header--slug"
            />

            {{-- Slug param field --}}
            <x-meta.card-params.type
                :id="$params['type']['id']"
                :title="$params['type']['title']"
                :description="$params['type']['description']"
                :name="$params['type']['name']"
                :value="$params['type']['value']"
                {{-- data-toggle="change-sync" --}}
                data-target="#meta-field-{{ $id }} .meta-field-card-header .meta-field-card-header--type"
            />

            {{-- Options param field --}}
            <x-meta.card-params.textarea
                :id="$params['options']['id']"
                :title="$params['options']['title']"
                :description="$params['options']['description']"
                :placeholder="$params['options']['placeholder']"
                :name="$params['options']['name']"
                :value="$params['options']['value']"
                :rows="$params['options']['rows'] ?? null"
                data-param-name="options"
            />
            
        </x-meta.collapse-area.table-row>

    </div>

</x-meta.card>