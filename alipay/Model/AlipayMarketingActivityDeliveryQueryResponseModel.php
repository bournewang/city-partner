<?php
/**
 * AlipayMarketingActivityDeliveryQueryResponseModel
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  Alipay\OpenAPISDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * 支付宝开放平台API
 *
 * 支付宝开放平台v3协议文档
 *
 * The version of the OpenAPI document: 2024-10-16
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.2.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Alipay\OpenAPISDK\Model;

use \ArrayAccess;
use \Alipay\OpenAPISDK\ObjectSerializer;

/**
 * AlipayMarketingActivityDeliveryQueryResponseModel Class Doc Comment
 *
 * @category Class
 * @package  Alipay\OpenAPISDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class AlipayMarketingActivityDeliveryQueryResponseModel implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'AlipayMarketingActivityDeliveryQueryResponseModel';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'deliveryBaseInfo' => '\Alipay\OpenAPISDK\Model\DeliveryBaseInfo',
        'deliveryBoothCode' => 'string',
        'deliveryErrorMsg' => 'string',
        'deliveryId' => 'string',
        'deliveryInfoList' => '\Alipay\OpenAPISDK\Model\PromoDeliveryInfo[]',
        'deliveryPlayConfig' => '\Alipay\OpenAPISDK\Model\DeliveryPlayConfig',
        'deliveryStatus' => 'string',
        'deliveryTargetRule' => '\Alipay\OpenAPISDK\Model\DeliveryTargetRule'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'deliveryBaseInfo' => null,
        'deliveryBoothCode' => null,
        'deliveryErrorMsg' => null,
        'deliveryId' => null,
        'deliveryInfoList' => null,
        'deliveryPlayConfig' => null,
        'deliveryStatus' => null,
        'deliveryTargetRule' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'deliveryBaseInfo' => 'delivery_base_info',
        'deliveryBoothCode' => 'delivery_booth_code',
        'deliveryErrorMsg' => 'delivery_error_msg',
        'deliveryId' => 'delivery_id',
        'deliveryInfoList' => 'delivery_info_list',
        'deliveryPlayConfig' => 'delivery_play_config',
        'deliveryStatus' => 'delivery_status',
        'deliveryTargetRule' => 'delivery_target_rule'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'deliveryBaseInfo' => 'setDeliveryBaseInfo',
        'deliveryBoothCode' => 'setDeliveryBoothCode',
        'deliveryErrorMsg' => 'setDeliveryErrorMsg',
        'deliveryId' => 'setDeliveryId',
        'deliveryInfoList' => 'setDeliveryInfoList',
        'deliveryPlayConfig' => 'setDeliveryPlayConfig',
        'deliveryStatus' => 'setDeliveryStatus',
        'deliveryTargetRule' => 'setDeliveryTargetRule'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'deliveryBaseInfo' => 'getDeliveryBaseInfo',
        'deliveryBoothCode' => 'getDeliveryBoothCode',
        'deliveryErrorMsg' => 'getDeliveryErrorMsg',
        'deliveryId' => 'getDeliveryId',
        'deliveryInfoList' => 'getDeliveryInfoList',
        'deliveryPlayConfig' => 'getDeliveryPlayConfig',
        'deliveryStatus' => 'getDeliveryStatus',
        'deliveryTargetRule' => 'getDeliveryTargetRule'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['deliveryBaseInfo'] = $data['deliveryBaseInfo'] ?? null;
        $this->container['deliveryBoothCode'] = $data['deliveryBoothCode'] ?? null;
        $this->container['deliveryErrorMsg'] = $data['deliveryErrorMsg'] ?? null;
        $this->container['deliveryId'] = $data['deliveryId'] ?? null;
        $this->container['deliveryInfoList'] = $data['deliveryInfoList'] ?? null;
        $this->container['deliveryPlayConfig'] = $data['deliveryPlayConfig'] ?? null;
        $this->container['deliveryStatus'] = $data['deliveryStatus'] ?? null;
        $this->container['deliveryTargetRule'] = $data['deliveryTargetRule'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets deliveryBaseInfo
     *
     * @return \Alipay\OpenAPISDK\Model\DeliveryBaseInfo|null
     */
    public function getDeliveryBaseInfo()
    {
        return $this->container['deliveryBaseInfo'];
    }

    /**
     * Sets deliveryBaseInfo
     *
     * @param \Alipay\OpenAPISDK\Model\DeliveryBaseInfo|null $deliveryBaseInfo deliveryBaseInfo
     *
     * @return self
     */
    public function setDeliveryBaseInfo($deliveryBaseInfo)
    {
        $this->container['deliveryBaseInfo'] = $deliveryBaseInfo;

        return $this;
    }

    /**
     * Gets deliveryBoothCode
     *
     * @return string|null
     */
    public function getDeliveryBoothCode()
    {
        return $this->container['deliveryBoothCode'];
    }

    /**
     * Sets deliveryBoothCode
     *
     * @param string|null $deliveryBoothCode 运营计划的展位编码。 枚举值： SERVICE_MESSAGE：商家消息（包含订单、订阅、其他消息）
     *
     * @return self
     */
    public function setDeliveryBoothCode($deliveryBoothCode)
    {
        $this->container['deliveryBoothCode'] = $deliveryBoothCode;

        return $this;
    }

    /**
     * Gets deliveryErrorMsg
     *
     * @return string|null
     */
    public function getDeliveryErrorMsg()
    {
        return $this->container['deliveryErrorMsg'];
    }

    /**
     * Sets deliveryErrorMsg
     *
     * @param string|null $deliveryErrorMsg 投放计划错误信息描述，如投放计划审核失败时为审核失败原因。
     *
     * @return self
     */
    public function setDeliveryErrorMsg($deliveryErrorMsg)
    {
        $this->container['deliveryErrorMsg'] = $deliveryErrorMsg;

        return $this;
    }

    /**
     * Gets deliveryId
     *
     * @return string|null
     */
    public function getDeliveryId()
    {
        return $this->container['deliveryId'];
    }

    /**
     * Sets deliveryId
     *
     * @param string|null $deliveryId 投放计划id
     *
     * @return self
     */
    public function setDeliveryId($deliveryId)
    {
        $this->container['deliveryId'] = $deliveryId;

        return $this;
    }

    /**
     * Gets deliveryInfoList
     *
     * @return \Alipay\OpenAPISDK\Model\PromoDeliveryInfo[]|null
     */
    public function getDeliveryInfoList()
    {
        return $this->container['deliveryInfoList'];
    }

    /**
     * Sets deliveryInfoList
     *
     * @param \Alipay\OpenAPISDK\Model\PromoDeliveryInfo[]|null $deliveryInfoList \"[已废弃] 投放信息列表\"
     *
     * @return self
     */
    public function setDeliveryInfoList($deliveryInfoList)
    {
        $this->container['deliveryInfoList'] = $deliveryInfoList;

        return $this;
    }

    /**
     * Gets deliveryPlayConfig
     *
     * @return \Alipay\OpenAPISDK\Model\DeliveryPlayConfig|null
     */
    public function getDeliveryPlayConfig()
    {
        return $this->container['deliveryPlayConfig'];
    }

    /**
     * Sets deliveryPlayConfig
     *
     * @param \Alipay\OpenAPISDK\Model\DeliveryPlayConfig|null $deliveryPlayConfig deliveryPlayConfig
     *
     * @return self
     */
    public function setDeliveryPlayConfig($deliveryPlayConfig)
    {
        $this->container['deliveryPlayConfig'] = $deliveryPlayConfig;

        return $this;
    }

    /**
     * Gets deliveryStatus
     *
     * @return string|null
     */
    public function getDeliveryStatus()
    {
        return $this->container['deliveryStatus'];
    }

    /**
     * Sets deliveryStatus
     *
     * @param string|null $deliveryStatus 投放计划状态。
     *
     * @return self
     */
    public function setDeliveryStatus($deliveryStatus)
    {
        $this->container['deliveryStatus'] = $deliveryStatus;

        return $this;
    }

    /**
     * Gets deliveryTargetRule
     *
     * @return \Alipay\OpenAPISDK\Model\DeliveryTargetRule|null
     */
    public function getDeliveryTargetRule()
    {
        return $this->container['deliveryTargetRule'];
    }

    /**
     * Sets deliveryTargetRule
     *
     * @param \Alipay\OpenAPISDK\Model\DeliveryTargetRule|null $deliveryTargetRule deliveryTargetRule
     *
     * @return self
     */
    public function setDeliveryTargetRule($deliveryTargetRule)
    {
        $this->container['deliveryTargetRule'] = $deliveryTargetRule;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}

