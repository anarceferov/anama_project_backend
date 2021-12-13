<?php

namespace App\Traits;

use Illuminate\Validation\ValidationException;
use Nette\Utils\Validators;
use Validator;


trait Paginatable
{
    /**
     * @var int
     */
    private $pageSizeLimit = 100;

    /**
     * @return mixed
     * @throws ValidationException
     */
    public function getPerPage()
    {
        $pageSize = $this->perPage;
        if (app('request')->has('per_page')) {
            $validator = Validator::make(
                [
                    'per_page' => app('request')->get('per_page')
                ],
                [
                    'per_page' => 'integer'
                ]
            );
            if ($validator->fails())
                throw new ValidationException($validator);
            $pageSize = app('request')->get('per_page');
        }
        return min($pageSize, $this->pageSizeLimit);
    }

}