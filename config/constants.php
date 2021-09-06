<?php

return [
    'CUSTOM_ERRORS' => [
       'BAD_REQUEST'=>0,
       'INTERNAL_ERROR' => 500,
       'DB_ERROR' => 2002

    ],

    'ErrorExceptions' => [
        0 => "Bad request or Data not found",
        500 => "Internal server error",
        2002 => 'Database connection error',
        23000 => "Integrity constraint violation: 1451 Cannot delete or update a parent row: a foreign key constraint fails"
    ],
    'ErrorCodes' =>[
        0 => 400,
        500 => 500,
        2002 => 502,
        23000 => 500
    ],
];
