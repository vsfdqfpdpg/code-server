<?php

include "section.php";

$basic = [
    "Basic",
    "data & type",
    [
        'string' => ['char', 'string', 'test'],
        'numeric' => ['definition', 'convert'],
        'decimal' => ['float', 'double'],
        'array' => ['iterator', 'sort', 'manipulate'],
        'object' => ['class', 'interface'],
        'boolean',
        'null',
        'callback',
        'resource'
    ]
];

$example = [
    "Example",
    "interest",
    [
        'graph' => ['pyramid'],
    ]
];

$section = new Section("/home/coder/project/docs/languages/docs", ...$example);
$section->create();
