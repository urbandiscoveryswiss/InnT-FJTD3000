# Swagger\Client\OfferApi

All URIs are relative to *http://urbandiscover.ch/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**addOffer**](OfferApi.md#addOffer) | **POST** /offer | Add a new offer
[**deleteOffer**](OfferApi.md#deleteOffer) | **DELETE** /offer/{offerId} | Deletes a offer
[**findOffersByUser**](OfferApi.md#findOffersByUser) | **GET** /offer/findByUser | Finds Offer by user
[**getOfferById**](OfferApi.md#getOfferById) | **GET** /offer/{offerId} | Find offer by ID


# **addOffer**
> addOffer($body)

Add a new offer



### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OfferApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$body = new \Swagger\Client\Model\Offer(); // \Swagger\Client\Model\Offer | Offer object that needs to be added

try {
    $apiInstance->addOffer($body);
} catch (Exception $e) {
    echo 'Exception when calling OfferApi->addOffer: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\Swagger\Client\Model\Offer**](../Model/Offer.md)| Offer object that needs to be added |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json, application/xml
 - **Accept**: application/xml, application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteOffer**
> deleteOffer($offer_id, $api_key)

Deletes a offer



### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OfferApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$offer_id = 789; // int | Offer id to delete
$api_key = "api_key_example"; // string | 

try {
    $apiInstance->deleteOffer($offer_id, $api_key);
} catch (Exception $e) {
    echo 'Exception when calling OfferApi->deleteOffer: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **offer_id** | **int**| Offer id to delete |
 **api_key** | **string**|  | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/xml, application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **findOffersByUser**
> \Swagger\Client\Model\Offer[] findOffersByUser($userid)

Finds Offer by user

Multiple status values can be provided with comma separated strings

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new Swagger\Client\Api\OfferApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$userid = 789; // int | Status values that need to be considered for filter

try {
    $result = $apiInstance->findOffersByUser($userid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OfferApi->findOffersByUser: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userid** | **int**| Status values that need to be considered for filter |

### Return type

[**\Swagger\Client\Model\Offer[]**](../Model/Offer.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/xml, application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getOfferById**
> \Swagger\Client\Model\Offer getOfferById($offer_id)

Find offer by ID

Returns a single offer

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$apiInstance = new Swagger\Client\Api\OfferApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$offer_id = 789; // int | ID of the offer to return

try {
    $result = $apiInstance->getOfferById($offer_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OfferApi->getOfferById: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **offer_id** | **int**| ID of the offer to return |

### Return type

[**\Swagger\Client\Model\Offer**](../Model/Offer.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/xml, application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

