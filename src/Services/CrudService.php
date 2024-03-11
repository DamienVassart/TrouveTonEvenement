<?php

namespace App\Services;

/**
 * @Author Damien Vassart
 */
class CrudService
{
    /**
     * @param $entity
     * @param array $columns
     * @param array $row
     * @return mixed
     */
    public function setProperties($entity, array $columns, array $row): mixed
    {
        foreach ($columns as $column) {
            $camelCaseColumnName = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $column))));
            $setter = 'set' . $camelCaseColumnName . ($column === "id" ? "Unique" : "");
            $entity->{$setter}($row[$column]);
        }

        return $entity;
    }
}