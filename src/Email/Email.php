<?php

namespace Sforce\Email;

class Email
{
    public function setBccSender($bccSender)
    {
        $this->bccSender = $bccSender;
    }
    
    public function setEmailPriority($priority)
    {
        $this->emailPriority = $priority;
    }
    
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    
    public function setSaveAsActivity($saveAsActivity)
    {
        $this->saveAsActivity = $saveAsActivity;
    }
    
    public function setReplyTo($replyTo)
    {
        $this->replyTo = $replyTo;
    }
    
    public function setUseSignature($useSignature)
    {
        $this->useSignature = $useSignature;
    }
    
    public function setSenderDisplayName($name)
    {
        $this->senderDisplayName = $name;
    }
}
