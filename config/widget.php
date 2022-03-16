<?php

return [
    'header' => [
        'title' => 'Header',
        'data_type' => ['header' => 'Header'],
        'widget_type' => [
            'header_one' => 'Header one',
            'header_two' => 'Header two',
            'header_three' => 'Header three'
        ],
        'data_Limit' => false,
        'status' => true

    ],
    'marquee' => [
        'title' => 'Marquee',
        'data_type' => ['marquee' => 'Marquee'],
        'widget_type' => [
            'marquee' => 'Marque One',
            'marquee' => 'Marque Two'
        ],
        'data_Limit' => true,
        'status' => true
    ],
    'post' => [
        'title' => 'Post',
        'data_type' => [
            'single_post' => 'Single Post',
            'multiple_post' => 'Multiple Post',
            'category' => 'Category'
        ],
        'widget_type' => [
            'single_post' => [
                'single_post_1' =>  'Single Post (with short description)',
                'single_post_2' =>  'Single Post (right side image)',
                'single_post_3' =>  'Single Post (left side image)',
                'single_post_4' =>  'Single Post (left side title)',
                'single_post_5' =>  'Single Post (right side title)',
            ],
            'multiple_post' => [
                'multiple_post_1' =>  'Multiple Post',
                'multiple_post_2' =>  'Multiple Post (right side image)',
                'multiple_post_3' =>  'Slider',
            ]
        ],
        'data_Limit' => true,
        'status' => true
    ],

    'footer' => [
        'title' => 'Footer',
        'data_type' => ['header' => 'Footer'],
        'widget_type' => [
            'footer_one' => 'Footer one',
            'footer_two' => 'Footer two',
            'footer_three' => 'Footer three',
        ],
        'data_Limit' => false,
        'status' => true
    ]

];
