<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke(){
        // return ['a', 'b', 'c'];
        // return [
        //     'foo' => 'bar',
        //     'faz' => 'bap'
        // ];
        // return [
        //     'id' => 191402062,
        //     'name' => 'Jason Surya Faylim',
        //     'courses' => [
        //         [
        //             'name' => 'Pemograman Integrative',
        //             'score' => 'B'
        //         ],[
        //             'name' => 'Pemograman Web',
        //             'score' => 'C+'
        //         ],
        //     ]
        // ];
        // return redirect()->route('test1');
        // return response()->json([
        //     'id' => 191402062,
        //     'name' => 'Jason Surya Faylim',
        //     'courses' => [
        //         [
        //             'name' => 'Pemograman Integrative',
        //             'score' => 'B'
        //         ],[
        //             'name' => 'Pemograman Web',
        //             'score' => 'C+'
        //         ],
        //     ]
        // ]);
        // return response()->json([
        //     'username' => 'Is already registered',
        //     'email' => 'Duplicated email',
        //     'name' => 'Name too long',
        //     'file' => 'File size too large'
        // ], 400);
        // return 'Hello World!';
        // return 100;
        return response()->json("Hello World!");
        // return response()->json(100);
    }

    // 502 - Bad Gateway
    // 500 - Server Error
    // 404 - Not Found
    // 403 - Forbidden
    // 401 - Unauthorized
    // 400 - Bad Request
    // 3xx - Redirection
    // 200 - Ok

    // 5xx - Backend yang salah
    // 4xx - Frontend yang salah
    // 3xx - Salah alamat, ganti alamat
    // 2xx - Baik-baik saja
    // 100 - Informasi

    public function test1(){
        return 'Hello!';
    }
}
