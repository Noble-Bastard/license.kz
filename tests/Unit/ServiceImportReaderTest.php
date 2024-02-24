<?php

namespace Tests\Unit;


use App\Data\Helper\FilePathHelper;
use App\Data\Service\Import\Data\Comment;
use App\Data\Service\Import\Data\Step;
use App\Data\Service\Import\ServiceImportReader;
use Tests\TestCase;

class ServiceImportReaderTest extends TestCase
{
    const SERVICE_CNT = 6;

    public function testServiceImportReader()
    {
        $sampleFileName = FilePathHelper::getTestSampleFolder() . "/serviceImportSampleData.xlsx";
        $serviceImportReader = new ServiceImportReader();
        $serviceImportList = $serviceImportReader->read($sampleFileName);
        $this->assertCount(self::SERVICE_CNT, $serviceImportList);
        $this->assertServiceCode($serviceImportList);
        $this->assertServiceName($serviceImportList);
        $this->assertCurrencyCode($serviceImportList);
        $this->assertServiceComments($serviceImportList);
        $this->assertServiceAdditionalRequirements($serviceImportList);
        $this->assertServiceSteps($serviceImportList);
    }

    private function assertServiceCode(array $serviceImportList): void
    {
        $this->assertEquals($serviceImportList[0]->code, "AEAFZA24");
        $this->assertEquals($serviceImportList[1]->code, "AEAFZA23");
        $this->assertEquals($serviceImportList[2]->code, "AEAFZA22");
        $this->assertEquals($serviceImportList[3]->code, "AEAFZA21");
        $this->assertEquals($serviceImportList[4]->code, "AEAFZA20");
        $this->assertEquals($serviceImportList[5]->code, "AEAFZA19");
    }

    private function assertServiceName(array $serviceImportList): void
    {
        $value = "Регистрация компании в СЭЗ в эмирате Аджман";
        $valueEn = "Freezone Company Formation";
        for ($i = 0; $i < self::SERVICE_CNT; $i++) {
            $this->assertEquals($serviceImportList[$i]->name, $value);
            $this->assertEquals($serviceImportList[$i]->nameEn, $valueEn);
        }
    }

    private function assertCurrencyCode(array $serviceImportList)
    {
        $value = "AED";
        for ($i = 0; $i < self::SERVICE_CNT; $i++) {
            $this->assertEquals($serviceImportList[$i]->currencyCode, $value);
            $this->assertEquals($serviceImportList[$i]->currencyCodeEn, $value);
        }
    }

    private function assertServiceComments(array $serviceImportList)
    {
        $sampleComments = $this->getSampleCommentsData();
        for ($i = 0; $i < self::SERVICE_CNT; $i++) {
            $this->assertCount(count($sampleComments), $serviceImportList[$i]->serviceComments);
            $this->assertCount(0 ,
                array_udiff(
                    $sampleComments,
                    $serviceImportList[$i]->serviceComments,
                    function ($sample, $import) {
                        return strcmp($sample->name, $import->name)
                            && strcmp($sample->nameEn, $import->nameEn);
                    }
                )
            );
        }
    }

    private function assertServiceAdditionalRequirements(array $serviceImportList)
    {
        $sampleAdditionalRequirements = $this->getSampleAdditionalRequirementsData();
        for ($i = 0; $i < self::SERVICE_CNT; $i++) {
            $this->assertCount(count($sampleAdditionalRequirements[$i]), $serviceImportList[$i]->serviceAdditionalRequirements);
            $this->assertCount(0 ,
                array_udiff(
                    $sampleAdditionalRequirements[$i],
                    $serviceImportList[$i]->serviceAdditionalRequirements,
                    function ($sample, $import) {
                        return strcmp($sample->name, $import->name)
                            && strcmp($sample->nameEn, $import->nameEn);
                    }
                )
            );
        }
    }

    private function assertServiceSteps(array $serviceImportList)
    {
        $sampleSteps = $this->getSampleStepsData();
        $sampleCostData = $this->getServiceStepsSampleCostData();
        $sampleDocumentsData = $this->getServiceStepsSampleDocumentsData();
        $sampleResultsData = $this->getServiceStepsSampleResultsData();
        for ($i = 0; $i < self::SERVICE_CNT; $i++) {
            $this->assertCount(4, $serviceImportList[$i]->serviceSteps);
            $this->assertCount(0 ,
                array_udiff(
                    $sampleSteps,
                    $serviceImportList[$i]->serviceSteps,
                    function ($sample, $import) {
                        return strcmp($sample->name, $import->name)
                            && strcmp($sample->nameEn, $import->nameEn)
                            && strcmp($sample->stepNo, $import->stepNo);
                    }
                )
            );

            foreach ($serviceImportList[$i]->serviceSteps as $key=>$serviceStep){
                $this->assertEquals($serviceStep->cost, $sampleCostData[$i][$key]["cost"]);
                $this->assertEquals($serviceStep->tax, $sampleCostData[$i][$key]["tax"]);
                $this->assertEquals($serviceStep->time, $sampleCostData[$i][$key]["time"]);
                foreach ($sampleDocumentsData[$i][$key] as $docKey=>$sampleDocument)
                {
                    $this->assertEquals(trim($sampleDocument["name"]), trim($serviceStep->documents[$docKey]->name));
                    $this->assertEquals(trim($sampleDocument["nameEn"]), trim($serviceStep->documents[$docKey]->nameEn));
                }
                foreach ($sampleResultsData[$i][$key] as $docKey=>$sampleResult)
                {
                    $this->assertEquals(trim($sampleResult["name"]), trim($serviceStep->results[$docKey]->name));
                    $this->assertEquals(trim($sampleResult["nameEn"]), trim($serviceStep->results[$docKey]->nameEn));
                }
            }
        }
    }

    private function getSampleCommentsData(): array
    {
        $sampleComments = array(
            0 => new Comment (
                "Цена представлена для стандартного офиса. Для получения цены по другим помещениям, просим связаться с отделом продаж",
                "Price is for standard office, to get a quote for other facilities please contact with sales team"
            ),
            1 => new Comment(
                "Сопровождение и получение визы является отдельной услугой",
                "Visa support is a separate service"
            ),
            2 => new Comment(
                "Администрация СЭЗ оставляет за собой право запросить любые дополнительные документы, которые он сочтет необходимыми",
                "The Authority reserves the right to ask for any extra documents, it may deem require"
            ),
            3 => new Comment(
                "Срок рассмотрения документов зависит от миграционных служб",
                "Terms of documents review depends on immigration approval"
            )
        );
        return $sampleComments;
    }

    private function getSampleAdditionalRequirementsData(): array
    {
        $sampleComments = array(
            0 => [
                0 => new Comment (
                    "Минимальная материально-техническая оснащенность на праве собственности: САГ, кран, башенный кран",
                    "Minimum material and technical equipment on ownership: SAG, crane, tower crane"
                ),
                1 => new Comment(
                    "Специалисты: Инженер ПГС",
                    "Specialists: ASG Engineer"
                )
            ],
            1 => [],
            2 => [],
            3 => [],
            4 => [],
            5 => []
        );
        return $sampleComments;
    }

    private function getSampleStepsData()
    {
        $sampleSteps = array();

        $stepA = new Step();
        $stepA->stepNo = "Шаг 1.";
        $stepA->name = "Предварительная проверка контрагента (личная встреча с командой Ipravo обязательна)";
        $stepA->nameEn = "Enhanced Due Diligence (personal meeting with Ipravo team for physical presence of the shareholder is mandatory)";
        array_push($sampleSteps, $stepA);

        $stepB = new Step();
        $stepB->stepNo = "Шаг 2.";
        $stepB->name = "Подача документов на предварительное одобрение в Иммиграционную службу (физическое присутствие учредителя / уполномоченного лица не требуется)";
        $stepB->nameEn = "Pre-approval (physical presence of the shareholder / concerned person is not required)";
        array_push($sampleSteps, $stepB);

        $stepC = new Step();
        $stepC->stepNo = "Шаг 3.";
        $stepC->name = "Подача документов для регистрации филиала в Реестре СЭЗ (необходимо физическое присутствие учредителя / уполномоченного лица)";
        $stepC->nameEn = "Documents submission for Branch registration to the Authority  (physical presence of the shareholder / concerned person is mandatory)";
        array_push($sampleSteps, $stepC);

        $stepD = new Step();
        $stepD->stepNo = "Шаг 4.";
        $stepD->name = "Получение оригинального комплекта документов (необходимо физическое присутствие учредителя / уполномоченного лица *)";
        $stepD->nameEn = "Receipt of the original set of documents (physical presence of the shareholder / concerned person is necessary)";
        array_push($sampleSteps, $stepD);

        return $sampleSteps;
    }

    private function getServiceStepsSampleCostData()
    {
        $sampleCostsData = array(
            0 => [
                0 => ["time" => 2, "tax" => 0, "cost" => 500],
                1 => ["time" => 2, "tax" => 100, "cost" => 0],
                2 => ["time" => 3, "tax" => 38125, "cost" => 2500],
                3 => ["time" => 1, "tax" => 0, "cost" => 2000],
            ],
            1 => [
                0 => ["time" => 2, "tax" => 0, "cost" => 500],
                1 => ["time" => 2, "tax" => 100, "cost" => 0],
                2 => ["time" => 3, "tax" => 32025, "cost" => 2500],
                3 => ["time" => 1, "tax" => 0, "cost" => 2000],
            ],
            2 => [
                0 => ["time" => 2, "tax" => 0, "cost" => 500],
                1 => ["time" => 2, "tax" => 100, "cost" => 2500],
                2 => ["time" => 3, "tax" => 33325, "cost" => 0],
                3 => ["time" => 1, "tax" => 0, "cost" => 2000],
            ],
            3 => [
                0 => ["time" => 2, "tax" => 0, "cost" => 500],
                1 => ["time" => 2, "tax" => 100, "cost" => 0],
                2 => ["time" => 3, "tax" => 34625, "cost" => 2500],
                3 => ["time" => 1, "tax" => 0, "cost" => 2000],
            ],
            4 => [
                0 => ["time" => 2, "tax" => 0, "cost" => 500],
                1 => ["time" => 2, "tax" => 100, "cost" => 0],
                2 => ["time" => 3, "tax" => 37225, "cost" => 2500],
                3 => ["time" => 1, "tax" => 0, "cost" => 2000],
            ],
            5 => [
                0 => ["time" => 2, "tax" => 0, "cost" => 500],
                1 => ["time" => 2, "tax" => 100, "cost" => 0],
                2 => ["time" => 3, "tax" => 34625, "cost" => 2500],
                3 => ["time" => 1, "tax" => 0, "cost" => 2000],
            ]
        );

        return $sampleCostsData;

    }

    private function getServiceStepsSampleDocumentsData()
    {
        $sampleDocumentsData = array(
            0 => [
                0 => [
                    0 => ["name" => "Заполненная и подписанная Ipravo Анкета KYC (\"Знай Своего Клиента\")", "nameEn" => "Ipravo KYC Questionnaire (template provided)"],
                    1 => ["name" => "Подписанная декларация бенефициара (документ предоставляется)", "nameEn" => "UBO Declaration form (template provided)"],
                    2 => ["name" => "Оригинал паспорта учредителя/директора/менеджера/секретаря", "nameEn" => "Valid Passport copy of Shareholder/ Director / Secretary / Proposed Manager"],
                    3 => ["name" => "Копия резидентской или туристической визы (со штампом въезда в ОАЭ) учредителя/директора/менеджера", "nameEn" => "Copy of UAE resident or tourist visa (UAE entry stamp) of Shareholder / Director/ Proposed Manager"],
                ],

                1 => [
                    0 => ["name" => "Действующая копия паспорта учредителя/директора/менеджера", "nameEn" => "Valid Passport copy of Shareholder/Manager/Director"],
                    1 => ["name" => "Копия резидентской или туристической визы (со штампом въезда в ОАЭ)", "nameEn" => "Copy of UAE resident or tourist visa (UAE entry stamp)"],
                    2 => ["name" => "Фото 3x4 учреителя/директора/менеджера на белом фоне", "nameEn" => "Photo 3x4 on a white background of shareholder"],
                    3 => ["name" => "Анкета (образец предоставляется)", "nameEn" => "Application to AFZA (template provided)"],
                    4 => ["name" => "Письмо от отсутствии возражений на открытие компании от спонсора визы Менеджера компании (если применимо)", "nameEn" => "Non-Objection Certificate for Manager from the Current UAE Sponsor to manage the company (if applicable)"],
                    5 => ["name" => "Решение, выданное компетентным органом компании для осуществления деятельности в свободной зоне и назначения представителя или управляющего в силу обязанности, заверенной доверенностью (легализованное в посольстве ОАЭ и МИД ОАЭ)", "nameEn" => "A resolution issued by the competent authority to the company for carrying out the activity in the free zone and appointment of a representative or manager by virtue of a duty attested power of attorney  (attested in UAE Embassy and MOFa)"],
                    6 => ["name" => "Свидетельство о регистрации выдается компетентным органом страны, в которой зарегистрирована компания. (легализованное в посольстве ОАЭ и МИД ОАЭ)", "nameEn" => "Registration Certificate issued by the competent authority in the country in which the company is registered. (attested in UAE Embassy and MOFa)"],
                    7 => ["name" => "Договор об ассоциации компании", "nameEn" => "Contract of Association of the company"],
                ],

                2 => [
                    0 => ["name" => "Не применимо", "nameEn" => "Not applicable"],
                ],

                3 => [
                    0 => ["name" => "*Доверенность (при наличии)", "nameEn" => "*Authorization Letter / Power of Attorney (if applicable)"],
                ],

            ],
            1 => [
                0 => [
                    0 => ["name" => "Заполненная и подписанная Ipravo Анкета KYC (\"Знай Своего Клиента\")", "nameEn" => "Ipravo KYC Questionnaire (template provided)"],
                    1 => ["name" => "Подписанная декларация бенефициара (документ предоставляется)", "nameEn" => "UBO Declaration form (template provided)"],
                    2 => ["name" => "Оригинал паспорта учредителя/директора/менеджера/секретаря", "nameEn" => "Valid Passport copy of Shareholder/ Director / Secretary / Proposed Manager"],
                    3 => ["name" => "Копия резидентской или туристической визы (со штампом въезда в ОАЭ) учредителя/директора/менеджера", "nameEn" => "Copy of UAE resident or tourist visa (UAE entry stamp) of Shareholder / Director/ Proposed Manager"],
                ],

                1 => [
                    0 => ["name" => "Действующая копия паспорта учредителя/директора/менеджера", "nameEn" => "Valid Passport copy of Shareholder/Manager/Director"],
                    1 => ["name" => "Копия резидентской или туристической визы (со штампом въезда в ОАЭ)", "nameEn" => "Copy of UAE resident or tourist visa (UAE entry stamp)"],
                    2 => ["name" => "Фото 3x4 учреителя/директора/менеджера на белом фоне", "nameEn" => "Photo 3x4 on a white background of shareholder"],
                    3 => ["name" => "Анкета (образец предоставляется)", "nameEn" => "Application to AFZA (template provided)"],
                    4 => ["name" => "Письмо от отсутствии возражений на открытие компании от спонсора визы Менеджера компании (если применимо)", "nameEn" => "Non-Objection Certificate for Manager from the Current UAE Sponsor to manage the company (if applicable)"],
                    5 => ["name" => "Решение, выданное компетентным органом компании для осуществления деятельности в свободной зоне и назначения представителя или управляющего в силу обязанности, заверенной доверенностью (легализованное в посольстве ОАЭ и МИД ОАЭ)", "nameEn" => "A resolution issued by the competent authority to the company for carrying out the activity in the free zone and appointment of a representative or manager by virtue of a duty attested power of attorney  (attested in UAE Embassy and MOFa)"],
                    6 => ["name" => "Свидетельство о регистрации выдается компетентным органом страны, в которой зарегистрирована компания. (легализованное в посольстве ОАЭ и МИД ОАЭ)", "nameEn" => "Registration Certificate issued by the competent authority in the country in which the company is registered. (attested in UAE Embassy and MOFa)"],
                    7 => ["name" => "Договор об ассоциации компании", "nameEn" => "Contract of Association of the company"],
                ],

                2 => [
                    0 => ["name" => "Не применимо", "nameEn" => "Not applicable"],
                ],

                3 => [
                    0 => ["name" => "*Доверенность (при наличии)", "nameEn" => "*Authorization Letter / Power of Attorney (if applicable)"],
                ],
            ],
            2 => [
                0 => [
                    0 => ["name" => "Заполненная и подписанная Ipravo Анкета KYC (\"Знай Своего Клиента\")", "nameEn" => "Ipravo KYC Questionnaire (template provided)"],
                    1 => ["name" => "Подписанная декларация бенефициара (документ предоставляется)", "nameEn" => "UBO Declaration form (template provided)"],
                    2 => ["name" => "Оригинал паспорта учредителя/директора/менеджера/секретаря", "nameEn" => "Valid Passport copy of Shareholder/ Director / Secretary / Proposed Manager"],
                    3 => ["name" => "Копия резидентской или туристической визы (со штампом въезда в ОАЭ) учредителя/директора/менеджера", "nameEn" => "Copy of UAE resident or tourist visa (UAE entry stamp) of Shareholder / Director/ Proposed Manager"],
                ],

                1 => [
                    0 => ["name" => "Действующая копия паспорта учредителя/директора/менеджера", "nameEn" => "Valid Passport copy of Shareholder/Manager/Director"],
                    1 => ["name" => "Копия резидентской или туристической визы (со штампом въезда в ОАЭ)", "nameEn" => "Copy of UAE resident or tourist visa (UAE entry stamp)"],
                    2 => ["name" => "Фото 3x4 учреителя/директора/менеджера на белом фоне", "nameEn" => "Photo 3x4 on a white background of shareholder"],
                    3 => ["name" => "Анкета (образец предоставляется)", "nameEn" => "Application to AFZA (template provided)"],
                    4 => ["name" => "Письмо от отсутствии возражений на открытие компании от спонсора визы Менеджера компании (если применимо)", "nameEn" => "Non-Objection Certificate for Manager from the Current UAE Sponsor to manage the company (if applicable)"],
                    5 => ["name" => "Решение, выданное компетентным органом компании для осуществления деятельности в свободной зоне и назначения представителя или управляющего в силу обязанности, заверенной доверенностью (легализованное в посольстве ОАЭ и МИД ОАЭ)", "nameEn" => "A resolution issued by the competent authority to the company for carrying out the activity in the free zone and appointment of a representative or manager by virtue of a duty attested power of attorney  (attested in UAE Embassy and MOFa)"],
                    6 => ["name" => "Свидетельство о регистрации выдается компетентным органом страны, в которой зарегистрирована компания. (легализованное в посольстве ОАЭ и МИД ОАЭ)", "nameEn" => "Registration Certificate issued by the competent authority in the country in which the company is registered. (attested in UAE Embassy and MOFa)"],
                    7 => ["name" => "Договор об ассоциации компании", "nameEn" => "Contract of Association of the company"],
                ],

                2 => [
                    0 => ["name" => "Не применимо", "nameEn" => "Not applicable"],
                ],

                3 => [
                    0 => ["name" => "*Доверенность (при наличии)", "nameEn" => "*Authorization Letter / Power of Attorney (if applicable)"],
                ],
            ],
            3 => [
                0 => [
                    0 => ["name" => "Заполненная и подписанная Ipravo Анкета KYC (\"Знай Своего Клиента\")", "nameEn" => "Ipravo KYC Questionnaire (template provided)"],
                    1 => ["name" => "Подписанная декларация бенефициара (документ предоставляется)", "nameEn" => "UBO Declaration form (template provided)"],
                    2 => ["name" => "Оригинал паспорта учредителя/директора/менеджера/секретаря", "nameEn" => "Valid Passport copy of Shareholder/ Director / Secretary / Proposed Manager"],
                    3 => ["name" => "Копия резидентской или туристической визы (со штампом въезда в ОАЭ) учредителя/директора/менеджера", "nameEn" => "Copy of UAE resident or tourist visa (UAE entry stamp) of Shareholder / Director/ Proposed Manager"],
                ],

                1 => [
                    0 => ["name" => "Действующая копия паспорта учредителя/директора/менеджера", "nameEn" => "Valid Passport copy of Shareholder/Manager/Director"],
                    1 => ["name" => "Копия резидентской или туристической визы (со штампом въезда в ОАЭ)", "nameEn" => "Copy of UAE resident or tourist visa (UAE entry stamp)"],
                    2 => ["name" => "Фото 3x4 учреителя/директора/менеджера на белом фоне", "nameEn" => "Photo 3x4 on a white background of shareholder"],
                    3 => ["name" => "Анкета (образец предоставляется)", "nameEn" => "Application to AFZA (template provided)"],
                    4 => ["name" => "Письмо от отсутствии возражений на открытие компании от спонсора визы Менеджера компании (если применимо)", "nameEn" => "Non-Objection Certificate for Manager from the Current UAE Sponsor to manage the company (if applicable)"],
                    5 => ["name" => "Решение, выданное компетентным органом компании для осуществления деятельности в свободной зоне и назначения представителя или управляющего в силу обязанности, заверенной доверенностью (легализованное в посольстве ОАЭ и МИД ОАЭ)", "nameEn" => "A resolution issued by the competent authority to the company for carrying out the activity in the free zone and appointment of a representative or manager by virtue of a duty attested power of attorney  (attested in UAE Embassy and MOFa)"],
                    6 => ["name" => "Свидетельство о регистрации выдается компетентным органом страны, в которой зарегистрирована компания. (легализованное в посольстве ОАЭ и МИД ОАЭ)", "nameEn" => "Registration Certificate issued by the competent authority in the country in which the company is registered. (attested in UAE Embassy and MOFa)"],
                    7 => ["name" => "Договор об ассоциации компании", "nameEn" => "Contract of Association of the company"],
                ],

                2 => [
                    0 => ["name" => "Не применимо", "nameEn" => "Not applicable"],
                ],

                3 => [
                    0 => ["name" => "*Доверенность (при наличии)", "nameEn" => "*Authorization Letter / Power of Attorney (if applicable)"],
                ],
            ],
            4 => [
                0 => [
                    0 => ["name" => "Заполненная и подписанная Ipravo Анкета KYC (\"Знай Своего Клиента\")", "nameEn" => "Ipravo KYC Questionnaire (template provided)"],
                    1 => ["name" => "Подписанная декларация бенефициара (документ предоставляется)", "nameEn" => "UBO Declaration form (template provided)"],
                    2 => ["name" => "Оригинал паспорта учредителя/директора/менеджера/секретаря", "nameEn" => "Valid Passport copy of Shareholder/ Director / Secretary / Proposed Manager"],
                    3 => ["name" => "Копия резидентской или туристической визы (со штампом въезда в ОАЭ) учредителя/директора/менеджера", "nameEn" => "Copy of UAE resident or tourist visa (UAE entry stamp) of Shareholder / Director/ Proposed Manager"],
                ],

                1 => [
                    0 => ["name" => "Действующая копия паспорта учредителя/директора/менеджера", "nameEn" => "Valid Passport copy of Shareholder/Manager/Director"],
                    1 => ["name" => "Копия резидентской или туристической визы (со штампом въезда в ОАЭ)", "nameEn" => "Copy of UAE resident or tourist visa (UAE entry stamp)"],
                    2 => ["name" => "Фото 3x4 учреителя/директора/менеджера на белом фоне", "nameEn" => "Photo 3x4 on a white background of shareholder"],
                    3 => ["name" => "Анкета (образец предоставляется)", "nameEn" => "Application to AFZA (template provided)"],
                    4 => ["name" => "Письмо от отсутствии возражений на открытие компании от спонсора визы Менеджера компании (если применимо)", "nameEn" => "Non-Objection Certificate for Manager from the Current UAE Sponsor to manage the company (if applicable)"],
                    5 => ["name" => "Решение, выданное компетентным органом компании для осуществления деятельности в свободной зоне и назначения представителя или управляющего в силу обязанности, заверенной доверенностью (легализованное в посольстве ОАЭ и МИД ОАЭ)", "nameEn" => "A resolution issued by the competent authority to the company for carrying out the activity in the free zone and appointment of a representative or manager by virtue of a duty attested power of attorney  (attested in UAE Embassy and MOFa)"],
                    6 => ["name" => "Свидетельство о регистрации выдается компетентным органом страны, в которой зарегистрирована компания. (легализованное в посольстве ОАЭ и МИД ОАЭ)", "nameEn" => "Registration Certificate issued by the competent authority in the country in which the company is registered. (attested in UAE Embassy and MOFa)"],
                    7 => ["name" => "Договор об ассоциации компании", "nameEn" => "Contract of Association of the company"],
                ],

                2 => [
                    0 => ["name" => "Не применимо", "nameEn" => "Not applicable"],
                ],

                3 => [
                    0 => ["name" => "*Доверенность (при наличии)", "nameEn" => "*Authorization Letter / Power of Attorney (if applicable)"],
                ],
            ],
            5 => [
                0 => [
                    0 => ["name" => "Заполненная и подписанная Ipravo Анкета KYC (\"Знай Своего Клиента\")", "nameEn" => "Ipravo KYC Questionnaire (template provided)"],
                    1 => ["name" => "Подписанная декларация бенефициара (документ предоставляется)", "nameEn" => "UBO Declaration form (template provided)"],
                    2 => ["name" => "Оригинал паспорта учредителя/директора/менеджера/секретаря", "nameEn" => "Valid Passport copy of Shareholder/ Director / Secretary / Proposed Manager"],
                    3 => ["name" => "Копия резидентской или туристической визы (со штампом въезда в ОАЭ) учредителя/директора/менеджера", "nameEn" => "Copy of UAE resident or tourist visa (UAE entry stamp) of Shareholder / Director/ Proposed Manager"],
                    4 => ["name" => "Технико-экономическое обоснование", "nameEn" => "Feasibility study report"],
                ],

                1 => [
                    0 => ["name" => "Действующая копия паспорта учредителя/директора/менеджера", "nameEn" => "Valid Passport copy of Shareholder/Manager/Director"],
                    1 => ["name" => "Копия резидентской или туристической визы (со штампом въезда в ОАЭ)", "nameEn" => "Copy of UAE resident or tourist visa (UAE entry stamp)"],
                    2 => ["name" => "Фото 3x4 учреителя/директора/менеджера на белом фоне", "nameEn" => "Photo 3x4 on a white background of shareholder"],
                    3 => ["name" => "Анкета (образец предоставляется)", "nameEn" => "Application to AFZA (template provided)"],
                    4 => ["name" => "Письмо от отсутствии возражений на открытие компании от спонсора визы Менеджера компании (если применимо)", "nameEn" => "Non-Objection Certificate for Manager from the Current UAE Sponsor to manage the company (if applicable)"],
                    5 => ["name" => "Решение, выданное компетентным органом компании для осуществления деятельности в свободной зоне и назначения представителя или управляющего в силу обязанности, заверенной доверенностью (легализованное в посольстве ОАЭ и МИД ОАЭ)", "nameEn" => "A resolution issued by the competent authority to the company for carrying out the activity in the free zone and appointment of a representative or manager by virtue of a duty attested power of attorney  (attested in UAE Embassy and MOFa)"],
                    6 => ["name" => "Свидетельство о регистрации выдается компетентным органом страны, в которой зарегистрирована компания. (легализованное в посольстве ОАЭ и МИД ОАЭ)", "nameEn" => "Registration Certificate issued by the competent authority in the country in which the company is registered. (attested in UAE Embassy and MOFa)"],
                    7 => ["name" => "Договор об ассоциации компании", "nameEn" => "Contract of Association of the company"],
                ],

                2 => [
                    0 => ["name" => "Не применимо", "nameEn" => "Not applicable"],
                ],

                3 => [
                    0 => ["name" => "*Доверенность (при наличии)", "nameEn" => "*Authorization Letter / Power of Attorney (if applicable)"],
                ],
            ]
        );

        return $sampleDocumentsData;

    }

    private function getServiceStepsSampleResultsData()
    {
        $sampleResultsData = array(
            0 => [
                0 => [
                    0 => ["name" => "Пройдена предварительная проверка контрагента", "nameEn" => "Performed Due Dilligence check"]
                ],

                1 => [
                    0 => ["name" => "Подтверждение и резервация наименования филиала (наименование филиала будет аналогичным наименованию материнской компании)", "nameEn" => "Branch name approval & reservation (the name of the branch will be similar to the name of the parent company)"],
                    1 => ["name" => "Получение разрешения от Иммиграционной службы на открытие филиала учредителем", "nameEn" => "Immigration approval of the shareholder"],
                ],

                2 => [
                    0 => ["name" => "Документы по вновь создаваемой компании находятся на рассмотрении у администрации СЭЗ", "nameEn" => "Documents for company formation are under review with the Authority"],
                ],

                3 => [
                    0 => [
                        "name" => "Оригинал лицензии / Свидетельство о регистрации / Устав и учредительный договор / Список акционеров / Сертификат торговой палаты Аджмана / Договор аренды, стандартный офис  (1 год / 5 виз) / Техническое обслуживание офиса /  Общие услуги / Вывеска / Открытие миграционной карточки",
                        "nameEn" => "Original License/ Certificate of Incorporation/ Memorandum of Association / Shareholder List / Ajman Chamber of Commerce Certificate / Lease agreement (standard office 16 sq.m / 1 year / 5 visas) / Maintenance / General Services / Sign Board / Establishment Card"],
                ],

            ],
            1 => [
                0 => [
                    0 => ["name" => "Пройдена предварительная проверка контрагента", "nameEn" => "Performed Due Dilligence check"]
                ],

                1 => [
                    0 => ["name" => "Подтверждение и резервация наименования филиала (наименование филиала будет аналогичным наименованию материнской компании)", "nameEn" => "Branch name approval & reservation (the name of the branch will be similar to the name of the parent company)"],
                    1 => ["name" => "Получение разрешения от Иммиграционной службы на открытие филиала учредителем", "nameEn" => "Immigration approval of the shareholder"],
                ],

                2 => [
                    0 => ["name" => "Документы по вновь создаваемой компании находятся на рассмотрении у администрации СЭЗ", "nameEn" => "Documents for company formation are under review with the Authority"],
                ],

                3 => [
                    0 => [
                        "name" => "Оригинал лицензии / Свидетельство о регистрации / Устав и учредительный договор / Список акционеров / Сертификат торговой палаты Аджмана / Договор аренды, стандартный офис  (1 год / 5 виз) / Техническое обслуживание офиса /  Общие услуги / Вывеска / Открытие миграционной карточки",
                        "nameEn" => "Original License/ Certificate of Incorporation/ Memorandum of Association / Shareholder List / Ajman Chamber of Commerce Certificate / Lease agreement (standard office 16 sq.m / 1 year / 5 visas) / Maintenance / General Services / Sign Board / Establishment Card"],
                ],
            ],
            2 => [
                0 => [
                    0 => ["name" => "Пройдена предварительная проверка контрагента", "nameEn" => "Performed Due Dilligence check"]
                ],

                1 => [
                    0 => ["name" => "Подтверждение и резервация наименования филиала (наименование филиала будет аналогичным наименованию материнской компании)", "nameEn" => "Branch name approval & reservation (the name of the branch will be similar to the name of the parent company)"],
                    1 => ["name" => "Получение разрешения от Иммиграционной службы на открытие филиала учредителем", "nameEn" => "Immigration approval of the shareholder"],
                ],

                2 => [
                    0 => ["name" => "Документы по вновь создаваемой компании находятся на рассмотрении у администрации СЭЗ", "nameEn" => "Documents for company formation are under review with the Authority"],
                ],

                3 => [
                    0 => [
                        "name" => "Оригинал лицензии / Свидетельство о регистрации / Устав и учредительный договор / Список акционеров / Сертификат торговой палаты Аджмана / Договор аренды, стандартный офис  (1 год / 5 виз) / Техническое обслуживание офиса /  Общие услуги / Вывеска / Открытие миграционной карточки",
                        "nameEn" => "Original License/ Certificate of Incorporation/ Memorandum of Association / Shareholder List / Ajman Chamber of Commerce Certificate / Lease agreement (standard office 16 sq.m / 1 year / 5 visas) / Maintenance / General Services / Sign Board / Establishment Card"],
                ],
            ],
            3 => [
                0 => [
                    0 => ["name" => "Пройдена предварительная проверка контрагента", "nameEn" => "Performed Due Dilligence check"]
                ],

                1 => [
                    0 => ["name" => "Подтверждение и резервация наименования филиала (наименование филиала будет аналогичным наименованию материнской компании)", "nameEn" => "Branch name approval & reservation (the name of the branch will be similar to the name of the parent company)"],
                    1 => ["name" => "Получение разрешения от Иммиграционной службы на открытие филиала учредителем", "nameEn" => "Immigration approval of the shareholder"],
                ],

                2 => [
                    0 => ["name" => "Документы по вновь создаваемой компании находятся на рассмотрении у администрации СЭЗ", "nameEn" => "Documents for company formation are under review with the Authority"],
                ],

                3 => [
                    0 => [
                        "name" => "Оригинал лицензии / Свидетельство о регистрации / Устав и учредительный договор / Список акционеров / Сертификат торговой палаты Аджмана / Договор аренды, стандартный офис  (1 год / 5 виз) / Техническое обслуживание офиса /  Общие услуги / Вывеска / Открытие миграционной карточки",
                        "nameEn" => "Original License/ Certificate of Incorporation/ Memorandum of Association / Shareholder List / Ajman Chamber of Commerce Certificate / Lease agreement (standard office 16 sq.m / 1 year / 5 visas) / Maintenance / General Services / Sign Board / Establishment Card"],
                ],
            ],
            4 => [
                0 => [
                    0 => ["name" => "Пройдена предварительная проверка контрагента", "nameEn" => "Performed Due Dilligence check"]
                ],

                1 => [
                    0 => ["name" => "Подтверждение и резервация наименования филиала (наименование филиала будет аналогичным наименованию материнской компании)", "nameEn" => "Branch name approval & reservation (the name of the branch will be similar to the name of the parent company)"],
                    1 => ["name" => "Получение разрешения от Иммиграционной службы на открытие филиала учредителем", "nameEn" => "Immigration approval of the shareholder"],
                ],

                2 => [
                    0 => ["name" => "Документы по вновь создаваемой компании находятся на рассмотрении у администрации СЭЗ", "nameEn" => "Documents for company formation are under review with the Authority"],
                ],

                3 => [
                    0 => [
                        "name" => "Оригинал лицензии / Свидетельство о регистрации / Устав и учредительный договор / Список акционеров / Сертификат торговой палаты Аджмана / Договор аренды, стандартный офис  (1 год / 5 виз) / Техническое обслуживание офиса /  Общие услуги / Вывеска / Открытие миграционной карточки",
                        "nameEn" => "Original License/ Certificate of Incorporation/ Memorandum of Association / Shareholder List / Ajman Chamber of Commerce Certificate / Lease agreement (standard office 16 sq.m / 1 year / 5 visas) / Maintenance / General Services / Sign Board / Establishment Card"],
                ],
            ],
            5 => [
                0 => [
                    0 => ["name" => "Пройдена предварительная проверка контрагента", "nameEn" => "Performed Due Dilligence check"]
                ],

                1 => [
                    0 => ["name" => "Подтверждение и резервация наименования филиала (наименование филиала будет аналогичным наименованию материнской компании)", "nameEn" => "Branch name approval & reservation (the name of the branch will be similar to the name of the parent company)"],
                    1 => ["name" => "Получение разрешения от Иммиграционной службы на открытие филиала учредителем", "nameEn" => "Immigration approval of the shareholder"],
                ],

                2 => [
                    0 => ["name" => "Документы по вновь создаваемой компании находятся на рассмотрении у администрации СЭЗ", "nameEn" => "Documents for company formation are under review with the Authority"],
                ],

                3 => [
                    0 => [
                        "name" => "Оригинал лицензии / Свидетельство о регистрации / Устав и учредительный договор / Список акционеров / Сертификат торговой палаты Аджмана / Договор аренды, стандартный офис  (1 год / 5 виз) / Техническое обслуживание офиса /  Общие услуги / Вывеска / Открытие миграционной карточки",
                        "nameEn" => "Original License/ Certificate of Incorporation/ Memorandum of Association / Shareholder List / Ajman Chamber of Commerce Certificate / Lease agreement (standard office 16 sq.m / 1 year / 5 visas) / Maintenance / General Services / Sign Board / Establishment Card"],
                ],
            ]
        );

        return $sampleResultsData;

    }
}