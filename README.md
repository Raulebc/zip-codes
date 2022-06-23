<p align="center">Zip Codes API</p>

## About ZipCode API

Zip Codes API is a simple API that allows you to search for a zip code and gets its information.

## How to consume it

To search for a zip code, you need to send a GET request to the following URL:
[https://agile-brushlands-20346.herokuapp.com/api/zip-codes/01000](https://agile-brushlands-20346.herokuapp.com/api/zip-codes/01000)

The request must contain a query parameter called <code>zip_code</code> with the zip code you want to search.

The response will be a JSON object with the following structure:

## Example

```Json
{
    "zip_code": "01000",
    "locality": "CIUDAD DE MEXICO",
    "federal_entity": {
        "key": 9,
        "code": null,
        "name": "CIUDAD DE MEXICO"
    },
    "settlements": [
    {
        "key": 1,
        "name": "SAN ANGEL",
        "zone_type": "URBANO",
        "settlement_type": {
            "name": "Colonia"
        }
    }
    ],
    "municipality": {
        "key": 10,
        "name": "ALVARO OBREGON"
    }
}
```
