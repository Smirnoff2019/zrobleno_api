@props([
    'width' => 300,
    'scope' => "row",
])

<tr {{ $attributes }}>
    <td class="border-right bg-light" scope="{{ $scope }}" width="{{ $width }}">
        {{ $label ?? '' }}
    </td>
    <td>
        {{ $slot }}
    </td>
</tr>