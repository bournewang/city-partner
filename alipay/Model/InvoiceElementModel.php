<?php
/**
 * InvoiceElementModel
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
 * InvoiceElementModel Class Doc Comment
 *
 * @category Class
 * @package  Alipay\OpenAPISDK
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class InvoiceElementModel implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'InvoiceElementModel';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'expenseStatus' => 'string',
        'extendFields' => 'string',
        'fakeCode' => 'string',
        'hasPdfFile' => 'bool',
        'hasRisk' => 'bool',
        'invoiceAmount' => 'string',
        'invoiceCode' => 'string',
        'invoiceDate' => 'string',
        'invoiceImgUrl' => 'string',
        'invoiceKind' => 'string',
        'invoiceNo' => 'string',
        'invoiceStatus' => 'string',
        'isvContact' => 'string',
        'isvName' => 'string',
        'logoUrl' => 'string',
        'mName' => 'string',
        'outTaxAmount' => 'string',
        'payeeName' => 'string',
        'payeeTaxNo' => 'string',
        'payerName' => 'string',
        'payerTaxNo' => 'string',
        'pdfUrl' => 'string',
        'source' => 'string',
        'tradeList' => '\Alipay\OpenAPISDK\Model\EinvTrade[]',
        'tradeMatchResult' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'expenseStatus' => null,
        'extendFields' => null,
        'fakeCode' => null,
        'hasPdfFile' => null,
        'hasRisk' => null,
        'invoiceAmount' => null,
        'invoiceCode' => null,
        'invoiceDate' => null,
        'invoiceImgUrl' => null,
        'invoiceKind' => null,
        'invoiceNo' => null,
        'invoiceStatus' => null,
        'isvContact' => null,
        'isvName' => null,
        'logoUrl' => null,
        'mName' => null,
        'outTaxAmount' => null,
        'payeeName' => null,
        'payeeTaxNo' => null,
        'payerName' => null,
        'payerTaxNo' => null,
        'pdfUrl' => null,
        'source' => null,
        'tradeList' => null,
        'tradeMatchResult' => null
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
        'expenseStatus' => 'expense_status',
        'extendFields' => 'extend_fields',
        'fakeCode' => 'fake_code',
        'hasPdfFile' => 'has_pdf_file',
        'hasRisk' => 'has_risk',
        'invoiceAmount' => 'invoice_amount',
        'invoiceCode' => 'invoice_code',
        'invoiceDate' => 'invoice_date',
        'invoiceImgUrl' => 'invoice_img_url',
        'invoiceKind' => 'invoice_kind',
        'invoiceNo' => 'invoice_no',
        'invoiceStatus' => 'invoice_status',
        'isvContact' => 'isv_contact',
        'isvName' => 'isv_name',
        'logoUrl' => 'logo_url',
        'mName' => 'm_name',
        'outTaxAmount' => 'out_tax_amount',
        'payeeName' => 'payee_name',
        'payeeTaxNo' => 'payee_tax_no',
        'payerName' => 'payer_name',
        'payerTaxNo' => 'payer_tax_no',
        'pdfUrl' => 'pdf_url',
        'source' => 'source',
        'tradeList' => 'trade_list',
        'tradeMatchResult' => 'trade_match_result'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'expenseStatus' => 'setExpenseStatus',
        'extendFields' => 'setExtendFields',
        'fakeCode' => 'setFakeCode',
        'hasPdfFile' => 'setHasPdfFile',
        'hasRisk' => 'setHasRisk',
        'invoiceAmount' => 'setInvoiceAmount',
        'invoiceCode' => 'setInvoiceCode',
        'invoiceDate' => 'setInvoiceDate',
        'invoiceImgUrl' => 'setInvoiceImgUrl',
        'invoiceKind' => 'setInvoiceKind',
        'invoiceNo' => 'setInvoiceNo',
        'invoiceStatus' => 'setInvoiceStatus',
        'isvContact' => 'setIsvContact',
        'isvName' => 'setIsvName',
        'logoUrl' => 'setLogoUrl',
        'mName' => 'setMName',
        'outTaxAmount' => 'setOutTaxAmount',
        'payeeName' => 'setPayeeName',
        'payeeTaxNo' => 'setPayeeTaxNo',
        'payerName' => 'setPayerName',
        'payerTaxNo' => 'setPayerTaxNo',
        'pdfUrl' => 'setPdfUrl',
        'source' => 'setSource',
        'tradeList' => 'setTradeList',
        'tradeMatchResult' => 'setTradeMatchResult'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'expenseStatus' => 'getExpenseStatus',
        'extendFields' => 'getExtendFields',
        'fakeCode' => 'getFakeCode',
        'hasPdfFile' => 'getHasPdfFile',
        'hasRisk' => 'getHasRisk',
        'invoiceAmount' => 'getInvoiceAmount',
        'invoiceCode' => 'getInvoiceCode',
        'invoiceDate' => 'getInvoiceDate',
        'invoiceImgUrl' => 'getInvoiceImgUrl',
        'invoiceKind' => 'getInvoiceKind',
        'invoiceNo' => 'getInvoiceNo',
        'invoiceStatus' => 'getInvoiceStatus',
        'isvContact' => 'getIsvContact',
        'isvName' => 'getIsvName',
        'logoUrl' => 'getLogoUrl',
        'mName' => 'getMName',
        'outTaxAmount' => 'getOutTaxAmount',
        'payeeName' => 'getPayeeName',
        'payeeTaxNo' => 'getPayeeTaxNo',
        'payerName' => 'getPayerName',
        'payerTaxNo' => 'getPayerTaxNo',
        'pdfUrl' => 'getPdfUrl',
        'source' => 'getSource',
        'tradeList' => 'getTradeList',
        'tradeMatchResult' => 'getTradeMatchResult'
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
        $this->container['expenseStatus'] = $data['expenseStatus'] ?? null;
        $this->container['extendFields'] = $data['extendFields'] ?? null;
        $this->container['fakeCode'] = $data['fakeCode'] ?? null;
        $this->container['hasPdfFile'] = $data['hasPdfFile'] ?? null;
        $this->container['hasRisk'] = $data['hasRisk'] ?? null;
        $this->container['invoiceAmount'] = $data['invoiceAmount'] ?? null;
        $this->container['invoiceCode'] = $data['invoiceCode'] ?? null;
        $this->container['invoiceDate'] = $data['invoiceDate'] ?? null;
        $this->container['invoiceImgUrl'] = $data['invoiceImgUrl'] ?? null;
        $this->container['invoiceKind'] = $data['invoiceKind'] ?? null;
        $this->container['invoiceNo'] = $data['invoiceNo'] ?? null;
        $this->container['invoiceStatus'] = $data['invoiceStatus'] ?? null;
        $this->container['isvContact'] = $data['isvContact'] ?? null;
        $this->container['isvName'] = $data['isvName'] ?? null;
        $this->container['logoUrl'] = $data['logoUrl'] ?? null;
        $this->container['mName'] = $data['mName'] ?? null;
        $this->container['outTaxAmount'] = $data['outTaxAmount'] ?? null;
        $this->container['payeeName'] = $data['payeeName'] ?? null;
        $this->container['payeeTaxNo'] = $data['payeeTaxNo'] ?? null;
        $this->container['payerName'] = $data['payerName'] ?? null;
        $this->container['payerTaxNo'] = $data['payerTaxNo'] ?? null;
        $this->container['pdfUrl'] = $data['pdfUrl'] ?? null;
        $this->container['source'] = $data['source'] ?? null;
        $this->container['tradeList'] = $data['tradeList'] ?? null;
        $this->container['tradeMatchResult'] = $data['tradeMatchResult'] ?? null;
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
     * Gets expenseStatus
     *
     * @return string|null
     */
    public function getExpenseStatus()
    {
        return $this->container['expenseStatus'];
    }

    /**
     * Sets expenseStatus
     *
     * @param string|null $expenseStatus 发票报销状态  取值范围：  WAIT_EXPENSE－未报销  EXPENSE_PROCESSING－报销中  EXPENSE_FINISHED－已报销
     *
     * @return self
     */
    public function setExpenseStatus($expenseStatus)
    {
        $this->container['expenseStatus'] = $expenseStatus;

        return $this;
    }

    /**
     * Gets extendFields
     *
     * @return string|null
     */
    public function getExtendFields()
    {
        return $this->container['extendFields'];
    }

    /**
     * Sets extendFields
     *
     * @param string|null $extendFields 扩展字段
     *
     * @return self
     */
    public function setExtendFields($extendFields)
    {
        $this->container['extendFields'] = $extendFields;

        return $this;
    }

    /**
     * Gets fakeCode
     *
     * @return string|null
     */
    public function getFakeCode()
    {
        return $this->container['fakeCode'];
    }

    /**
     * Sets fakeCode
     *
     * @param string|null $fakeCode 防伪校验码
     *
     * @return self
     */
    public function setFakeCode($fakeCode)
    {
        $this->container['fakeCode'] = $fakeCode;

        return $this;
    }

    /**
     * Gets hasPdfFile
     *
     * @return bool|null
     */
    public function getHasPdfFile()
    {
        return $this->container['hasPdfFile'];
    }

    /**
     * Sets hasPdfFile
     *
     * @param bool|null $hasPdfFile 发票是否有pdf文件
     *
     * @return self
     */
    public function setHasPdfFile($hasPdfFile)
    {
        $this->container['hasPdfFile'] = $hasPdfFile;

        return $this;
    }

    /**
     * Gets hasRisk
     *
     * @return bool|null
     */
    public function getHasRisk()
    {
        return $this->container['hasRisk'];
    }

    /**
     * Sets hasRisk
     *
     * @param bool|null $hasRisk 该发票可能存在异常，请核实后使用  true:无异常  false:存在异常
     *
     * @return self
     */
    public function setHasRisk($hasRisk)
    {
        $this->container['hasRisk'] = $hasRisk;

        return $this;
    }

    /**
     * Gets invoiceAmount
     *
     * @return string|null
     */
    public function getInvoiceAmount()
    {
        return $this->container['invoiceAmount'];
    }

    /**
     * Sets invoiceAmount
     *
     * @param string|null $invoiceAmount 发票金额，含税，单位元
     *
     * @return self
     */
    public function setInvoiceAmount($invoiceAmount)
    {
        $this->container['invoiceAmount'] = $invoiceAmount;

        return $this;
    }

    /**
     * Gets invoiceCode
     *
     * @return string|null
     */
    public function getInvoiceCode()
    {
        return $this->container['invoiceCode'];
    }

    /**
     * Sets invoiceCode
     *
     * @param string|null $invoiceCode 发票代码
     *
     * @return self
     */
    public function setInvoiceCode($invoiceCode)
    {
        $this->container['invoiceCode'] = $invoiceCode;

        return $this;
    }

    /**
     * Gets invoiceDate
     *
     * @return string|null
     */
    public function getInvoiceDate()
    {
        return $this->container['invoiceDate'];
    }

    /**
     * Sets invoiceDate
     *
     * @param string|null $invoiceDate 开票日期
     *
     * @return self
     */
    public function setInvoiceDate($invoiceDate)
    {
        $this->container['invoiceDate'] = $invoiceDate;

        return $this;
    }

    /**
     * Gets invoiceImgUrl
     *
     * @return string|null
     */
    public function getInvoiceImgUrl()
    {
        return $this->container['invoiceImgUrl'];
    }

    /**
     * Sets invoiceImgUrl
     *
     * @param string|null $invoiceImgUrl 发票pdf文件转换后jpg预览地址
     *
     * @return self
     */
    public function setInvoiceImgUrl($invoiceImgUrl)
    {
        $this->container['invoiceImgUrl'] = $invoiceImgUrl;

        return $this;
    }

    /**
     * Gets invoiceKind
     *
     * @return string|null
     */
    public function getInvoiceKind()
    {
        return $this->container['invoiceKind'];
    }

    /**
     * Sets invoiceKind
     *
     * @param string|null $invoiceKind 发票类型 可选值 PLAIN：增值税电子普通发票 SPECIAL：增值税专用发票 ALL_ELECTRONIC_GENERAL： \"电子发票（普通发票） ALL_ELECTRONIC_SPECIAL： \"电子发票（专用发票） PLAIN_INVOICE:增值税普通发票 PAPER_INVOICE:增值税普通发票（卷式） SALSE_INVOICE:机动车销售统一发票 财政电子票据：FINANCIAL_ELECTRONIC_BILL
     *
     * @return self
     */
    public function setInvoiceKind($invoiceKind)
    {
        $this->container['invoiceKind'] = $invoiceKind;

        return $this;
    }

    /**
     * Gets invoiceNo
     *
     * @return string|null
     */
    public function getInvoiceNo()
    {
        return $this->container['invoiceNo'];
    }

    /**
     * Sets invoiceNo
     *
     * @param string|null $invoiceNo 发票号码
     *
     * @return self
     */
    public function setInvoiceNo($invoiceNo)
    {
        $this->container['invoiceNo'] = $invoiceNo;

        return $this;
    }

    /**
     * Gets invoiceStatus
     *
     * @return string|null
     */
    public function getInvoiceStatus()
    {
        return $this->container['invoiceStatus'];
    }

    /**
     * Sets invoiceStatus
     *
     * @param string|null $invoiceStatus 发票状态　  取值范围  SUCCEED－正常蓝票  EXPIRED－已失效
     *
     * @return self
     */
    public function setInvoiceStatus($invoiceStatus)
    {
        $this->container['invoiceStatus'] = $invoiceStatus;

        return $this;
    }

    /**
     * Gets isvContact
     *
     * @return string|null
     */
    public function getIsvContact()
    {
        return $this->container['isvContact'];
    }

    /**
     * Sets isvContact
     *
     * @param string|null $isvContact 服务商联系方式
     *
     * @return self
     */
    public function setIsvContact($isvContact)
    {
        $this->container['isvContact'] = $isvContact;

        return $this;
    }

    /**
     * Gets isvName
     *
     * @return string|null
     */
    public function getIsvName()
    {
        return $this->container['isvName'];
    }

    /**
     * Sets isvName
     *
     * @param string|null $isvName 服务商名称
     *
     * @return self
     */
    public function setIsvName($isvName)
    {
        $this->container['isvName'] = $isvName;

        return $this;
    }

    /**
     * Gets logoUrl
     *
     * @return string|null
     */
    public function getLogoUrl()
    {
        return $this->container['logoUrl'];
    }

    /**
     * Sets logoUrl
     *
     * @param string|null $logoUrl logo地址
     *
     * @return self
     */
    public function setLogoUrl($logoUrl)
    {
        $this->container['logoUrl'] = $logoUrl;

        return $this;
    }

    /**
     * Gets mName
     *
     * @return string|null
     */
    public function getMName()
    {
        return $this->container['mName'];
    }

    /**
     * Sets mName
     *
     * @param string|null $mName 商户全称
     *
     * @return self
     */
    public function setMName($mName)
    {
        $this->container['mName'] = $mName;

        return $this;
    }

    /**
     * Gets outTaxAmount
     *
     * @return string|null
     */
    public function getOutTaxAmount()
    {
        return $this->container['outTaxAmount'];
    }

    /**
     * Sets outTaxAmount
     *
     * @param string|null $outTaxAmount 发票金额，不含税，单位元
     *
     * @return self
     */
    public function setOutTaxAmount($outTaxAmount)
    {
        $this->container['outTaxAmount'] = $outTaxAmount;

        return $this;
    }

    /**
     * Gets payeeName
     *
     * @return string|null
     */
    public function getPayeeName()
    {
        return $this->container['payeeName'];
    }

    /**
     * Sets payeeName
     *
     * @param string|null $payeeName 销方名称
     *
     * @return self
     */
    public function setPayeeName($payeeName)
    {
        $this->container['payeeName'] = $payeeName;

        return $this;
    }

    /**
     * Gets payeeTaxNo
     *
     * @return string|null
     */
    public function getPayeeTaxNo()
    {
        return $this->container['payeeTaxNo'];
    }

    /**
     * Sets payeeTaxNo
     *
     * @param string|null $payeeTaxNo 销方税号
     *
     * @return self
     */
    public function setPayeeTaxNo($payeeTaxNo)
    {
        $this->container['payeeTaxNo'] = $payeeTaxNo;

        return $this;
    }

    /**
     * Gets payerName
     *
     * @return string|null
     */
    public function getPayerName()
    {
        return $this->container['payerName'];
    }

    /**
     * Sets payerName
     *
     * @param string|null $payerName 购方名称
     *
     * @return self
     */
    public function setPayerName($payerName)
    {
        $this->container['payerName'] = $payerName;

        return $this;
    }

    /**
     * Gets payerTaxNo
     *
     * @return string|null
     */
    public function getPayerTaxNo()
    {
        return $this->container['payerTaxNo'];
    }

    /**
     * Sets payerTaxNo
     *
     * @param string|null $payerTaxNo 购方税号
     *
     * @return self
     */
    public function setPayerTaxNo($payerTaxNo)
    {
        $this->container['payerTaxNo'] = $payerTaxNo;

        return $this;
    }

    /**
     * Gets pdfUrl
     *
     * @return string|null
     */
    public function getPdfUrl()
    {
        return $this->container['pdfUrl'];
    }

    /**
     * Sets pdfUrl
     *
     * @param string|null $pdfUrl PDF的下载链接
     *
     * @return self
     */
    public function setPdfUrl($pdfUrl)
    {
        $this->container['pdfUrl'] = $pdfUrl;

        return $this;
    }

    /**
     * Gets source
     *
     * @return string|null
     */
    public function getSource()
    {
        return $this->container['source'];
    }

    /**
     * Sets source
     *
     * @param string|null $source 表示发票来源，由发票回传方带入。例如：bz_gd，bz_ele，bz_tmall等
     *
     * @return self
     */
    public function setSource($source)
    {
        $this->container['source'] = $source;

        return $this;
    }

    /**
     * Gets tradeList
     *
     * @return \Alipay\OpenAPISDK\Model\EinvTrade[]|null
     */
    public function getTradeList()
    {
        return $this->container['tradeList'];
    }

    /**
     * Sets tradeList
     *
     * @param \Alipay\OpenAPISDK\Model\EinvTrade[]|null $tradeList 该发票对应的交易
     *
     * @return self
     */
    public function setTradeList($tradeList)
    {
        $this->container['tradeList'] = $tradeList;

        return $this;
    }

    /**
     * Gets tradeMatchResult
     *
     * @return string|null
     */
    public function getTradeMatchResult()
    {
        return $this->container['tradeMatchResult'];
    }

    /**
     * Sets tradeMatchResult
     *
     * @param string|null $tradeMatchResult 交易匹配结果 match-匹配到 noMatched-未匹配到 notMatch-未做匹配
     *
     * @return self
     */
    public function setTradeMatchResult($tradeMatchResult)
    {
        $this->container['tradeMatchResult'] = $tradeMatchResult;

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

