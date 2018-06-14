# Swagger\Server\Api\OfferApiInterface

All URIs are relative to *http://urbandiscover.ch/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**addOffer**](OfferApiInterface.md#addOffer) | **POST** /offer | Add a new offer
[**deleteOffer**](OfferApiInterface.md#deleteOffer) | **DELETE** /offer/{offerId} | Deletes a offer
[**findOffersByUser**](OfferApiInterface.md#findOffersByUser) | **GET** /offer/findByUser | Finds Offer by user
[**getOfferById**](OfferApiInterface.md#getOfferById) | **GET** /offer/{offerId} | Find offer by ID


## Service Declaration
```yaml
# src/Acme/MyBundle/Resources/services.yml
services:
    # ...
    acme.my_bundle.api.offer:
        class: Acme\MyBundle\Api\OfferApi
        tags:
            - { name: "swagger_server.api", api: "offer" }
    # ...
```

## **addOffer**
> addOffer($body)

Add a new offer



### Example Implementation
```php
<?php
// src/Acme/MyBundle/Api/OfferApiInterface.php

namespace Acme\MyBundle\Api;

use Swagger\Server\Api\OfferApiInterface;

class OfferApi implements OfferApiInterface
{

    // ...

    /**
     * Implementation of OfferApiInterface#addOffer
     */
    public function addOffer(Offer $body)
    {
        // Implement the operation ...
    }

    // ...
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**Swagger\Server\Model\Offer**](../Model/Offer.md)| Offer object that needs to be added |

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json, application/xml
 - **Accept**: application/xml, application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

## **deleteOffer**
> deleteOffer($offerId, $apiKey)

Deletes a offer



### Example Implementation
```php
<?php
// src/Acme/MyBundle/Api/OfferApiInterface.php

namespace Acme\MyBundle\Api;

use Swagger\Server\Api\OfferApiInterface;

class OfferApi implements OfferApiInterface
{

    // ...

    /**
     * Implementation of OfferApiInterface#deleteOffer
     */
    public function deleteOffer($offerId, $apiKey = null)
    {
        // Implement the operation ...
    }

    // ...
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **offerId** | **int**| Offer id to delete |
 **apiKey** | **string**|  | [optional]

### Return type

void (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/xml, application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

## **findOffersByUser**
> Swagger\Server\Model\Offer findOffersByUser($userid)

Finds Offer by user

Multiple status values can be provided with comma separated strings

### Example Implementation
```php
<?php
// src/Acme/MyBundle/Api/OfferApiInterface.php

namespace Acme\MyBundle\Api;

use Swagger\Server\Api\OfferApiInterface;

class OfferApi implements OfferApiInterface
{

    // ...

    /**
     * Implementation of OfferApiInterface#findOffersByUser
     */
    public function findOffersByUser($userid)
    {
        // Implement the operation ...
    }

    // ...
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **userid** | **int**| Status values that need to be considered for filter |

### Return type

[**Swagger\Server\Model\Offer**](../Model/Offer.md)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/xml, application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

## **getOfferById**
> Swagger\Server\Model\Offer getOfferById($offerId)

Find offer by ID

Returns a single offer

### Example Implementation
```php
<?php
// src/Acme/MyBundle/Api/OfferApiInterface.php

namespace Acme\MyBundle\Api;

use Swagger\Server\Api\OfferApiInterface;

class OfferApi implements OfferApiInterface
{

    /**
     * Configure API key authorization: api_key
     */
    public function setapi_key($apiKey)
    {
        // Retrieve logged in user from $apiKey ...
    }

    // ...

    /**
     * Implementation of OfferApiInterface#getOfferById
     */
    public function getOfferById($offerId)
    {
        // Implement the operation ...
    }

    // ...
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **offerId** | **int**| ID of the offer to return |

### Return type

[**Swagger\Server\Model\Offer**](../Model/Offer.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/xml, application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

