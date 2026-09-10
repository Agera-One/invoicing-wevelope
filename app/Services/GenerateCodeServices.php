<?php

namespace App\Services;

class GenerateCodeServices
{
    public function generate($model, $column, $prefix)
    {
        $year = date('Y');

        $last = $model::select($column)
            ->where($column, 'like', "{$prefix}-{$year}-%")
            ->latest('id')
            ->first();

        if ($last) {
            $number = (int) substr($last, -4) + 1;
        } else {
            $number = 1;
        }

        return sprintf('%s-%s-%04d', $prefix, $year, $number);
    }
}
