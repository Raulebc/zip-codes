<?php

namespace App\Models;

class ZipCodeImport
{
    /**  Number positions of the headers */
    public const ZIP_CODE = 0;
    public const SETTLEMENT_NAME = 1;
    public const SETTLEMENT_SETTLEMENT_TYPE = 2;
    public const MUNICIPALITY_NAME = 3;
    public const FEDERAL_ENTITY_NAME = 4;
    public const LOCALITY = 5;
    public const FEDERAL_ENTITY_KEY = 7;
    public const MUNICIPALITY_KEY = 11;
    public const SETTLEMENT_KEY = 12;
    public const SETTLEMENT_ZONE_TYPE = 13;

    public function headers(): array
    {
        return [
            self::ZIP_CODE => 'd_codigo',
            self::SETTLEMENT_NAME => 'd_asenta',
            self::SETTLEMENT_SETTLEMENT_TYPE => 'd_tipo_asenta',
            self::MUNICIPALITY_NAME => 'D_mnpio',
            self::FEDERAL_ENTITY_NAME => 'd_estado',
            self::LOCALITY => 'd_ciudad',
            // self:: => 'd_CP',
            self::FEDERAL_ENTITY_KEY => 'c_estado',
            // self:: => 'c_oficina',
            // self:: => 'c_CP',
            // self:: => 'c_tipo_asenta',
            self::MUNICIPALITY_KEY => 'c_mnpio',
            self::SETTLEMENT_KEY => 'id_asenta_cpcons',
            self::SETTLEMENT_ZONE_TYPE => 'd_zona',
            // self:: => 'c_cve_ciudad',
        ];
    }
}
