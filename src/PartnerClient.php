<?php

namespace Sforce;

use Sforce\SoapClient;

class PartnerClient extends BaseClient
{
  const PARTNER_NAMESPACE = 'urn:partner.soap.sforce.com';
    
  public function __construct() {
    $this->namespace = self::PARTNER_NAMESPACE;
  }
  
  protected function getSoapClient($wsdl, $options) {
    // Workaround an issue in parsing OldValue and NewValue in histories
        return new SoapClient($wsdl, $options);      
  }
  /**
   * Adds one or more new individual objects to your organization's data.
   * @param array $sObjects Array of one or more sObjects (up to 200) to create.
   * @return SaveResult
   */
  public function create($sObjects) {
    $arg = new stdClass;
    foreach ($sObjects as $sObject) {
      if (isset ($sObject->fields)) {
        $sObject->any = $this->_convertToAny($sObject->fields);
      }
    }
    $arg->sObjects = $sObjects;
    return parent::_create($arg);
  }
  /**
   * Merge records
   *
   * @param stdclass $mergeRequest
   * @param String $type
   * @return mixed
   */
  public function merge($mergeRequest) {
    if (isset($mergeRequest->masterRecord)) {
      if (isset($mergeRequest->masterRecord->fields)) {
        $mergeRequest->masterRecord->any = $this->_convertToAny($mergeRequest->masterRecord->fields);
      }
      //return parent::merge($mergeRequest, $type);
      $arg->request = $mergeRequest;
      return $this->_merge($arg);
    }
  }
  /**
   * 
   * @param array $request
   */
  public function sendSingleEmail($request) {
    if (is_array($request)) {
      $messages = array();
      foreach ($request as $r) {
        $email = new SoapVar($r, SOAP_ENC_OBJECT, 'SingleEmailMessage', $this->namespace);
        array_push($messages, $email);
      }
      $arg->messages = $messages;
      return parent::_sendEmail($arg);
    } else {
      $backtrace = debug_backtrace();
      die('Please pass in array to this function:  '.$backtrace[0]['function']);
    }
  }
  /**
   *
   * @param array $request
   */
  public function sendMassEmail($request) {
    if (is_array($request)) {
      $messages = array();
      foreach ($request as $r) {
        $email = new SoapVar($r, SOAP_ENC_OBJECT, 'MassEmailMessage', $this->namespace);
        array_push($messages, $email);
      }
      $arg->messages = $messages;
      return parent::_sendEmail($arg);
    } else {
      $backtrace = debug_backtrace();
      die('Please pass in array to this function:  '.$backtrace[0]['function']);
    }
  }
  /**
   * Updates one or more new individual objects to your organization's data.
   * @param array sObjects    Array of sObjects
   * @return UpdateResult
   */
  public function update($sObjects) {
    $arg = new stdClass;
    foreach ($sObjects as $sObject) {
      if (isset($sObject->fields)) {
        $sObject->any = $this->_convertToAny($sObject->fields);
      }
    }
    $arg->sObjects = $sObjects;
    return parent::_update($arg);
  }
  /**
   * Creates new objects and updates existing objects; uses a custom field to
   * determine the presence of existing objects. In most cases, we recommend
   * that you use upsert instead of create because upsert is idempotent.
   * Available in the API version 7.0 and later.
   *
   * @param string $ext_Id        External Id
   * @param array  $sObjects  Array of sObjects
   * @return UpsertResult
   */
  public function upsert($ext_Id, $sObjects) {
    //      $this->_setSessionHeader();
    $arg = new stdClass;
    $arg->externalIDFieldName = new SoapVar($ext_Id, XSD_STRING, 'string', 'http://www.w3.org/2001/XMLSchema');
    foreach ($sObjects as $sObject) {
      if (isset ($sObject->fields)) {
        $sObject->any = $this->_convertToAny($sObject->fields);
      }
    }
    $arg->sObjects = $sObjects;
    return parent::_upsert($arg);
  }
  
  /**
   * @param string $fieldList
   * @param string $sObjectType
   * @param array $ids
   * @return string
   */
  public function retrieve($fieldList, $sObjectType, $ids) {
    return $this->_retrieveResult(parent::retrieve($fieldList, $sObjectType, $ids));
  }  
  /**
   *
   * @param mixed $response
   * @return array
   */
  private function _retrieveResult($response) {
    $arr = array();
    if(is_array($response)) {
        foreach($response as $r) {
            $sobject = new SObject($r);
            array_push($arr,$sobject);
        };
    }else {
        $sobject = new SObject($response);
        array_push($arr, $sobject);
    }
    return $arr;
  }
  
}