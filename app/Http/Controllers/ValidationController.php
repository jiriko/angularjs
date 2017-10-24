<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidationController extends Controller
{
    /**
     * This will validate a field request('q')
     * based on the validation types request('type')
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

    /**
     * This will create the validation rules
     * based on request('type')
     * ex: email,required,unique
     * @return String rules
     */
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

    /**
     * This is for rules like unique, max etc
     * which requires parameters
     *
     * @return static
     */
    private function getComplexRules()
    {
        return collect(['unique'])->filter(function ($rule) {
            return in_array($rule, explode(',', request('type')));
        });
    }

    /**
     * This is for simple rules like numeric, email, require etc..
     * which do not require parameters
     * @return static
     */
    private function getSimpleRules()
    {
        return collect(explode(',', request('type')))->filter(function ($rule) {
            return !in_array($rule, $this->getComplexRules()->all());
        });
    }

    /**
     * Look up for the table currently used for unique rule
     * by request('t')
     *
     * @return mixed
     */
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

    /**
     * The basic fields are required: request('type') ex: email,required
     * and request('q) is the value of the field to be validated.
     *
     */
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
