<?php

namespace Sforce;

class EnterpriseClient extends BaseClient
{
    const ENTERPRISE_NAMESPACE = 'urn:enterprise.soap.sforce.com';

    public function __construct()
    {
        $this->namespace = self::ENTERPRISE_NAMESPACE;
    }
    /**
     * Adds one or more new individual objects to your organization's data.
     * @param array $sObjects    Array of one or more sObjects (up to 200) to create.
     * @param AssignmentRuleHeader $assignment_header is optional.  Defaults to NULL
     * @param MruHeader $mru_header is optional.  Defaults to NULL
     * @return SaveResult
     */
    public function create($sObjects, $type)
    {
        $arg = array();
        foreach ($sObjects as $sObject) {
            // FIX for fieldsToNull issue - allow array in fieldsToNull (STEP #1)
            $xmlStr = '';
            if (isset($sObject->fieldsToNull) && is_array($sObject->fieldsToNull)) {
                foreach ($sObject->fieldsToNull as $fieldToNull) {
                    $xmlStr .= '<fieldsToNull>' . $fieldToNull . '</fieldsToNull>';
                }
            }
            // ------
            $soapObject = new SoapVar($sObject, SOAP_ENC_OBJECT, $type, $this->namespace);
            // FIX for fieldsToNull issue - allow array in fieldsToNull (STEP #2)
            if ($xmlStr != '') {
                $soapObject->enc_value->fieldsToNull = new SoapVar(new SoapVar($xmlStr, XSD_ANYXML), SOAP_ENC_ARRAY);
            }
            // ------
            $arg[] = $soapObject;
        }
        return parent::_create(new SoapParam($arg, "sObjects"));
    }
    /**
     * Updates one or more new individual objects to your organization's data.
     * @param array sObjects    Array of sObjects
     * @param AssignmentRuleHeader $assignment_header is optional.  Defaults to NULL
     * @param MruHeader $mru_header is optional.  Defaults to NULL
     * @return UpdateResult
     */
    public function update($sObjects, $type, $assignment_header = NULL, $mru_header = NULL)
    {
        $arg           = new stdClass;
        $arg->sObjects = array();
        foreach ($sObjects as $sObject) {
            // FIX for fieldsToNull issue - allow array in fieldsToNull (STEP #1)
            $xmlStr = '';
            if (isset($sObject->fieldsToNull) && is_array($sObject->fieldsToNull)) {
                foreach ($sObject->fieldsToNull as $fieldToNull) {
                    $xmlStr .= '<fieldsToNull>' . $fieldToNull . '</fieldsToNull>';
                }
            }
            // ------
            $soapObject = new SoapVar($sObject, SOAP_ENC_OBJECT, $type, $this->namespace);
            // FIX for fieldsToNull issue - allow array in fieldsToNull (STEP #2)
            if ($xmlStr != '') {
                $soapObject->enc_value->fieldsToNull = new SoapVar(new SoapVar($xmlStr, XSD_ANYXML), SOAP_ENC_ARRAY);
            }
            // ------
            $arg->sObjects[] = $soapObject;
        }
        return parent::_update($arg);
    }
    /**
     * Creates new objects and updates existing objects; uses a custom field to
     * determine the presence of existing objects. In most cases, we recommend
     * that you use upsert instead of create because upsert is idempotent.
     * Available in the API version 7.0 and later.
     *
     * @param string $ext_Id External Id
     * @param array  $sObjects Array of sObjects
     * @param string $type The type of objects being upserted.
     * @return UpsertResult
     */
    public function upsert($ext_Id, $sObjects, $type = 'Contact')
    {
        $arg                      = new stdClass;
        $arg->sObjects            = array();
        $arg->externalIDFieldName = new SoapVar($ext_Id, XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema');
        foreach ($sObjects as $sObject) {
            // FIX for fieldsToNull issue - allow array in fieldsToNull (STEP #1)
            $xmlStr = '';
            if (isset($sObject->fieldsToNull) && is_array($sObject->fieldsToNull)) {
                foreach ($sObject->fieldsToNull as $fieldToNull) {
                    $xmlStr .= '<fieldsToNull>' . $fieldToNull . '</fieldsToNull>';
                }
            }
            // ------
            $soapObject = new SoapVar($sObject, SOAP_ENC_OBJECT, $type, $this->namespace);
            // FIX for fieldsToNull issue - allow array in fieldsToNull (STEP #2)
            if ($xmlStr != '') {
                $soapObject->enc_value->fieldsToNull = new SoapVar(new SoapVar($xmlStr, XSD_ANYXML), SOAP_ENC_ARRAY);
            }
            // ------
            $arg->sObjects[] = $soapObject;
        }
        return parent::_upsert($arg);
    }
    /**
     * Merge records
     *
     * @param stdclass $mergeRequest
     * @param String $type
     * @return unknown
     */
    public function merge($mergeRequest, $type)
    {
        $mergeRequest->masterRecord = new SoapVar($mergeRequest->masterRecord, SOAP_ENC_OBJECT, $type, $this->namespace);
        $arg                        = new stdClass;
        $arg->request               = new SoapVar($mergeRequest, SOAP_ENC_OBJECT, 'MergeRequest', $this->namespace);
        return parent::_merge($arg);
    }
}