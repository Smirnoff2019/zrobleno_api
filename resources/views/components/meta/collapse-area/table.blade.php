@props([
    'expanded'   => "false",
    'name'       => "empty_".rand(10, 99999),
])

<div 
    {{ $attributes->merge([
        'class'           => "mb-0 collapse",
        'id'              => $name,
        'aria-labelledby' => ""
    ])->whereDoesntStartWith(['table:', 'tbody:']) }}
    >
    <table class="{{ $attributes->merge(['table:class' => "table mb-0"])->get('table:class') }}">
        <tbody class="{{ $attributes->merge(['tbody:class' => "border-top-0"])->get('tbody:class') }}">

            {{ $slot }}

        </tbody>
    </table>
</div>