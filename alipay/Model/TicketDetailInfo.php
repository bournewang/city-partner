<?php
/**
 * TicketDetailInfo
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
 * TicketDetailInfo Class Doc Comment
 *
 * @category Class
 * @package  Alipay\OpenAPISDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class TicketDetailInfo implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'TicketDetailInfo';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'amount' => 'string',
        'endStation' => 'string',
        'endStationName' => 'string',
        'quantity' => 'string',
        'startStation' => 'string',
        'startStationName' => 'string',
        'status' => 'string',
        'ticketPrice' => 'string',
        'ticketType' => 'string',
        'tradeNo' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'amount' => null,
        'endStation' => null,
        'endStationName' => null,
        'quantity' => null,
        'startStation' => null,
        'startStationName' => null,
        'status' => null,
        'ticketPrice' => null,
        'ticketType' => null,
        'tradeNo' => null
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
        'amount' => 'amount',
        'endStation' => 'end_station',
        'endStationName' => 'end_station_name',
        'quantity' => 'quantity',
        'startStation' => 'start_station',
        'startStationName' => 'start_station_name',
        'status' => 'status',
        'ticketPrice' => 'ticket_price',
        'ticketType' => 'ticket_type',
        'tradeNo' => 'trade_no'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'amount' => 'setAmount',
        'endStation' => 'setEndStation',
        'endStationName' => 'setEndStationName',
        'quantity' => 'setQuantity',
        'startStation' => 'setStartStation',
        'startStationName' => 'setStartStationName',
        'status' => 'setStatus',
        'ticketPrice' => 'setTicketPrice',
        'ticketType' => 'setTicketType',
        'tradeNo' => 'setTradeNo'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'amount' => 'getAmount',
        'endStation' => 'getEndStation',
        'endStationName' => 'getEndStationName',
        'quantity' => 'getQuantity',
        'startStation' => 'getStartStation',
        'startStationName' => 'getStartStationName',
        'status' => 'getStatus',
        'ticketPrice' => 'getTicketPrice',
        'ticketType' => 'getTicketType',
        'tradeNo' => 'getTradeNo'
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
        $this->container['amount'] = $data['amount'] ?? null;
        $this->container['endStation'] = $data['endStation'] ?? null;
        $this->container['endStationName'] = $data['endStationName'] ?? null;
        $this->container['quantity'] = $data['quantity'] ?? null;
        $this->container['startStation'] = $data['startStation'] ?? null;
        $this->container['startStationName'] = $data['startStationName'] ?? null;
        $this->container['status'] = $data['status'] ?? null;
        $this->container['ticketPrice'] = $data['ticketPrice'] ?? null;
        $this->container['ticketType'] = $data['ticketType'] ?? null;
        $this->container['tradeNo'] = $data['tradeNo'] ?? null;
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
     * Gets amount
     *
     * @return string|null
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     *
     * @param string|null $amount 总金额，元为单位
     *
     * @return self
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets endStation
     *
     * @return string|null
     */
    public function getEndStation()
    {
        return $this->container['endStation'];
    }

    /**
     * Sets endStation
     *
     * @param string|null $endStation 终点站编码
     *
     * @return self
     */
    public function setEndStation($endStation)
    {
        $this->container['endStation'] = $endStation;

        return $this;
    }

    /**
     * Gets endStationName
     *
     * @return string|null
     */
    public function getEndStationName()
    {
        return $this->container['endStationName'];
    }

    /**
     * Sets endStationName
     *
     * @param string|null $endStationName 终点站中文名称
     *
     * @return self
     */
    public function setEndStationName($endStationName)
    {
        $this->container['endStationName'] = $endStationName;

        return $this;
    }

    /**
     * Gets quantity
     *
     * @return string|null
     */
    public function getQuantity()
    {
        return $this->container['quantity'];
    }

    /**
     * Sets quantity
     *
     * @param string|null $quantity 票数量
     *
     * @return self
     */
    public function setQuantity($quantity)
    {
        $this->container['quantity'] = $quantity;

        return $this;
    }

    /**
     * Gets startStation
     *
     * @return string|null
     */
    public function getStartStation()
    {
        return $this->container['startStation'];
    }

    /**
     * Sets startStation
     *
     * @param string|null $startStation 起点站编码
     *
     * @return self
     */
    public function setStartStation($startStation)
    {
        $this->container['startStation'] = $startStation;

        return $this;
    }

    /**
     * Gets startStationName
     *
     * @return string|null
     */
    public function getStartStationName()
    {
        return $this->container['startStationName'];
    }

    /**
     * Sets startStationName
     *
     * @param string|null $startStationName 起点站中文名称
     *
     * @return self
     */
    public function setStartStationName($startStationName)
    {
        $this->container['startStationName'] = $startStationName;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string|null $status 订单状态
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets ticketPrice
     *
     * @return string|null
     */
    public function getTicketPrice()
    {
        return $this->container['ticketPrice'];
    }

    /**
     * Sets ticketPrice
     *
     * @param string|null $ticketPrice 单价，元为单位
     *
     * @return self
     */
    public function setTicketPrice($ticketPrice)
    {
        $this->container['ticketPrice'] = $ticketPrice;

        return $this;
    }

    /**
     * Gets ticketType
     *
     * @return string|null
     */
    public function getTicketType()
    {
        return $this->container['ticketType'];
    }

    /**
     * Sets ticketType
     *
     * @param string|null $ticketType 票类型
     *
     * @return self
     */
    public function setTicketType($ticketType)
    {
        $this->container['ticketType'] = $ticketType;

        return $this;
    }

    /**
     * Gets tradeNo
     *
     * @return string|null
     */
    public function getTradeNo()
    {
        return $this->container['tradeNo'];
    }

    /**
     * Sets tradeNo
     *
     * @param string|null $tradeNo 支付宝交易号
     *
     * @return self
     */
    public function setTradeNo($tradeNo)
    {
        $this->container['tradeNo'] = $tradeNo;

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

