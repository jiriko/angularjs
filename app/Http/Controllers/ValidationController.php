<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidationController extends Controller
{
    /**
     * This will validate a field (request('q'))
     * based on the validation types (request('type'))
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function __invoke()
    {
        $this->verifyInput();

        request()->validate([
            'q' => $this->getValidationRules()
        ]);

        return response([]);
    }

    private function getValidationRules()
    {
        $rules = $this->getSimpleRules();

        foreach ($this->getComplexRules() as $rule) {
            $rules->push(
                $this->{'get' . $rule . 'Rule'}()
            );
        }

        return $rules->values()->implode('|');
    }

    private function getComplexRules()
    {
        return collect(['unique'])->filter(function ($rule) {
            return in_array($rule, explode(',', request('type')));
        });
    }

    private function getSimpleRules()
    {
        return collect(explode(',', request('type')))->filter(function ($rule) {
            return !in_array($rule, $this->getComplexRules()->all());
        });
    }

    private function getTable()
    {
        $tables = [
            '1' => 'users',
            '2' => 'students'
        ];

        if (!array_key_exists(request('t'), $tables)) {
            abort(422, 'Invalid table.');
        }

        return $tables[request('t')];
    }

    private function verifyInput()
    {
        request()->validate([
            'type' => 'required',
            'q' => 'required',
        ]);
    }

    //make it a class later
    private function getUniqueRule()
    {
        request()->validate([
            'field' => 'required',
            't' => 'required'
        ]);

        if (request('id')) {
            return vsprintf('unique:%s,%s,%s', [$this->getTable(), request('field'), request('id')]);
        }

        return vsprintf('unique:%s,%s', [$this->getTable(), request('field')]);
    }

}
