<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $props = [
        'projects' => [
            'My Project',
            'タクシーLog',
            'プロジェクトX',
        ],
    ];
    return view('upload', $props);
});

Route::post('/confirm', function () {
    $props = [
        'project' => 'My Project',
        'filename' => '2022-04-05.xlsx',
        'titles' => [
            '氏名',
            '場所',
            '日付',
            '人数'
        ],
        'records' => [
            [
                '氏名' => '山田 太郎',
                '場所' => '奈良市',
                '日付' => '2022/03/02',
                '人数' => '2303人',
            ],
            [
                '氏名' => '中村 日向',
                '場所' => '大和郡山市',
                '日付' => '2022/04/02',
                '人数' => '',
            ],
            [
                '氏名' => '中村 日向',
                '場所' => '生駒市',
                '日付' => '2022/01/01',
                '人数' => '2人',
            ],
        ],
    ];
    return view('confirm', $props);
});

Route::get('/download', function () {
    $props = [
        'downloads' => [
            [
                'project' => 'My Project',
                'count' => '5件',
                'lastDate' => '2022/05/05',
            ],
            [
                'project' => 'Your Project',
                'count' => '105件',
                'lastDate' => '2022/10/12',
            ],
            [
                'project' => 'His Project',
                'count' => '21件',
                'lastDate' => '2022/02/04',
            ],
        ]
    ];
    return view('upload', $props);
});
