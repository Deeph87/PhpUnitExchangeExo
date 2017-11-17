<?php

namespace Exo;

//require_once 'Autoloader.php';

//use Exo\User;
//use Exo\Autoloader;
//use Exo\EmailSender;

//Autoloader::register();

class Exchange
{
    private $owner;
    private $receiver;
    private $product;
    private $startDate;
    private $endDate;
    private $emailSender;
    private $db;

    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
    }

    public function setProduct($receiver)
    {
        $this->receiver = $receiver;
    }

    public function setStartDate($receiver)
    {
        $this->receiver = $receiver;
    }

    public function setEndDate($receiver)
    {
        $this->receiver = $receiver;
    }

    public function setEmailSender($receiver)
    {
        $this->receiver = $receiver;
    }

    public function setDb($receiver)
    {
        $this->receiver = $receiver;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function getReceiver()
    {
        return $this->receiver;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function getEmailSender()
    {
        return $this->emailSender;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function save($receiver, $product, $owner, $startDate, $endDate)
    {
        $ret = $receiver->isValid() && $product->isValid() && $owner->isUserInProductAndValid() && $this->areValidDates($startDate, $endDate);
        if($ret && $receiver->getAge() < 18) {
            $myEmailSender = new EmailSender();
            $myEmailSender->sendEmail($receiver->getEmail(), 'Vous êtes mineur');
            $this->setEmailSender($receiver->getEmail());
        }
        if($ret){
            $this->setReceiver($receiver);
            $this->setProduct($product);
            $this->setOwner($owner);
            $this->setStartDate($startDate);
            $this->setEndDate($endDate);

            $myDb = new DatabaseConnection();
            $myDb->saveExchange($this);
            return true;
        }
        return false;
    }

    public function areValidDates($startDate, $endDate){
        $start = \DateTime::createFromFormat('m/d/Y', $startDate);
        $end = \DateTime::createFromFormat('m/d/Y', $endDate);

        return $start->getTimestamp() <= $end->getTimestamp();
    }
}