<?php

require_once __DIR__ . '/Generator.php';



$base = file_get_contents(__DIR__ . '/base.playplus');
$changes = [
    '__ACTION__' => [
        'up',
        'down',
        'left',
        'right'
    ],
    '__TYPE__' => [
        'bool',
        'char'
    ],
    '__VALUE__' => [
        'true',
        '2',
        "'a'",
        "'2'",
    ],
];

$output_dir = '/home/latour/Documents/PHP/test_generator/output';
$begin_file_name_with = 'action_move';
$count_instead_of_writing_the_search = ['__VALUE__'];
$gen = new TestGenerator($base, $changes, $begin_file_name_with, $output_dir, $count_instead_of_writing_the_search);

$gen->generate();

