# Lasting Power of Attorney Data Models

The lasting power of attorney (LPA) data models are a set of PHP classes that we use to represent and validate a LPA document within the Make an LPA service.

## Installation with Composer

Add the following into your composer.json, then call `composer install`.

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ministryofjustice/opg-lpa-datamodels"
        }
    ],
    "require": {
        "ministryofjustice/opg-lpa-datamodels": "^1.0.0",
    }
}
```

## Validation

The Data Models include validation method. [Validator errors responses are documented here](docs/validation.md).

## Tests

Run the test suite (using your local PHP version) with:

```
make test-local
```

## License

The Lasting Power of Attorney Attorney API Service is released under the MIT license, a copy of which can be found in [LICENSE](LICENSE).
