# Selling Partner Amazon

Selling Partner Amazon Library is a set of classes that provides developers with a way to connect to the Amazon Selling Partner API. This library allows developers to access and manage their Amazon seller accounts, retrieve and update product information, fulfill orders, and more. The library is designed to be easy to use and includes methods for handling common tasks such as authenticating with the API, making HTTP requests, and handling errors. It is a valuable tool for anyone looking to build applications or integrations with the Amazon Selling Partner API.

## Installation

Use the package manager [composer](https://getcomposer.org/) to install Amazon Selling Partner.

```bash
composer require bramatom/selling-partner-amazon
```

## Usage
### AmazonMarketplace
The AmazonMarketPlace class represents an Amazon marketplace.

The class constructor accepts a marketplace ID as a parameter and uses the AmazonMarketplaceData::getById method to retrieve the marketplace data from the database. If the data is found, the class fields are set with the retrieved data, otherwise the error field is set to true.

The class includes the following public methods:

- getId: returns the ID of the marketplace
- getName: returns the name of the marketplace
- getZone: returns the zone of the marketplace
- getEndpoint: returns the endpoint of the marketplace

```php
$marketplace = new AmazonMarketPlace(AmazonMarketplaceId::NORTH_AMERICA);

if ($marketplace->error) {
    // handle error
} else {
    echo 'ID: ' . $marketplace->getId() . "\n";
    echo 'Name: ' . $marketplace->getName() . "\n";
    echo 'Zone: ' . $marketplace->getZone() . "\n";
    echo 'Endpoint: ' . $marketplace->getEndpoint() . "\n";
}

```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)