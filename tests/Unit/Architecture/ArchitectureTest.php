<?php

namespace Tests\Unit\Architecture;

describe('Architecture Validation Tests', function () {
    it('App\Models must be classes')
        ->expect('App\Models')
        ->toBeClass();

    it('App\Models must be in the Models namespace')
        ->expect('App\Models')
        ->toStartWith('App\Models');

    it('App\Models must be extends from model')
        ->expect('App\Models')
        ->toExtend('Illuminate\Database\Eloquent\Model');

    it('App\Services must be in the Services namespace')
        ->expect('App\Services')
        ->toStartWith('App\Services');

    it('App\Providers must be in the Providers namespace')
        ->expect('App\Providers')
        ->toStartWith('App\Providers');

    it('App\Http\Controllers must be in the Http\Controllers namespace')
        ->expect('App\Http\Controllers')
        ->toStartWith('App\Http\Controllers');

    it('Controllers extends Controller')
        ->expect('App\Http\Controllers')
        ->toExtend('App\Http\Controllers\Controller');

    it('App\Http\Requests must be in the Http\Requests namespace')
        ->expect('App\Http\Requests')
        ->toStartWith('App\Http\Requests');

    it('Requests extends FormRequest')
        ->expect('App\Http\Requests')
        ->toExtend('Illuminate\Foundation\Http\FormRequest');

    it('App\Http\Middleware must be in the Http\Middleware namespace')
        ->expect('App\Http\Middleware')
        ->toStartWith('App\Http\Middleware');

    it('App\Http\Middleware must be classes')
        ->expect('App\Http\Middleware')
        ->toBeClass();
})->group('arch');
