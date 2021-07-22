@include('includes.filter', [
    'name' => $name ?? 'sort_by',
    'label' => $label ?? 'Сортувати',
    'default' => $default ?? null,
    'keys' => $keys ?? [
        'latest' => 'Спочатку нові',
        'oldest' => 'Спочатку старі',
    ]
])
