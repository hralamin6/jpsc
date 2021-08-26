<?php

return [
    'font_path' => base_path('resources/fonts/'),
    'font_data' => [
        'examplefont' => [
            'R'  => 'Nikosh.ttf',    // regular font
            'B'  => 'Nikosh.ttf',       // optional: bold font
            'I'  => 'Nikosh.ttf',     // optional: italic font
            'BI' => 'Nikosh.ttf', // optional: bold-italic font
            'useOTL' => 0xFF,
            'useKashida' => 222,
        ],
    ],
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('storage/app/mpdf'),
	'pdf_a'                 => false,
	'pdf_a_auto'            => false,
	'icc_profile_path'      => ''
];
