<?php

namespace App\Http\Controllers;

use App\Models\ZipCode;
use App\Models\ZipCodeImport;
use Illuminate\Http\Request;

class ZipCodeImportController extends Controller
{
    /**
     *  Path file.
     *
     *  @var  string
     */
    private $path = 'database/imports/zip_codes.csv';

    /**
     *  Import zip codes.
     *
     *  @return  string
     */
    public function store()
    {
        $arrayedValues = $this->convertCSVIntoArray($this->path);

        $this->uploadZipCodes($arrayedValues);

        return 'Finished.';
    }

    /**
     *  Convert CSV into array.
     *
     *  @param   string|File   $csvFile
     *
     *  @return  array
     */
    public function convertCSVIntoArray($csvFile)
    {
        // read the file
        $csvFile = fopen($csvFile, "r");

        $lines = array();

        // fgetcsv gets a line from a file pointer and analyzes it for CSV fields
        while (!feof($csvFile) && ($line = fgetcsv($csvFile)) !== false) {
            $lines[] = $line;
        }

        fclose($csvFile);

        return $lines;
    }

    /**
     *  Upload the zip_codes into the database.
     *
     *  @param   array   $zip_codes
     *
     *  @return  array
     */
    public function uploadZipCodes($zip_codes)
    {
        array_shift($zip_codes); # remove the header

        foreach ($zip_codes as $zip_code) {
            if (
                $zip_code_exists = ZipCode::find($zip_code[ZipCodeImport::ZIP_CODE])
            ) {
                $zip_code_exists->update([
                    'settlements' => array_merge(
                        $zip_code_exists->settlements,
                        [
                            [
                                'key'             => (int) $zip_code[ZipCodeImport::SETTLEMENT_KEY],
                                'name'            => strtoupper($this->replaceSpecialCharacters($zip_code[ZipCodeImport::SETTLEMENT_NAME])),
                                'zone_type'       => strtoupper($this->replaceSpecialCharacters($zip_code[ZipCodeImport::SETTLEMENT_ZONE_TYPE])),
                                'settlement_type' => [
                                    'name' => $this->replaceSpecialCharacters($zip_code[ZipCodeImport::SETTLEMENT_SETTLEMENT_TYPE]),
                                ]
                            ]
                        ]
                    )
                ]);
            } else {
                ZipCode::create([
                    'id'       => $zip_code[ZipCodeImport::ZIP_CODE],
                    'locality' => strtoupper($this->replaceSpecialCharacters($zip_code[ZipCodeImport::LOCALITY])),
                    'federal_entity' => [
                        'key'  => (int) $zip_code[ZipCodeImport::FEDERAL_ENTITY_KEY],
                        'name' => strtoupper($this->replaceSpecialCharacters($zip_code[ZipCodeImport::FEDERAL_ENTITY_NAME])),
                        'code' => null,
                    ],
                    'settlements' => [
                        [
                            'key'             => (int) $zip_code[ZipCodeImport::SETTLEMENT_KEY],
                            'name'            => strtoupper($this->replaceSpecialCharacters($zip_code[ZipCodeImport::SETTLEMENT_NAME])),
                            'zone_type'       => strtoupper($this->replaceSpecialCharacters($zip_code[ZipCodeImport::SETTLEMENT_ZONE_TYPE])),
                            'settlement_type' => [
                                'name' => $this->replaceSpecialCharacters($zip_code[ZipCodeImport::SETTLEMENT_SETTLEMENT_TYPE]),
                            ]
                        ]
                    ],
                    'municipality' => [
                        'key'  => (int) $zip_code[ZipCodeImport::MUNICIPALITY_KEY],
                        'name' => strtoupper($this->replaceSpecialCharacters($zip_code[ZipCodeImport::MUNICIPALITY_NAME])),
                    ]
                ]);
            }
        }
    }

    /**
     *  We replace all the special characters with a valid character.
     *
     *  @param   string  $text
     *
     *  @return  string
     */
    public function replaceSpecialCharacters($text)
    {
        $text = utf8_encode($text);

        return str_replace(
            array('á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', 'ü', 'Ü', 'ñ', 'Ñ'),
            array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'u', 'U', 'n', 'N'),
            $text
        );
    }
}
