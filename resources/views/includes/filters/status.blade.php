@include('includes.filter', [
    'name' => $name ?? 'status_id',
    'label' => $label ?? 'Статус',
    'default' => $default ?? null,
    'keys' => $keys ?? $statuses->pluck('name', 'id')
])
