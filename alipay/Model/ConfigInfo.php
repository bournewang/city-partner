<?php
/**
 * ConfigInfo
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
 * ConfigInfo Class Doc Comment
 *
 * @category Class
 * @package  Alipay\OpenAPISDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class ConfigInfo implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ConfigInfo';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'attachmentExplain' => '\Alipay\OpenAPISDK\Model\AttachmentExplain',
        'collectAttachement' => 'bool',
        'collectCertTypes' => 'string[]',
        'companyNo' => 'string',
        'contractValidity' => 'int',
        'jumpUrl' => 'string',
        'merchantMiniSignUrl' => 'string',
        'noticeDeveloperUrl' => 'string',
        'platformOrderNo' => 'string',
        'serialNo' => 'string',
        'signModel' => 'int'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'attachmentExplain' => null,
        'collectAttachement' => null,
        'collectCertTypes' => null,
        'companyNo' => null,
        'contractValidity' => null,
        'jumpUrl' => null,
        'merchantMiniSignUrl' => null,
        'noticeDeveloperUrl' => null,
        'platformOrderNo' => null,
        'serialNo' => null,
        'signModel' => null
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
        'attachmentExplain' => 'attachment_explain',
        'collectAttachement' => 'collect_attachement',
        'collectCertTypes' => 'collect_cert_types',
        'companyNo' => 'company_no',
        'contractValidity' => 'contract_validity',
        'jumpUrl' => 'jump_url',
        'merchantMiniSignUrl' => 'merchant_mini_sign_url',
        'noticeDeveloperUrl' => 'notice_developer_url',
        'platformOrderNo' => 'platform_order_no',
        'serialNo' => 'serial_no',
        'signModel' => 'sign_model'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'attachmentExplain' => 'setAttachmentExplain',
        'collectAttachement' => 'setCollectAttachement',
        'collectCertTypes' => 'setCollectCertTypes',
        'companyNo' => 'setCompanyNo',
        'contractValidity' => 'setContractValidity',
        'jumpUrl' => 'setJumpUrl',
        'merchantMiniSignUrl' => 'setMerchantMiniSignUrl',
        'noticeDeveloperUrl' => 'setNoticeDeveloperUrl',
        'platformOrderNo' => 'setPlatformOrderNo',
        'serialNo' => 'setSerialNo',
        'signModel' => 'setSignModel'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'attachmentExplain' => 'getAttachmentExplain',
        'collectAttachement' => 'getCollectAttachement',
        'collectCertTypes' => 'getCollectCertTypes',
        'companyNo' => 'getCompanyNo',
        'contractValidity' => 'getContractValidity',
        'jumpUrl' => 'getJumpUrl',
        'merchantMiniSignUrl' => 'getMerchantMiniSignUrl',
        'noticeDeveloperUrl' => 'getNoticeDeveloperUrl',
        'platformOrderNo' => 'getPlatformOrderNo',
        'serialNo' => 'getSerialNo',
        'signModel' => 'getSignModel'
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
        $this->container['attachmentExplain'] = $data['attachmentExplain'] ?? null;
        $this->container['collectAttachement'] = $data['collectAttachement'] ?? null;
        $this->container['collectCertTypes'] = $data['collectCertTypes'] ?? null;
        $this->container['companyNo'] = $data['companyNo'] ?? null;
        $this->container['contractValidity'] = $data['contractValidity'] ?? null;
        $this->container['jumpUrl'] = $data['jumpUrl'] ?? null;
        $this->container['merchantMiniSignUrl'] = $data['merchantMiniSignUrl'] ?? null;
        $this->container['noticeDeveloperUrl'] = $data['noticeDeveloperUrl'] ?? null;
        $this->container['platformOrderNo'] = $data['platformOrderNo'] ?? null;
        $this->container['serialNo'] = $data['serialNo'] ?? null;
        $this->container['signModel'] = $data['signModel'] ?? null;
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
     * Gets attachmentExplain
     *
     * @return \Alipay\OpenAPISDK\Model\AttachmentExplain|null
     */
    public function getAttachmentExplain()
    {
        return $this->container['attachmentExplain'];
    }

    /**
     * Sets attachmentExplain
     *
     * @param \Alipay\OpenAPISDK\Model\AttachmentExplain|null $attachmentExplain attachmentExplain
     *
     * @return self
     */
    public function setAttachmentExplain($attachmentExplain)
    {
        $this->container['attachmentExplain'] = $attachmentExplain;

        return $this;
    }

    /**
     * Gets collectAttachement
     *
     * @return bool|null
     */
    public function getCollectAttachement()
    {
        return $this->container['collectAttachement'];
    }

    /**
     * Sets collectAttachement
     *
     * @param bool|null $collectAttachement 是否收集附件
     *
     * @return self
     */
    public function setCollectAttachement($collectAttachement)
    {
        $this->container['collectAttachement'] = $collectAttachement;

        return $this;
    }

    /**
     * Gets collectCertTypes
     *
     * @return string[]|null
     */
    public function getCollectCertTypes()
    {
        return $this->container['collectCertTypes'];
    }

    /**
     * Sets collectCertTypes
     *
     * @param string[]|null $collectCertTypes 收集证件类型列表
     *
     * @return self
     */
    public function setCollectCertTypes($collectCertTypes)
    {
        $this->container['collectCertTypes'] = $collectCertTypes;

        return $this;
    }

    /**
     * Gets companyNo
     *
     * @return string|null
     */
    public function getCompanyNo()
    {
        return $this->container['companyNo'];
    }

    /**
     * Sets companyNo
     *
     * @param string|null $companyNo 公司编号-SF
     *
     * @return self
     */
    public function setCompanyNo($companyNo)
    {
        $this->container['companyNo'] = $companyNo;

        return $this;
    }

    /**
     * Gets contractValidity
     *
     * @return int|null
     */
    public function getContractValidity()
    {
        return $this->container['contractValidity'];
    }

    /**
     * Sets contractValidity
     *
     * @param int|null $contractValidity 文档过期时间
     *
     * @return self
     */
    public function setContractValidity($contractValidity)
    {
        $this->container['contractValidity'] = $contractValidity;

        return $this;
    }

    /**
     * Gets jumpUrl
     *
     * @return string|null
     */
    public function getJumpUrl()
    {
        return $this->container['jumpUrl'];
    }

    /**
     * Sets jumpUrl
     *
     * @param string|null $jumpUrl 支付宝小程序跳转
     *
     * @return self
     */
    public function setJumpUrl($jumpUrl)
    {
        $this->container['jumpUrl'] = $jumpUrl;

        return $this;
    }

    /**
     * Gets merchantMiniSignUrl
     *
     * @return string|null
     */
    public function getMerchantMiniSignUrl()
    {
        return $this->container['merchantMiniSignUrl'];
    }

    /**
     * Sets merchantMiniSignUrl
     *
     * @param string|null $merchantMiniSignUrl 商户小程序签署地址（signModel字段值为1时 必填）
     *
     * @return self
     */
    public function setMerchantMiniSignUrl($merchantMiniSignUrl)
    {
        $this->container['merchantMiniSignUrl'] = $merchantMiniSignUrl;

        return $this;
    }

    /**
     * Gets noticeDeveloperUrl
     *
     * @return string|null
     */
    public function getNoticeDeveloperUrl()
    {
        return $this->container['noticeDeveloperUrl'];
    }

    /**
     * Sets noticeDeveloperUrl
     *
     * @param string|null $noticeDeveloperUrl 回调地址，签署的过程和签署完成都会回调。
     *
     * @return self
     */
    public function setNoticeDeveloperUrl($noticeDeveloperUrl)
    {
        $this->container['noticeDeveloperUrl'] = $noticeDeveloperUrl;

        return $this;
    }

    /**
     * Gets platformOrderNo
     *
     * @return string|null
     */
    public function getPlatformOrderNo()
    {
        return $this->container['platformOrderNo'];
    }

    /**
     * Sets platformOrderNo
     *
     * @param string|null $platformOrderNo 平台订单号
     *
     * @return self
     */
    public function setPlatformOrderNo($platformOrderNo)
    {
        $this->container['platformOrderNo'] = $platformOrderNo;

        return $this;
    }

    /**
     * Gets serialNo
     *
     * @return string|null
     */
    public function getSerialNo()
    {
        return $this->container['serialNo'];
    }

    /**
     * Sets serialNo
     *
     * @param string|null $serialNo 物流单号
     *
     * @return self
     */
    public function setSerialNo($serialNo)
    {
        $this->container['serialNo'] = $serialNo;

        return $this;
    }

    /**
     * Gets signModel
     *
     * @return int|null
     */
    public function getSignModel()
    {
        return $this->container['signModel'];
    }

    /**
     * Sets signModel
     *
     * @param int|null $signModel 签署方式  0-e签宝小程序签署 1-商户小程序签署  默认0
     *
     * @return self
     */
    public function setSignModel($signModel)
    {
        $this->container['signModel'] = $signModel;

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

