@include('includes.filter', [
    'name' => $name ?? 'per_page',
    'label' => $label ?? '25 записів',
    'default' => $default ?? 25,
    'keys' => $keys ?? [
        '50' => '50 записів',
        '100' => '100 записів',
        '150' => '150 записів',
        '200' => '200 записів',
        '500' => '500 записів',
    ]
])
