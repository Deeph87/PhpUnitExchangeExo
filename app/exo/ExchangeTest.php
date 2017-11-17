<?php
/**
 * Created by PhpStorm.
 * User: jhaudry
 * Date: 23/10/2017
 * Time: 16:29
 */

require '../Autoloader.php';

use PHPUnit\Framework\TestCase;
use Exo\Autoloader;
use Exo\User;
use Exo\Exchange;
use Exo\Product;
use Exo\EmailSender;

Autoloader::register();

class ExchangeTest extends TestCase
{
    public function testSave()
    {
//        Instantiate Exchange class
        $exchange = new Exchange();
//        $emailSender = new EmailSender();

//        Params
        $startDate = '12/11/2017';
        $endDate = '15/11/2017';

//        Set-up mocks
        $receiver = $this->getMockBuilder(User::class)
            ->setMethods(['isValid', 'getAge'])
            ->getMock();

        $product = $this->getMockBuilder(Product::class)
            ->setMethods(['isValid'])
            ->getMock();

        $owner = $this->getMockBuilder(Product::class)
            ->setMethods(['isUserInProductAndValid'])
            ->getMock();

//        What we expect & some other tests
        $receiver->expects($this->once())
            ->method('isValid')
            ->will(
                $this->returnValue(true)
            );

        $receiver->expects($this->once())
            ->method('getAge')
            ->will(
                $this->returnValue(12)
            );

        $product->expects($this->once())
            ->method('isValid')
            ->will(
                $this->returnValue(true)
            );

        $owner->expects($this->once())
            ->method('isUserInProductAndValid')
            ->will(
                $this->returnValue(true)
            );

        $this->assertTrue($exchange->areValidDates($startDate, $endDate));

//        if($receiver->getAge() < 18) {
//            $this->assertTrue($emailSender->sendEmail('jojo@jaja.fr', 'yohoo', $receiver->getAge()));
//        } else {
//            $this->assertFalse($emailSender->sendEmail('jojo@jaja.fr', 'yohoo', $receiver->getAge()));
//        }

        $exchange->save($receiver, $product, $owner, $startDate, $endDate);
    }
}