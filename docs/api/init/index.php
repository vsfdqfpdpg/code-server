<?php
error_reporting(0);

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

$control = [
    "Basic",
    "control & flow",
    [
        "operator" => ["arithmetic", "assignment", "comparison", "increment & decrement", "logical", "string", "array"],
        "control" => ["if", "switch"],
        "loop" => ["for", "foreach", "while"]
    ]
];

$fileAndDirectory = [
    "Basic",
    "file & directory",
    [
        "file",
        "directory"
    ]
];

$graphics = [
    "Basic",
    "graphics",
    [
        "basic" => [
            "label",
            "button",
            "input",
            "password",
            "textarea",
            "checkbox",
            "radio",
            "selection"
        ],
        "advanced",
        "layout" => [
            "flow",
            "grid",
            "border",
            "card",
            "null",
            "box"
        ],
        "event" => [
            "action",
            "focus",
            "keyboard",
            "mouse",
            "window"
        ]
    ]
];

$socket = [
    "Basic",
    "socket",
    [
        "tcp" => [
            "single client",
            "multiple clients",
            "key game"
        ],
        "udp" =>[
            "single client",
            "multiple clients",
            "key game"
        ],
        "chat" => [
            "server",
            "client"
        ]
    ]
];

$reflection = [
    "Basic",
    "reflection",
    [
        "class",
        "method",
        "properties",
        "constructor"
    ]
];

$example = [
    "Example",
    "interest",
    [
        'graph' => ['pyramid'],
    ]
];

$section = new Section("/home/fumei/code-server/docs/languages/docs", ...$reflection);
$section->create();
