<?php
/**
 * AlipayFundAuthOrderFreezeResponseModel
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
 * AlipayFundAuthOrderFreezeResponseModel Class Doc Comment
 *
 * @category Class
 * @package  Alipay\OpenAPISDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class AlipayFundAuthOrderFreezeResponseModel implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'AlipayFundAuthOrderFreezeResponseModel';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'amount' => 'string',
        'authNo' => 'string',
        'creditAmount' => 'string',
        'fundAmount' => 'string',
        'gmtTrans' => 'string',
        'operationId' => 'string',
        'outOrderNo' => 'string',
        'outRequestNo' => 'string',
        'payerLogonId' => 'string',
        'payerOpenId' => 'string',
        'payerUserId' => 'string',
        'preAuthType' => 'string',
        'status' => 'string',
        'transCurrency' => 'string'
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
        'authNo' => null,
        'creditAmount' => null,
        'fundAmount' => null,
        'gmtTrans' => null,
        'operationId' => null,
        'outOrderNo' => null,
        'outRequestNo' => null,
        'payerLogonId' => null,
        'payerOpenId' => null,
        'payerUserId' => null,
        'preAuthType' => null,
        'status' => null,
        'transCurrency' => null
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
        'authNo' => 'auth_no',
        'creditAmount' => 'credit_amount',
        'fundAmount' => 'fund_amount',
        'gmtTrans' => 'gmt_trans',
        'operationId' => 'operation_id',
        'outOrderNo' => 'out_order_no',
        'outRequestNo' => 'out_request_no',
        'payerLogonId' => 'payer_logon_id',
        'payerOpenId' => 'payer_open_id',
        'payerUserId' => 'payer_user_id',
        'preAuthType' => 'pre_auth_type',
        'status' => 'status',
        'transCurrency' => 'trans_currency'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'amount' => 'setAmount',
        'authNo' => 'setAuthNo',
        'creditAmount' => 'setCreditAmount',
        'fundAmount' => 'setFundAmount',
        'gmtTrans' => 'setGmtTrans',
        'operationId' => 'setOperationId',
        'outOrderNo' => 'setOutOrderNo',
        'outRequestNo' => 'setOutRequestNo',
        'payerLogonId' => 'setPayerLogonId',
        'payerOpenId' => 'setPayerOpenId',
        'payerUserId' => 'setPayerUserId',
        'preAuthType' => 'setPreAuthType',
        'status' => 'setStatus',
        'transCurrency' => 'setTransCurrency'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'amount' => 'getAmount',
        'authNo' => 'getAuthNo',
        'creditAmount' => 'getCreditAmount',
        'fundAmount' => 'getFundAmount',
        'gmtTrans' => 'getGmtTrans',
        'operationId' => 'getOperationId',
        'outOrderNo' => 'getOutOrderNo',
        'outRequestNo' => 'getOutRequestNo',
        'payerLogonId' => 'getPayerLogonId',
        'payerOpenId' => 'getPayerOpenId',
        'payerUserId' => 'getPayerUserId',
        'preAuthType' => 'getPreAuthType',
        'status' => 'getStatus',
        'transCurrency' => 'getTransCurrency'
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
        $this->container['authNo'] = $data['authNo'] ?? null;
        $this->container['creditAmount'] = $data['creditAmount'] ?? null;
        $this->container['fundAmount'] = $data['fundAmount'] ?? null;
        $this->container['gmtTrans'] = $data['gmtTrans'] ?? null;
        $this->container['operationId'] = $data['operationId'] ?? null;
        $this->container['outOrderNo'] = $data['outOrderNo'] ?? null;
        $this->container['outRequestNo'] = $data['outRequestNo'] ?? null;
        $this->container['payerLogonId'] = $data['payerLogonId'] ?? null;
        $this->container['payerOpenId'] = $data['payerOpenId'] ?? null;
        $this->container['payerUserId'] = $data['payerUserId'] ?? null;
        $this->container['preAuthType'] = $data['preAuthType'] ?? null;
        $this->container['status'] = $data['status'] ?? null;
        $this->container['transCurrency'] = $data['transCurrency'] ?? null;
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
     * @param string|null $amount 本次操作冻结的金额，单位为：元（人民币），精确到小数点后两位
     *
     * @return self
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets authNo
     *
     * @return string|null
     */
    public function getAuthNo()
    {
        return $this->container['authNo'];
    }

    /**
     * Sets authNo
     *
     * @param string|null $authNo 支付宝的资金授权订单号
     *
     * @return self
     */
    public function setAuthNo($authNo)
    {
        $this->container['authNo'] = $authNo;

        return $this;
    }

    /**
     * Gets creditAmount
     *
     * @return string|null
     */
    public function getCreditAmount()
    {
        return $this->container['creditAmount'];
    }

    /**
     * Sets creditAmount
     *
     * @param string|null $creditAmount 本次冻结操作中信用冻结金额，单位为：元（人民币），精确到小数点后两位
     *
     * @return self
     */
    public function setCreditAmount($creditAmount)
    {
        $this->container['creditAmount'] = $creditAmount;

        return $this;
    }

    /**
     * Gets fundAmount
     *
     * @return string|null
     */
    public function getFundAmount()
    {
        return $this->container['fundAmount'];
    }

    /**
     * Sets fundAmount
     *
     * @param string|null $fundAmount 本次冻结操作中自有资金冻结金额，单位为：元（人民币），精确到小数点后两位
     *
     * @return self
     */
    public function setFundAmount($fundAmount)
    {
        $this->container['fundAmount'] = $fundAmount;

        return $this;
    }

    /**
     * Gets gmtTrans
     *
     * @return string|null
     */
    public function getGmtTrans()
    {
        return $this->container['gmtTrans'];
    }

    /**
     * Sets gmtTrans
     *
     * @param string|null $gmtTrans 资金授权成功时间  格式：YYYY-MM-DD HH:MM:SS
     *
     * @return self
     */
    public function setGmtTrans($gmtTrans)
    {
        $this->container['gmtTrans'] = $gmtTrans;

        return $this;
    }

    /**
     * Gets operationId
     *
     * @return string|null
     */
    public function getOperationId()
    {
        return $this->container['operationId'];
    }

    /**
     * Sets operationId
     *
     * @param string|null $operationId 支付宝的资金操作流水号
     *
     * @return self
     */
    public function setOperationId($operationId)
    {
        $this->container['operationId'] = $operationId;

        return $this;
    }

    /**
     * Gets outOrderNo
     *
     * @return string|null
     */
    public function getOutOrderNo()
    {
        return $this->container['outOrderNo'];
    }

    /**
     * Sets outOrderNo
     *
     * @param string|null $outOrderNo 商户的授权资金订单号
     *
     * @return self
     */
    public function setOutOrderNo($outOrderNo)
    {
        $this->container['outOrderNo'] = $outOrderNo;

        return $this;
    }

    /**
     * Gets outRequestNo
     *
     * @return string|null
     */
    public function getOutRequestNo()
    {
        return $this->container['outRequestNo'];
    }

    /**
     * Sets outRequestNo
     *
     * @param string|null $outRequestNo 商户本次资金操作的请求流水号
     *
     * @return self
     */
    public function setOutRequestNo($outRequestNo)
    {
        $this->container['outRequestNo'] = $outRequestNo;

        return $this;
    }

    /**
     * Gets payerLogonId
     *
     * @return string|null
     */
    public function getPayerLogonId()
    {
        return $this->container['payerLogonId'];
    }

    /**
     * Sets payerLogonId
     *
     * @param string|null $payerLogonId 付款方支付宝账号（Email或手机号）
     *
     * @return self
     */
    public function setPayerLogonId($payerLogonId)
    {
        $this->container['payerLogonId'] = $payerLogonId;

        return $this;
    }

    /**
     * Gets payerOpenId
     *
     * @return string|null
     */
    public function getPayerOpenId()
    {
        return $this->container['payerOpenId'];
    }

    /**
     * Sets payerOpenId
     *
     * @param string|null $payerOpenId 支付宝openId，用户（userId）在应用（appId）下的唯一用户标识。
     *
     * @return self
     */
    public function setPayerOpenId($payerOpenId)
    {
        $this->container['payerOpenId'] = $payerOpenId;

        return $this;
    }

    /**
     * Gets payerUserId
     *
     * @return string|null
     */
    public function getPayerUserId()
    {
        return $this->container['payerUserId'];
    }

    /**
     * Sets payerUserId
     *
     * @param string|null $payerUserId 付款方支付宝用户号
     *
     * @return self
     */
    public function setPayerUserId($payerUserId)
    {
        $this->container['payerUserId'] = $payerUserId;

        return $this;
    }

    /**
     * Gets preAuthType
     *
     * @return string|null
     */
    public function getPreAuthType()
    {
        return $this->container['preAuthType'];
    }

    /**
     * Sets preAuthType
     *
     * @param string|null $preAuthType 预授权类型，目前支持 CREDIT_AUTH(信用预授权);  商户可根据该标识来判断该笔预授权的类型，当返回值为\"CREDIT_AUTH\"表明该笔预授权为信用预授权，没有真实冻结资金；当返回值为空或者不为\"CREDIT_AUTH\"则表明该笔预授权为普通资金预授权，会冻结用户资金。
     *
     * @return self
     */
    public function setPreAuthType($preAuthType)
    {
        $this->container['preAuthType'] = $preAuthType;

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
     * @param string|null $status 资金预授权明细的状态  目前支持：    INIT：初始  SUCCESS: 成功  CLOSED：关闭
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets transCurrency
     *
     * @return string|null
     */
    public function getTransCurrency()
    {
        return $this->container['transCurrency'];
    }

    /**
     * Sets transCurrency
     *
     * @param string|null $transCurrency 标价币种,  amount 对应的币种单位。支持澳元：AUD, 新西兰元：NZD, 台币：TWD, 美元：USD, 欧元：EUR, 英镑：GBP
     *
     * @return self
     */
    public function setTransCurrency($transCurrency)
    {
        $this->container['transCurrency'] = $transCurrency;

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

