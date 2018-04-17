<?php

namespace Modules\Users\Helpers;

class UsersFilter
{
    public static function filter($query, $filters)
    {
        if (!empty($filters)) {
            foreach (array_except($filters, ['filter']) as $filter => $values) {
                if (is_numeric($filter) && !is_array($values)) {
                    $filter = $values;
                }

                $method = 'scope' . ucfirst($filter);

                if (method_exists(\Modules\Users\Models\User::class, $method)) {
                    $query = is_array($values) ? $query->$filter($values) : $query->$filter();
                }
            }
        }

        return $query;
    }
}
