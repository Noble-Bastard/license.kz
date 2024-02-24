<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-11
 * Time: 12:01 PM
 */

namespace Tests\Unit;


use App\Data\Core\Dal\UserDal;
use App\Data\Notify\Dal\EmailDal;
use App\Data\StandartContractTemplate\Model\StandartContractTemplateType;

use Tests\TestCase;

class MailTest extends TestCase
{

    public function testMail()
    {
        EmailDal::sendNewEmails();
    }

}