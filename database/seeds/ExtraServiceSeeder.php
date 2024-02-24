<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ExtraServiceSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $extraServiceList = [
      [
        'id' => 1,
        'code' => 'company',
        'name' => 'Регистрация Товарищества с ограниченной ответственностью (ТОО)',
        'description' => 'Регистрация компании в Казахстане — это процесс официальной регистрации бизнеса в соответствии с законодательством Республики Казахстан. Регистрация включает в себя предоставление необходимых документов и информации о компании в компетентные государственные органы, чтобы получить юридический статус и право на осуществление деятельности. Данная процедура является необходимым шагом для создания юридического лица и легального ведения бизнеса в стране.',
        'day_minimum' => 2,
        'cost_minimum' => 80000,
        'questionList' => [
          [
            'value' => 'Кто учредитель?',
            'order' => 1,
            'questionValueList' => [
              ['code' => 'founder_ind_rk', 'value' => 'Физ лицо, гражданин РК', 'cost' => 0, 'order' => 1],
              ['code' => 'founder_ind_eaeu', 'value' => 'Физ лицо, гражданин ЕАЭС', 'cost' => 10000, 'order' => 2],
              ['code' => 'founder_ind_non_eaeu', 'value' => 'Физ лицо, гражданин страны, не входящей в ЕАЭС', 'cost' => 15000, 'order' => 3],
              ['code' => 'founder_leg_rk', 'value' => 'Юр лицо, резидент РК', 'cost' => 20000, 'order' => 4],
              ['code' => 'founder_leg_eaeu', 'value' => 'Юр лицо, резидент ЕАЭС', 'cost' => 25000, 'order' => 5],
              ['code' => 'founder_leg_non_eaeu', 'value' => 'Юр лицо, резидент страны, не входящей в ЕАЭС', 'cost' => 40000, 'order' => 6],
            ]
          ],
          [
            'value' => 'Кто директор?',
            'order' => 2,
            'questionValueList' => [
              ['code' => 'director_rk', 'value' => 'Гражданин РК', 'cost' => 0, 'order' => 1],
              ['code' => 'director_eaeu', 'value' => 'Гражданин ЕАЭС', 'cost' => 10000, 'order' => 2],
              ['code' => 'director_non_eaeu', 'value' => 'Гражданин стран, не входящих в ЕАЭС', 'cost' => 20000, 'order' => 3],
            ]
          ],
          [
            'value' => 'Нужен ли банковский счет?',
            'order' => 3,
            'questionValueList' => [
              ['code' => 'bank_account_yes', 'value' => 'Да', 'cost' => 0, 'order' => 1],
              ['code' => 'bank_account_no', 'value' => 'Нет', 'cost' => 10000, 'order' => 2],
            ]
          ],
          [
            'value' => 'Нужно ли предоставление юридического адреса?',
            'order' => 4,
            'questionValueList' => [
              ['code' => 'legal_address_yes', 'value' => 'Да', 'cost' => 0, 'order' => 1],
              ['code' => 'legal_address_no', 'value' => 'Нет', 'cost' => 10000, 'order' => 2],
            ]
          ],
        ]
      ],

      [
        'id' => 2,
        'code' => 'iin',
        'name' => 'Получение Индивидуального Идентификационного Номера (ИИН)',
        'description' => '',
        'day_minimum' => 3,
        'cost_minimum' => 25000,
        'questionList' => [
          [
            'value' => 'Выберите физическое лицо к которому Вы  относитесь?',
            'order' => 1,
            'questionValueList' => [
              ['code' => 'founder_ind_eaeu', 'value' => 'Физ лицо, гражданин ЕАЭС', 'cost' => 25000, 'order' => 1],
              ['code' => 'founder_ind_non_eaeu', 'value' => 'Физ лицо, гражданин страны, не входящей в ЕАЭС', 'cost' => 30000, 'order' => 2],
            ]
          ],
        ]
      ],

      [
        'id' => 3,
        'code' => 'bin',
        'name' => 'Получение Бизнес Идентификационного Номера (БИН)',
        'description' => 'перед получением БИН, необходимо получить ИИН на первого руководителя компании',
        'day_minimum' => 3,
        'cost_minimum' => 30000,
        'questionList' => [
          [
            'value' => 'Выберите юридическое лицо к которому Вы  относитесь?',
            'order' => 1,
            'questionValueList' => [
              ['code' => 'founder_leg_eaeu', 'value' => 'Юр лицо, резидент ЕАЭС', 'cost' => 30000, 'order' => 1],
              ['code' => 'founder_leg_non_eaeu', 'value' => 'Юр лицо, резидент страны, не входящей в ЕАЭС', 'cost' => 35000, 'order' => 2],
            ]
          ],
        ]
      ],

      [
        'id' => 4,
        'code' => 'open_bank_account',
        'name' => 'Открытие банковского счета',
        'description' => 'Необходимо
        <ul>
        <li>наличие ИИН/БИН для нерезидентов</li>
        <li>учредительные документы ТОО</li>
        <li>наличие СИМ карты Казахстанского оператора</li>
        </ul>
        Комплайнс банка может запросить еще какие-либо документы
        ',
        'day_minimum' => 3,
        'cost_minimum' => 30000,
        'questionList' => [
          [
            'value' => 'Кому необходимо открыть банковский счет?',
            'order' => 1,
            'questionValueList' => [
              ['code' => 'open_bank_account_ind', 'value' => 'Физ лицо', 'cost' => 150000, 'order' => 1],
              ['code' => 'open_bank_account_leg', 'value' => 'Юр лицо', 'cost' => 150000, 'order' => 2],
            ]
          ],

          [
            'value' => 'Укажитете резидентсво?',
            'order' => 2,
            'questionValueList' => [
              ['code' => 'open_bank_account_rk', 'value' => 'Резидент РК', 'cost' => 150000, 'order' => 1],
              ['code' => 'open_bank_account_non_rk', 'value' => 'Не резидент РК', 'cost' => 150000, 'order' => 2],
            ]
          ],
          [
            'value' => 'Будет ли личное присутствие руководителя?',
            'order' => 2,
            'questionValueList' => [
              ['code' => 'open_bank_account_presence_manager_yes', 'value' => 'Да, будет', 'cost' => 150000, 'order' => 1],
              ['code' => 'open_bank_account_presence_manager_no', 'value' => 'Нет, не будет', 'cost' => 150000, 'order' => 2],
            ]
          ],
        ]
      ],

      [
        'id' => 5,
        'code' => 'ecp',
        'name' => 'Получение Электронно-Цифровой Подписи (ЭЦП) ',
        'description' => '<ul>
          <li>наличие ИИН для граждан ЕАЭС и нерезидентов (не входящие в ЕАЭС)</li>
          <li>наличие ИИН для граждан нерезидентов (не входящие в ЕАЭС)</li>
         </ul>',
        'day_minimum' => 3,
        'cost_minimum' => 10000,
        'questionList' => [
          [
            'value' => 'На кого необходимо получть ЭЦП?',
            'order' => 2,
            'questionValueList' => [
              ['code' => 'ecp_ind', 'value' => 'Физ лицо', 'cost' => 10000, 'order' => 1],
              ['code' => 'ecp_leg', 'value' => 'Юр лицо', 'cost' => 20000, 'order' => 2],
            ]
          ],
          [
            'value' => 'Выберите физическое лицо к которому Вы относитесь?',
            'order' => 2,
            'questionValueList' => [
              ['code' => 'ecp_ind_rk', 'value' => 'Физ лицо, гражданин РК', 'cost' => 0, 'order' => 1],
              ['code' => 'ecp_ind_eaeu', 'value' => 'Физ лицо, гражданин ЕАЭС', 'cost' => 0, 'order' => 2],
              ['code' => 'ecp_ind_non_eaeu', 'value' => 'Физ лицо, гражданин страны, не входящей в ЕАЭС', 'cost' => 0, 'order' => 3],
              ['code' => 'ecp_skip', 'value' => 'Пропустить', 'cost' => 0, 'order' => 4],
            ]
          ],
          [
            'value' => 'Выберите физическое лицо к которому Вы относитесь?',
            'order' => 2,
            'questionValueList' => [
              ['code' => 'ecp_leg_rk', 'value' => 'Юр лицо, резидент РК', 'cost' => 0, 'order' => 1],
              ['code' => 'ecp_leg_eaeu', 'value' => 'Юр лицо, резидент ЕАЭС', 'cost' => 0, 'order' => 2],
              ['code' => 'ecp_leg_non_eaeu', 'value' => 'Юр лицо, резидент страны, не входящей в ЕАЭС', 'cost' => 0, 'order' => 3],
              ['code' => 'ecp_skip', 'value' => 'Пропустить', 'cost' => 0, 'order' => 4],
            ]
          ],
        ]
      ],

      [
        'id' => 6,
        'code' => 'llp_change_documents',
        'name' => 'Внесение изменений и дополнений в учредительные документы ТОО',
        'description' => 'Услуга частично оказывается в электронном виде (изменение юридического адреса, изменение данных учредителя, смена руководителя)
            <ul>
              <li>ИИН нерезидентам РК</li>
              <li>нотариальный паспорт участников/директора с переводом на казахский язык для нерезидентов РК</li>
            </ul>
        ',
        'day_minimum' => 3,
        'cost_minimum' => 50000,
        'questionList' => [
          [
            'value' => 'Основание для внесения изменений и дополнений?',
            'order' => 2,
            'questionValueList' => [
              ['code' => 'llp_change_doc_leg_address', 'value' => 'изменение юридического адреса', 'cost' => 50000, 'order' => 1],
              ['code' => 'llp_change_doc_founder', 'value' => 'изменение данных учредителя, директора', 'cost' => 50000, 'order' => 2],
              ['code' => 'llp_change_doc_capital', 'value' => 'увеличение уставного капитала', 'cost' => 50000, 'order' => 3],
              ['code' => 'llp_change_other', 'value' => 'другие изменения', 'cost' => 50000, 'order' => 4],
            ]
          ],
          [
            'value' => 'Кто будет директором?',
            'order' => 2,
            'questionValueList' => [
              ['code' => 'llp_change_doc_ind_rk', 'value' => 'Физ лицо, гражданин РК', 'cost' => 0, 'order' => 1],
              ['code' => 'llp_change_doc_ind_eaeu', 'value' => 'Физ лицо, гражданин ЕАЭС', 'cost' => 0, 'order' => 2],
              ['code' => 'llp_change_doc_ind_non_eaeu', 'value' => 'Физ лицо, гражданин страны, не входящей в ЕАЭС', 'cost' => 0, 'order' => 3],
              ['code' => 'llp_change_skip', 'value' => 'Пропустить', 'cost' => 0, 'order' => 4],
            ]
          ],
        ]
      ],
      [
        'id' => 7,
        'code' => 'llp_reregistration',
        'name' => 'Государственная перерегистрация ТОО',
        'description' => 'Услуга оказывается в городе по месту регистрации товарищества
            <ul>
              <li>ИИН нерезидентам РК</li>
              <li>нотариальный паспорт участников/директора с переводом на казахский язык для нерезидентов РК</li>
            </ul>
        ',
        'day_minimum' => 3,
        'cost_minimum' => 50000,
        'questionList' => [
          [
            'value' => 'Основание перерегистрации?',
            'order' => 1,
            'questionValueList' => [
              ['code' => 'llp_reregistration_name', 'value' => 'изменение наименования', 'cost' => 50000, 'order' => 1],
              ['code' => 'llp_reregistration_capital', 'value' => 'уменьшение размера уставного капитала', 'cost' => 50000, 'order' => 2],
              ['code' => 'llp_reregistration', 'value' => 'изменение состава участников', 'cost' => 50000, 'order' => 3],
            ]
          ],
          [
            'value' => 'Сколько участников будет?',
            'order' => 2,
            'questionValueList' => [
              ['code' => 'llp_reregistration_cnt_one', 'value' => 'один', 'cost' => 0, 'order' => 1],
              ['code' => 'llp_reregistration_cnt_two', 'value' => 'два и более', 'cost' => 2, 'order' => 2],
            ]
          ],
          [
            'value' => 'Кто будет директором?',
            'order' => 2,
            'questionValueList' => [
              ['code' => 'llp_reregistration_ind_rk', 'value' => 'Физ лицо, гражданин РК', 'cost' => 0, 'order' => 1],
              ['code' => 'llp_reregistration_ind_eaeu', 'value' => 'Физ лицо, гражданин ЕАЭС', 'cost' => 0, 'order' => 2],
              ['code' => 'llp_reregistration_ind_non_eaeu', 'value' => 'Физ лицо, гражданин страны, не входящей в ЕАЭС', 'cost' => 0, 'order' => 3],
            ]
          ],
        ]
      ],
      [
        'id' => 8,
        'code' => 'visa_c3',
        'name' => 'Оформление приглашения на визу C3',
        'description' => 'Визу С 3 (не С 5) можно получить прямо в Казахстане, если их гражданам разрешено нахождение в стране без визы на определенный срок. Главное, чтобы успели оформить визу в срок безвизового пребывания. Поэтому до одобрения приглашения лучше не въезжать.
          Визу С 3 можно сделать сразу многократную, максимум до 3 лет (у Астана хаб и МФЦА до 5). Хотя сотрудники миграции советуют подавать не более чем на год, а потом продлевать, т.к. “скорее всего откажут”.
          <ul>
          <li>Отсутствие судимостей; заболеваний, въезд с которыми в Казахстан запрещен</li>
          <li>Паспорт (не должно возникать сомнений в подлинности, без отметок, в т.ч. о продлении действия, с как минимум 2 чистыми страницами и срок окончания действия не менее чем 3 месяца с даты окончания запрашиваемой визы)</li>
          <li>Наличие разрешения на привлечение иностранной рабочей силы (не требуется, чтобы назначить директором/зам. директора в компании со 100% иностранным участием. Даже если учредители не из той же страны)</li>
          </ul>
        ',
        'day_minimum' => 10,
        'cost_minimum' => 50000,
        'questionList' => [
          [
            'value' => 'Какое у Вас гражданство?',
            'order' => 1,
            'questionValueList' => [
              ['code' => 'visa_c3_eaeu', 'value' => 'Гражданин государства-члена ЕАЭС', 'cost' => 50000, 'order' => 1],
              ['code' => 'visa_c3_non_eaeu', 'value' => 'Гражданин другого государства', 'cost' => 50000, 'order' => 2],
            ]
          ],
          [
            'value' => 'Для каких целей необходима виза?',
            'order' => 2,
            'questionValueList' => [
              ['code' => 'visa_target_leg', 'value' => 'Участие в юр. лице (для этого нужен другой тип визы, здесь не рассматривается)', 'cost' => 0, 'order' => 1],
              ['code' => 'visa_target_non_leg', 'value' => 'Работа/назначение директором юр. лица', 'cost' => 0, 'order' => 2],
            ]
          ],
          [
            'value' => 'На какой срок нужна виза?',
            'order' => 3,
            'questionValueList' => [
              ['code' => 'visa_c3_target_time_min', 'value' => 'Минимально необходимый для указанной выше цели', 'cost' => 0, 'order' => 1],
              ['code' => 'visa_c3_target_time_max', 'value' => 'Планирую находиться в Казахстане', 'cost' => 0, 'order' => 2],
            ]
          ],
          [
            'value' => 'Владельцы Вашей компании - иностранцы?',
            'order' => 4,
            'questionValueList' => [
              ['code' => 'visa_c3_founder_non_rk', 'value' => 'У компании-работодателя 100% иностранное участие (неважно какое)', 'cost' => 0, 'order' => 1],
              ['code' => 'visa_c3_founder_rk', 'value' => 'Хотя бы 1% принадлежит казахстанцу/казахстанской компании', 'cost' => 0, 'order' => 2],
            ]
          ],
        ]
      ],
      [
        'id' => 9,
        'code' => 'visa_c5',
        'name' => 'Оформление приглашения на визу C5',
        'description' => 'Первоначально виза С5 предоставляется на 90 дней, однократная (аннулируется при выезде из страны). Впоследствии можно запросить продление до 1 года.
Мы оформляем приглашение на визу, сама виза выдается в консульстве РК в стране гражданства.
          <ul>
          <li>Отсутствие судимостей; заболеваний, въезд с которыми в Казахстан запрещен</li>
          <li>Паспорт (не должно возникать сомнений в подлинности, без отметок, в т.ч. о продлении действия, с как минимум 2 чистыми страницами и срок окончания действия не менее чем 3 месяца с даты окончания запрашиваемой визы)</li>
          </ul>
        ',
        'day_minimum' => 10,
        'cost_minimum' => 50000,
        'questionList' => [
          [
            'value' => 'Какое у Вас гражданство?',
            'order' => 1,
            'questionValueList' => [
              ['code' => 'visa_c5_eaeu', 'value' => 'Гражданин государства-члена ЕАЭС', 'cost' => 50000, 'order' => 1],
              ['code' => 'visa_c5_non_eaeu', 'value' => 'Гражданин другого государства', 'cost' => 50000, 'order' => 2],
            ]
          ],
          [
            'value' => 'Для каких целей необходима виза?',
            'order' => 2,
            'questionValueList' => [
              ['code' => 'visa_c5_target_leg', 'value' => 'хождение в состав участников уже существующего юр. лица', 'cost' => 0, 'order' => 1],
              ['code' => 'visa_c5_target_non_leg', 'value' => 'Работа/назначение директором юр. лица (для этого требуется другой тип визы, здесь не рассматривается)', 'cost' => 50000, 'order' => 2],
            ]
          ],
          [
            'value' => 'На какой срок нужна виза?',
            'order' => 3,
            'questionValueList' => [
              ['code' => 'visa_c5_target_time_min', 'value' => 'Минимально необходимый для указанной выше цели', 'cost' => 0, 'order' => 1],
              ['code' => 'visa_c5_target_time_max', 'value' => 'Планирую находиться в Казахстане', 'cost' => 50000, 'order' => 2],
            ]
          ],
        ]
      ],
      [
        'id' => 10,
        'code' => 'branch_registration',
        'name' => 'Регистрация филиала или представительства',
        'description' => '
          <ul>
            <li>Обязательно заполненная форма сведений на регистрацию филиала или представительства (данные заполняет клиент на сайте или по форме электронного формата предоставленой клиент-менеджером)</li>
            <li>Получение ИИН либо БИН для нерезидентов</li>
            <li>Получение ЭЦП при запросе клиента</li>
          </ul>
        ',
        'day_minimum' => 10,
        'cost_minimum' => 100000,
        'questionList' => [
          [
            'value' => 'Кто будет учреждать филиал/представительство?',
            'order' => 3,
            'questionValueList' => [
              ['code' => 'branch_registration_leg_rk', 'value' => 'Юр лицо резидент РК', 'cost' => 0, 'order' => 1],
              ['code' => 'branch_registration_leg_uaeu', 'value' => 'Юр лицо резидент ЕАЭС', 'cost' => 0, 'order' => 2],
              ['code' => 'branch_registration_leg_non_uaeu', 'value' => 'Юр лицо нерезидент (не входящие в ЕАЭС)', 'cost' => 0, 'order' => 3],
            ]
          ],
          [
            'value' => 'Кто будет Директором филиала/представительства?',
            'order' => 3,
            'questionValueList' => [
              ['code' => 'branch_registration_ind_rk', 'value' => 'Физ лицо резидент РК', 'cost' => 0, 'order' => 1],
              ['code' => 'branch_registration_ind_uaeu', 'value' => 'Физ лицо резидент ЕАЭС', 'cost' => 0, 'order' => 2],
              ['code' => 'branch_registration_ind_non_uaeu', 'value' => 'Физ лицо нерезидент (не входящие в ЕАЭС)', 'cost' => 0, 'order' => 3],
            ]
          ],
          [
            'value' => 'В каком городе Казахстана будет находится филиал/представительство?',
            'order' => 3,
            'questionValueList' => [
              ['code' => 'branch_registration_city_almaty', 'value' => 'Алматы, Астана, Караганда (есть возможность предоставления юр адреса за доп оплату)', 'cost' => 0, 'order' => 1],
              ['code' => 'branch_registration_city_other', 'value' => 'Ответ другие города Казахстана', 'cost' => 0, 'order' => 2],
            ]
          ],
        ]
      ]
    ];


    $extraServiceStepList = [
      [
        'id' => 1,
        'name' => 'Регистрация компании',
        'order' => 1,
        'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu'],
        'bodyList' => [
          [
            'name' => 'Заполнение формы на регистрацию ТОО',
            'dayCount' => 1,
            'result' => 'Собраны данные для регистрации ТОО',
            'order' => 1,
            'documentList' => [
              [
                'name' => 'Заполненная и подписанная форма на регистрацию ТОО',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu']
              ],
              [
                'name' => 'Копия удостоверения личности учредителя и директора ТОО',
                'questionValueList' => ['founder_ind_rk']
              ],
              [
                'name' => 'ЭЦП учредителя (-лей) ТОО',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu']
              ],
              [
                'name' => 'Копия удостоверения личности директора ТОО',
                'questionValueList' => ['founder_leg_rk']
              ],
              [
                'name' => 'Копии учредительных документов юр лица учреждающего ТОО: (решение/протокол, прика на Директора, Устав/учрдительный договор)',
                'questionValueList' => ['founder_leg_rk']
              ],
              [
                'name' => 'ЭЦП учредителя юр лица',
                'questionValueList' => ['founder_leg_rk', 'founder_leg_eaeu']
              ],
              [
                'name' => 'Копия загран паспорта учредителя и директора ТОО, бланк ИИН',
                'questionValueList' => ['founder_ind_eaeu']
              ],
              [
                'name' => 'Копия удостоверения личности/паспорт директора ТОО, бланк ИИН',
                'questionValueList' => ['founder_leg_eaeu', 'founder_leg_non_eaeu']
              ],
              [
                'name' => 'Копии учредительных документов юр лица учреждающего ТОО: <ul>
                            <li>Устав</li>
                            <li>Учредительный договор</li>
                            <li>Решение учредителя/Протокол общего собрания учредителей</li>
                            <li>Приказ на директора</li>
                            <li>Выписка ЕГРЮЛ</li>
                            <li>Документ подтверждающий постановку на налоговый учет в стране резидентства</li>
                            </ul>',
                'questionValueList' => ['founder_leg_eaeu']
              ],
              [
                'name' => 'Апостилированная/Легализованаая копия паспорта гражданина нерезидента, с нотариально заверенным переводом на русский и казахский язык, бланк ИИН',
                'questionValueList' => ['founder_ind_non_eaeu']
              ],
              [
                'name' => 'Апостилированные/Легализованые копии учредительных документов юр лица учреждающего ТОО: <ul>
                            <li>Документ подтверждающей государственную регистрацию в стране резидентства</li>
                            <li>Устав</li>
                            <li>Учредительный договор (при наличии)</li>
                            </ul>',
                'questionValueList' => ['founder_leg_non_eaeu']
              ],
            ]
          ],
          [
            'name' => 'Заполнение электронного уведомления о начале осуществления предпринимательской деятельности',
            'dayCount' => 1,
            'result' => 'Справка о государственной регистрации юридического лица',
            'order' => 2,
            'documentList' => []
          ],
          [
            'name' => 'Подготовка учредительных документов для ТОО',
            'dayCount' => 1,
            'result' => 'Справка о государственной регистрации юридического лица',
            'order' => 3,
            'documentList' => [
              [
                'name' => 'Решение/Проткол учредителя о создании ТОО',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu']
              ],
              [
                'name' => 'Приказ на руководителя',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu']
              ],
              [
                'name' => 'Устав ТОО/учредительный договор',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu']
              ],
              [
                'name' => 'Справка о государствееной регистрации юридического лица',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu']
              ],
              [
                'name' => 'Печать',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu']
              ],
              [
                'name' => 'ЭЦП полученное на ТОО после гос регистрации',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu']
              ],
            ]
          ],
        ],
      ],
      [
        'id' => 2,
        'name' => 'Получение БИН',
        'order' => 2,
        'questionValueList' => ['founder_leg_eaeu', 'founder_leg_non_eaeu'],
        'bodyList' => [
          [
            'name' => 'Предоставление данных от клиента',
            'dayCount' => 0,
            'result' => 'Готовый пакет документов для получения БИН',
            'order' => 1,
            'documentList' => [
              [
                'name' => 'Выписка из торгового реестра либо его аналога (ЕГРЮЛ) с нотариально заверенным переводом на казахский и русский язык',
                'questionValueList' => ['founder_leg_eaeu']
              ],
              [
                'name' => 'Копии учредительных документов: <ul>
                            <li>Устав</li>
                            <li>Учредительный договор (при наличии)</li>
                            <li>Решение учредителя/Протокол общего собрания учредителей</li>
                            <li>Приказ на директора</li>
                            <li>Документ подтверждающий постановку на налоговый учет в стране резидентства</li></ul>',
                'questionValueList' => ['founder_leg_eaeu']
              ],
              [
                'name' => 'Копия паспорта Руководителя гражданина ЕАЭС, юридического лица с нотариально заверенным переводом на казахский и русский язык',
                'questionValueList' => ['founder_leg_eaeu']
              ],
              [
                'name' => 'Доверенность от юридического лица – учредителя компании установленного образца на представителя нашей компании',
                'questionValueList' => ['founder_leg_eaeu']
              ],
            ]
          ],
          [
            'name' => 'Предоставление документов на получение БИН',
            'dayCount' => 3,
            'result' => 'Регистрационное свидетельство БИН для юридических лиц-нерезидентов',
            'order' => 2,
            'documentList' => [
              [
                'name' => 'документы от клиента (учр документы компании,паспорт,доверенность)',
                'questionValueList' => ['founder_leg_eaeu', 'founder_leg_non_eaeu']
              ],
            ]
          ]
        ]
      ],
      [
        'id' => 3,
        'name' => 'Получение ЭЦП',
        'order' => 3,
        'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu'],

        'bodyList' => [
          [
            'name' => 'Предоставление данных от клиента',
            'dayCount' => 1,
            'result' => 'Готовый пакет документов для получения ЭЦП',
            'order' => 1,
            'documentList' => [
              [
                'name' => 'удостоверение личности для гражданина РК',
                'questionValueList' => ['founder_ind_rk']
              ],
              [
                'name' => 'нотариальная доверенность на получение ЭЦП',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu']
              ],
              [
                'name' => 'Нотариально заверенная копия (выписка одной страницы) паспорта гражданина ЕАЭС, с нотариально заверенным переводом на русский и казахский язык',
                'questionValueList' => ['founder_ind_eaeu']
              ],
              [
                'name' => 'Апостилированная/Легализованаая копия паспорта гражданина нерезидента, с нотариально заверенным переводом на русский и казахский язык',
                'questionValueList' => ['founder_ind_non_eaeu']
              ],
              [
                'name' => 'Апостилированная/Легализованаая нотариальная доверенность на получение ЭЦП',
                'questionValueList' => ['founder_ind_non_eaeu']
              ],
            ]
          ],
          [
            'name' => 'Предоставление документов на получение ЭЦП',
            'dayCount' => 0,
            'result' => 'Готовая электронно-цифровая подпись (ЭЦП)',
            'order' => 2,
            'documentList' => [
              [
                'name' => 'заявка на получение ЭЦП (формируется на сайте https://pki.gov.kz)',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu']
              ],
              [
                'name' => 'документы от клиента (уд личности,паспорт,доверенность)',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu']
              ],
            ]
          ]
        ]
      ],
      [
        'id' => 4,
        'name' => 'Получение ИИН',
        'order' => 4,
        'questionValueList' => ['founder_ind_eaeu', 'founder_ind_non_eaeu'],
        'bodyList' => [
          [
            'name' => 'Предоставление данных от клиента',
            'dayCount' => 3,
            'result' => 'Готовый пакет документов для получения ИИН',
            'order' => 1,
            'documentList' => [
              [
                'name' => 'Нотариально заверенная копия (выписка одной страницы) паспорта гражданина ЕАЭС, с нотариально заверенным переводом на русский и казахский язык',
                'questionValueList' => ['founder_ind_eaeu']
              ],
              [
                'name' => 'Нотариальная доверенность на получение ИИН',
                'questionValueList' => ['founder_ind_eaeu']
              ],
              [
                'name' => 'Апостилированная/Легализованаая копия паспорта гражданина нерезидента, с нотариально заверенным переводом на русский и казахский язык',
                'questionValueList' => ['founder_ind_non_eaeu']
              ],
              [
                'name' => 'Апостилированная/Легализованаая нотариальная доверенность на получение ИИН',
                'questionValueList' => ['founder_ind_non_eaeu']
              ],
            ]
          ],
          [
            'name' => 'Предоставление документов на получение ИИН',
            'dayCount' => 3,
            'result' => 'получение бланка Индивидуального Идентификационного Номера (ИИН)',
            'order' => 2,
            'documentList' => [
              [
                'name' => 'документы от клиента (уд личности,паспорт,доверенность)',
                'questionValueList' => ['founder_ind_eaeu', 'founder_ind_non_eaeu']
              ],
            ]
          ]
        ]
      ],
      [
        'id' => 5,
        'name' => 'Получение Электронно-Цифровой Подписи (ЭЦП)',
        'order' => 5,
        'questionValueList' => ['ecp_ind_rk', 'ecp_ind_eaeu', 'ecp_ind_non_eaeu', 'ecp_leg_rk', 'ecp_leg_eaeu', 'ecp_leg_non_eaeu', 'founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu',],
        'bodyList' => [
          [
            'name' => 'Предоставление данных от клиента',
            'dayCount' => 1,
            'result' => 'Готовый пакет документов для получения ЭЦП',
            'order' => 1,
            'documentList' => [
              [
                'name' => 'удостоверение личности',
                'questionValueList' => ['ecp_ind_rk', 'ecp_leg_rk', 'founder_ind_rk', 'founder_leg_rk']
              ],
              [
                'name' => 'нотариальная доверенность на получение ЭЦП',
                'questionValueList' => ['ecp_ind_rk', 'ecp_leg_rk', 'founder_ind_rk', 'founder_leg_rk']
              ],
              [
                'name' => 'Нотариально заверенная копия (выписка одной страницы) паспорта гражданина ЕАЭС, с нотариально заверенным переводом на русский и казахский язык',
                'questionValueList' => ['ecp_ind_eaeu', 'ecp_leg_eaeu', 'founder_ind_eaeu', 'founder_leg_eaeu']
              ],
              [
                'name' => 'нотариальная доверенность на получение ЭЦП',
                'questionValueList' => ['ecp_ind_eaeu', 'ecp_leg_eaeu', 'founder_ind_eaeu', 'founder_leg_eaeu']
              ],
              [
                'name' => 'Апостилированная/Легализованаая копия паспорта гражданина нерезидента, с нотариально заверенным переводом на русский и казахский язык',
                'questionValueList' => ['ecp_ind_non_eaeu', 'ecp_leg_non_eaeu', 'founder_ind_non_eaeu', 'founder_leg_non_eaeu']
              ],
              [
                'name' => 'Апостилированная/Легализованаая нотариальная доверенность на получение ЭЦП',
                'questionValueList' => ['ecp_ind_non_eaeu', 'ecp_leg_non_eaeu', 'founder_ind_non_eaeu', 'founder_leg_non_eaeu']
              ],
            ]
          ],
          [
            'name' => 'Предоставление документов на получение ЭЦП',
            'dayCount' => 0,
            'result' => 'Готовая электронно-цифровая подпись (ЭЦП)',
            'order' => 2,
            'documentList' => [
              [
                'name' => 'заявка на получение ЭЦП (формируется на сайте https://pki.gov.kz)',
                'questionValueList' => ['ecp_ind_rk', 'ecp_ind_eaeu', 'ecp_ind_non_eaeu', 'ecp_leg_rk', 'ecp_leg_eaeu', 'ecp_leg_non_eaeu', 'founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu']
              ],
              [
                'name' => 'документы от клиента (уд личности,паспорт,доверенность)',
                'questionValueList' => ['ecp_ind_rk', 'ecp_ind_eaeu', 'ecp_ind_non_eaeu', 'ecp_leg_rk', 'ecp_leg_eaeu', 'ecp_leg_non_eaeu', 'founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu']
              ],
            ]
          ]
        ]
      ],
      [
        'id' => 6,
        'name' => 'Открытие банковского счета',
        'order' => 6,
        'questionValueList' => ['bank_account_yes', 'open_bank_account_ind', 'open_bank_account_leg'],
        'bodyList' => [
          [
            'name' => 'Предоставление данных от клиента',
            'dayCount' => 1,
            'result' => 'Собраны данные для проверки и обработки данных сотрудниками банка',
            'order' => 1,
            'documentList' => [
              [
                'name' => 'Копия удостоверения личности/паспорта гражданина ЕАЭС или иное',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_ind_non_eaeu', 'open_bank_account_ind']
              ],
              [
                'name' => 'Заполненый документ с образцами подписей и оттиска печати',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_ind_non_eaeu', 'open_bank_account_ind']
              ],
              [
                'name' => 'Согласие на сбор и обработку персональных данных',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_ind_non_eaeu', 'open_bank_account_ind']
              ],
              [
                'name' => 'Копии учредительных документов юридического лица',
                'questionValueList' => ['founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu', 'open_bank_account_leg']
              ],
              [
                'name' => 'Заполненый документ с образцами подписей и оттиска печати',
                'questionValueList' => ['founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu', 'open_bank_account_leg']
              ],
              [
                'name' => 'Согласие на сбор и обработку персональных данных',
                'questionValueList' => ['founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu', 'open_bank_account_leg']
              ],
              [
                'name' => 'Нотариально заверенная копия паспорта гражданина ЕАЭС, с нотариально заверенным переводом на русский и казахский язык',
                'questionValueList' => ['founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu', 'open_bank_account_leg']
              ],
              [
                'name' => 'Доверенность от юридического лица – учредителя компании установленного образца на представителя нашей компании либо Апостилированная/Легализованаая копия паспорта директора юридического лица с нотариально заверенным переводом на казахский и русский язык',
                'questionValueList' => ['founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu', 'open_bank_account_leg']
              ],
              [
                'name' => 'Апостилированная/Легализованаая Доверенность от юридического лица – учредителя компании установленного образца на представителя нашей компании с нотариально заверенным переводом на русский и казахский язык',
                'questionValueList' => ['founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu', 'open_bank_account_leg']
              ],
            ]
          ],
          [
            'name' => 'Подписание документов в банке (работа с менеджером банка)',
            'dayCount' => 1,
            'result' => 'Предоставление сведений с реквизитами открытого банковского счета',
            'order' => 2,
            'documentList' => [
              [
                'name' => 'пакет банковских документов',
                'questionValueList' => ['founder_ind_rk', 'founder_ind_eaeu', 'founder_ind_non_eaeu', 'founder_ind_non_eaeu', 'open_bank_account_ind', 'founder_leg_rk', 'founder_leg_eaeu', 'founder_leg_non_eaeu', 'open_bank_account_leg']
              ],
            ]
          ]
        ],
      ],
      [
        'id' => 7,
        'name' => 'Внесение изменений и дополнений в учредительные документы ТОО',
        'order' => 7,
        'questionValueList' => ['llp_change_doc_leg_address', 'llp_change_doc_founder', 'llp_change_doc_capital', 'llp_change_other'],
        'bodyList' => [
          [
            'name' => 'Заполнение формы сведений на внесение изменений и дополнений',
            'dayCount' => 1,
            'result' => 'Собраны  данные на внесение изменений и дополнений',
            'order' => 1,
            'documentList' => [
              [
                'name' => 'Заполненная и  форма сведений на внесение изменений и доплнений либо беседа с клиентом',
                'questionValueList' => ['llp_change_doc_leg_address', 'llp_change_doc_founder', 'llp_change_doc_capital', 'llp_change_other']
              ],
              [
                'name' => 'Копия удостоверения личности учредителя и директора ТОО',
                'questionValueList' => ['llp_change_doc_leg_address', 'llp_change_doc_founder', 'llp_change_doc_capital', 'llp_change_other']
              ],
              [
                'name' => 'Договор аренды/субаренды',
                'questionValueList' => ['llp_change_doc_leg_address', 'llp_change_doc_founder', 'llp_change_doc_capital', 'llp_change_other']
              ],
            ]
          ],
          [
            'name' => 'Сбор,подготовка и подача документов в регистрирующий орган',
            'dayCount' => 1,
            'result' => 'Уведомление с регистрирующего органа о внесении изменений и дополнений в ГБДЮЛ РК',
            'order' => 2,
            'documentList' => [
              [
                'name' => 'Информация с анкеты клиента',
                'questionValueList' => ['llp_change_doc_leg_address', 'llp_change_doc_founder', 'llp_change_doc_capital', 'llp_change_other']
              ],
            ]
          ],
          [
            'name' => 'Подготовка учредительных документов для ТОО',
            'dayCount' => 1,
            'result' => 'Выдача/отправка готовых документов клиенту',
            'order' => 3,
            'documentList' => [
              [
                'name' => 'Решение/протокол на внесение изменений и дополнений',
                'questionValueList' => ['llp_change_doc_leg_address', 'llp_change_doc_founder', 'llp_change_doc_capital', 'llp_change_other']
              ],
              [
                'name' => 'Приказ на руководителя',
                'questionValueList' => ['llp_change_doc_leg_address', 'llp_change_doc_founder', 'llp_change_doc_capital', 'llp_change_other']
              ],
              [
                'name' => 'Устав ТОО/учредительный договор',
                'questionValueList' => ['llp_change_doc_leg_address', 'llp_change_doc_founder', 'llp_change_doc_capital', 'llp_change_other']
              ],
              [
                'name' => 'Справка о регистрации (перерегистрации) юридических лиц',
                'questionValueList' => ['llp_change_doc_leg_address', 'llp_change_doc_founder', 'llp_change_doc_capital', 'llp_change_other']
              ],
            ]
          ]
        ]
      ],
      [
        'id' => 8,
        'name' => 'Государственная перерегистрация ТОО',
        'order' => 8,
        'questionValueList' => ['llp_reregistration_name', 'llp_reregistration_capital', 'llp_reregistration'],
        'bodyList' => [
          [
            'name' => 'Заполнение формы сведений на перерегистрацию ТОО',
            'dayCount' => 1,
            'result' => 'Собраны данные для перерегистрации ТОО',
            'order' => 1,
            'documentList' => [
              [
                'name' => 'Заполненная форма сведений на перерегистрацию ТОО либо беседа с клиентом',
                'questionValueList' => ['llp_reregistration_name', 'llp_reregistration_capital', 'llp_reregistration']
              ],
              [
                'name' => 'Копия удостоверения личности учредителя и директора ТОО',
                'questionValueList' => ['llp_reregistration_name', 'llp_reregistration_capital', 'llp_reregistration']
              ],
              [
                'name' => 'Договор купли-продажи или дарения',
                'questionValueList' => ['llp_reregistration_name', 'llp_reregistration_capital', 'llp_reregistration']
              ],
            ]
          ],
          [
            'name' => 'Сбор,подготовка и подача документов в регистрирующий орган',
            'dayCount' => 1,
            'result' => 'Собраны данные для перерегистрации ТОО',
            'order' => 1,
            'documentList' => [
              [
                'name' => 'пакет документов для перерегистрации: решение /протокол участников, ДКП, гос пошлина, уд личности/паспорт участника',
                'questionValueList' => ['llp_reregistration_name', 'llp_reregistration_capital', 'llp_reregistration']
              ],
            ]
          ],
          [
            'name' => 'Подготовка учредительных документов для ТОО',
            'dayCount' => 1,
            'result' => 'Выдача/отправка готовых документов клиенту',
            'order' => 1,
            'documentList' => [
              [
                'name' => 'Решение/протокол на перерегистрацию',
                'questionValueList' => ['llp_reregistration_name', 'llp_reregistration_capital', 'llp_reregistration']
              ],
              [
                'name' => 'Приказ на руководителя',
                'questionValueList' => ['llp_reregistration_name', 'llp_reregistration_capital', 'llp_reregistration']
              ],
              [
                'name' => 'Устав ТОО/учредительный договор',
                'questionValueList' => ['llp_reregistration_name', 'llp_reregistration_capital', 'llp_reregistration']
              ],
              [
                'name' => 'Справка о государствееной перерегистрации юридического лица',
                'questionValueList' => ['llp_reregistration_name', 'llp_reregistration_capital', 'llp_reregistration']
              ],
            ]
          ],
        ]
      ],
      [
        'id' => 9,
        'name' => 'Оформление приглашения на визу C3',
        'order' => 9,
        'questionValueList' => ['visa_c3_eaeu', 'visa_c3_non_eaeu'],
        'bodyList' => [
          [
            'name' => 'Сбор документов и оформление приглашения',
            'dayCount' => 5,
            'result' => 'Приглашение-анкета с номером визовой поддержки и печатью миграционной службы. Скан направляется клиенту для последующего оформления визы',
            'order' => 1,
            'documentList' => [
              [
                'name' => 'Доверенность на сотрудника, который подает документы',
                'questionValueList' => ['visa_c3_eaeu', 'visa_c3_non_eaeu']
              ],
              [
                'name' => 'Паспорт приглашаемого лица (скан)',
                'questionValueList' => ['visa_c3_eaeu', 'visa_c3_non_eaeu']
              ],
              [
                'name' => 'Квитанция об уплате гос. пошлины (необходимо произвести оплату 0,5 МРП от приглашающей компании, можно через отделение КазПочты)',
                'questionValueList' => ['visa_c3_eaeu', 'visa_c3_non_eaeu']
              ],
              [
                'name' => 'Таблица-анкета для приглашения в 3 экземплярах (сведения необходимо уточнить у клиента)',
                'questionValueList' => ['visa_c3_eaeu', 'visa_c3_non_eaeu']
              ],
              [
                'name' => 'Флешка с excel-файлом таблицы-анкеты (возвращается по завершении)',
                'questionValueList' => ['visa_c3_eaeu', 'visa_c3_non_eaeu']
              ],
              [
                'name' => 'Справка о гос. регистрации юр. лица',
                'questionValueList' => ['visa_c3_eaeu', 'visa_c3_non_eaeu']
              ],
              [
                'name' => 'Справка о 100% иностранном участии (запрашивается в управлении регистрации юр. лиц. Это если участие полностью иностранное)',
                'questionValueList' => ['visa_c3_eaeu', 'visa_c3_non_eaeu']
              ],
              [
                'name' => 'Трудовой договор, Решение и Приказ на директора с “живой” печатью',
                'questionValueList' => ['visa_c3_eaeu', 'visa_c3_non_eaeu']
              ],
            ]
          ],
          [
            'name' => 'Оформление визы в консульстве РК',
            'dayCount' => 5,
            'result' => 'Приглашение-анкета с номером визовой поддержки и печатью миграционной службы. Скан направляется клиенту для последующего оформления визы',
            'order' => 2,
            'documentList' => [
              [
                'name' => 'Визовая анкета с фото 3.5х4.5 см',
                'questionValueList' => ['visa_c3_eaeu', 'visa_c3_non_eaeu']
              ],
              [
                'name' => 'Паспорт (не должно возникать сомнений в подлинности, без отметок, в т.ч. о продлении действия, с как минимум 2 чистыми страницами и срок окончания действия не менее чем 3 месяца с даты окончания получаемой визы)',
                'questionValueList' => ['visa_c3_eaeu', 'visa_c3_non_eaeu']
              ],
              [
                'name' => 'Квитанция об уплате гос. пошлины (7 МРП, 30 МРП если многократная)',
                'questionValueList' => ['visa_c3_eaeu', 'visa_c3_non_eaeu']
              ],
              [
                'name' => 'Распечатанная копия приглашения с номером и датой',
                'questionValueList' => ['visa_c3_eaeu', 'visa_c3_non_eaeu']
              ],
            ]
          ]
        ]
      ],
      [
        'id' => 10,
        'name' => 'Оформление приглашения на визу C5',
        'order' => 10,
        'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu'],
        'bodyList' => [
          [
            'name' => 'Сбор документов и оформление приглашения',
            'dayCount' => 5,
            'result' => 'Приглашение-анкета с номером визовой поддержки и печатью миграционной службы. Скан направляется клиенту для последующего оформления визы',
            'order' => 1,
            'documentList' => [
              [
                'name' => 'Доверенность на сотрудника, который подает документы',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
              [
                'name' => 'Паспорт приглашаемого лица (скан)',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
              [
                'name' => 'Квитанция об уплате гос. пошлины (необходимо произвести оплату 0,5 МРП от приглашающей компании, можно через отделение КазПочты)',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
              [
                'name' => 'Таблица-анкета для приглашения в 3 экземплярах (сведения необходимо уточнить у клиента)',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
              [
                'name' => 'Флешка с excel-файлом таблицы-анкеты (возвращается по завершении)',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
              [
                'name' => 'Справка о гос. регистрации юр. лица',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
            ]
          ],
          [
            'name' => 'Оформление визы в консульстве РК',
            'dayCount' => 5,
            'result' => 'Виза в заграничном паспорте',
            'order' => 2,
            'documentList' => [
              [
                'name' => 'Визовая анкета с фото 3.5х4.5 см',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
              [
                'name' => 'Паспорт (не должно возникать сомнений в подлинности, без отметок, в т.ч. о продлении действия, с как минимум 2 чистыми страницами и срок окончания действия не менее чем 3 месяца с даты окончания получаемой визы)',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
              [
                'name' => 'Квитанция об уплате гос. пошлины (7 МРП, 30 МРП если многократная)',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
              [
                'name' => 'Распечатанная копия приглашения с номером и датой',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
              [
                'name' => 'Мед. Справка об отсутствии заболеваний, с которыми въезд в РК запрещен',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
              [
                'name' => 'Мед. Страховка',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
              [
                'name' => 'Справка об отсутствии судимостей',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
              [
                'name' => 'Справка об отсутствии запрета на предпринимательскую деятельность',
                'questionValueList' => ['visa_c5_eaeu', 'visa_c5_non_eaeu']
              ],
            ]
          ],
          [
            'name' => 'Регистрация юр. лица/вхождение в состав участников',
            'dayCount' => 5,
            'result' => 'В течение 2 месяцев необходимо все оформить и внести долю в уставный капитал. Хотя сами миграционные сотрудники говорят что не следят за этим, главное покинуть страну по окончании визы.
Получение этой визы нужно, даже если сам иностранец в страну не приезжает. Если иностранец действительно приезжает в Казахстан, то необходимо от приглашающей компании подать уведомление о прибытии иностранца через визово-миграционный портал либо (сложнее) ехать с оригиналом паспорта в отдел миграционной полиции по району проживания иностранца',
            'order' => 3,
            'documentList' => []
          ]
        ]
      ],
      [
        'id' => 11,
        'name' => 'Регистрация филиала или представительства',
        'order' => 11,
        'questionValueList' => ['branch_registration_leg_rk', 'branch_registration_leg_uaeu', 'branch_registration_leg_non_uaeu'],
        'bodyList' => [
          [
            'name' => 'Заполнение формы на регистрацию филиала/представительства',
            'dayCount' => 1,
            'result' => 'Собраны  данные для регистрации филиала/представительства',
            'order' => 1,
            'documentList' => [
              [
                'name' => 'Заполненная и подписанная форма сведений на регистрацию филиала/представительства',
                'questionValueList' => ['branch_registration_leg_rk', 'branch_registration_leg_uaeu', 'branch_registration_leg_non_uaeu']
              ],
              [
                'name' => 'Копия удостоверения личности/паспорта директора филиала/представительства',
                'questionValueList' => ['branch_registration_leg_rk', 'branch_registration_leg_uaeu', 'branch_registration_leg_non_uaeu']
              ],
              [
                'name' => 'Копии учредительных документов юр лица учредителя филиала/представительства',
                'questionValueList' => ['branch_registration_leg_rk', 'branch_registration_leg_uaeu', 'branch_registration_leg_non_uaeu']
              ],
            ]
          ],
          [
            'name' => 'Сдача документов в регистрирующий орган',
            'dayCount' => 30,
            'result' => 'Справка о государственной регистрации филиала/представительства',
            'order' => 2,
            'documentList' => [
              [
                'name' => 'Информация с анкеты клиента',
                'questionValueList' => ['branch_registration_leg_rk', 'branch_registration_leg_uaeu', 'branch_registration_leg_non_uaeu']
              ],
              [
                'name' => 'формирование пакета документов',
                'questionValueList' => ['branch_registration_leg_rk', 'branch_registration_leg_uaeu', 'branch_registration_leg_non_uaeu']
              ],
              [
                'name' => 'оплата гос пошлины',
                'questionValueList' => ['branch_registration_leg_rk', 'branch_registration_leg_uaeu', 'branch_registration_leg_non_uaeu']
              ],
            ]
          ],
          [
            'name' => 'Подготовка учредительных документов филиала/представительства',
            'dayCount' => 1,
            'result' => 'Подготовка учредительных документов филиала/представительства',
            'order' => 3,
            'documentList' => [
              [
                'name' => 'Решение  о создании филиала/представительства',
                'questionValueList' => ['branch_registration_leg_rk', 'branch_registration_leg_uaeu', 'branch_registration_leg_non_uaeu']
              ],
              [
                'name' => 'Приказ на руководителя',
                'questionValueList' => ['branch_registration_leg_rk', 'branch_registration_leg_uaeu', 'branch_registration_leg_non_uaeu']
              ],
              [
                'name' => 'Генеральная доверенность на руководителя филиала',
                'questionValueList' => ['branch_registration_leg_rk', 'branch_registration_leg_uaeu', 'branch_registration_leg_non_uaeu']
              ],
              [
                'name' => 'Положение филиала/представительства',
                'questionValueList' => ['branch_registration_leg_rk', 'branch_registration_leg_uaeu', 'branch_registration_leg_non_uaeu']
              ],
              [
                'name' => 'Справка о государственной регистрации филиала/представительства',
                'questionValueList' => ['branch_registration_leg_rk', 'branch_registration_leg_uaeu', 'branch_registration_leg_non_uaeu']
              ],
              [
                'name' => 'Печать',
                'questionValueList' => ['branch_registration_leg_rk', 'branch_registration_leg_uaeu', 'branch_registration_leg_non_uaeu']
              ],
            ]
          ]
        ]
      ]
    ];

    Schema::disableForeignKeyConstraints();
    \Illuminate\Support\Facades\DB::table('extra_services_question_maps')->truncate();

    \Illuminate\Support\Facades\DB::table('extra_services_question_documents')->truncate();
    \Illuminate\Support\Facades\DB::table('extra_services_documents')->truncate();

    $stepBodyList = \Illuminate\Support\Facades\DB::table('extra_services_step_bodes')->get();
    if ($stepBodyList) {
      \Illuminate\Support\Facades\DB::table('service_step')->whereIn('id', $stepBodyList->pluck('service_step_id'))->delete();
    }

    $stepHeaderList = \Illuminate\Support\Facades\DB::table('extra_services_step_headers')->get();
    if ($stepHeaderList) {
      \Illuminate\Support\Facades\DB::table('service')->whereIn('id', $stepHeaderList->pluck('service_id'))->delete();
    }
    \Illuminate\Support\Facades\DB::table('extra_services_step_bodes')->truncate();
    \Illuminate\Support\Facades\DB::table('extra_services_step_headers')->truncate();

    \Illuminate\Support\Facades\DB::table('extra_service_question_values')->truncate();
    \Illuminate\Support\Facades\DB::table('extra_service_questions')->truncate();
    \Illuminate\Support\Facades\DB::table('extra_services')->truncate();
    Schema::enableForeignKeyConstraints();

    foreach ($extraServiceList as $data) {
      \App\Data\ExtraService\Model\ExtraService::query()->create([
        'id' => $data['id'],
        'code' => $data['code'],
        'name' => $data['name'],
        'description' => $data['description'],
        'day_minimum' => $data['day_minimum'],
        'cost_minimum' => $data['cost_minimum']
      ]);

      foreach ($data['questionList'] as $question) {
        $extraServiceQuestion = \App\Data\ExtraService\Model\ExtraServiceQuestion::query()->create([
          'extra_service_id' => $data['id'],
          'value' => $question['value'],
          'order' => $question['order'],
        ]);

        foreach ($question['questionValueList'] as $questionValue) {
          \App\Data\ExtraService\Model\ExtraServiceQuestionValue::query()->create([
            'extra_service_question_id' => $extraServiceQuestion->id,
            'code' => $questionValue['code'],
            'value' => $questionValue['value'],
            'cost' => $questionValue['cost'],
            'order' => $questionValue['order'],
          ]);
        }
      }
    }

    foreach ($extraServiceStepList as $extraServiceStep) {

      \Illuminate\Support\Facades\DB::table('service')->insert([
        'service_thematic_group_id' => 82,
        'code' => 'KZ_E_000' . $extraServiceStep['id'],
        'name' => $extraServiceStep['name'],
        'description' => $extraServiceStep['name'],
        'comment' => $extraServiceStep['name'],
        'execution_days_from' => 0,
        'execution_days_to' => 0,
        'is_active' => 0,
        'service_start_date' => '2023-12-01',
        'service_end_date' => null,
        'counter_type_id' => 1,
        'service_type_id' => 1,
      ]);
      $service = Illuminate\Support\Facades\DB::table('service')->where('code', 'KZ_E_000' . $extraServiceStep['id'])->first();

      \App\Data\ExtraService\Model\ExtraServicesStepHeaders::query()->create([
        'id' => $extraServiceStep['id'],
        'name' => $extraServiceStep['name'],
        'order' => $extraServiceStep['order'],
        'service_id' => $service->id
      ]);

      foreach ($extraServiceStep['questionValueList'] as $questionValue) {
        $questionValueItem = \App\Data\ExtraService\Model\ExtraServiceQuestionValue::query()->where('code', '=', $questionValue)->first();

        \App\Data\ExtraService\Model\ExtraServicesQuestionMap::query()->create([
          'extra_service_question_value_id' => $questionValueItem->id,
          'extra_services_step_header_id' => $extraServiceStep['id']
        ]);
      }

      $i = 1;
      foreach ($extraServiceStep['bodyList'] as $body) {
        //todo add service_step row
        $serviceStepId = \Illuminate\Support\Facades\DB::table('service_step')->insertGetId([
          'description' => $body['name'],
          'execution_work_day_cnt' => $body['dayCount'],
          'counter_type_id' => 12,
          'execution_time_plan' => 0,
          'execution_parallel_no' => $i++,
          'license_type_id' => 1
        ]);

        $createdBody = \App\Data\ExtraService\Model\ExtraServicesStepBodes::query()->create([
          'extra_services_step_header_id' => $extraServiceStep['id'],
          'name' => $body['name'],
          'dayCount' => $body['dayCount'],
          'result' => $body['result'],
          'order' => $body['order'],
          'service_step_id' => $serviceStepId
        ]);

        foreach ($body['documentList'] as $document) {
          $createdDocument = \App\Data\ExtraService\Model\ExtraServicesDocuments::query()->create([
            'name' => $document['name'],
//            'path' => ''
          ]);

          foreach ($document['questionValueList'] as $questionValue) {
            $questionValueItem = \App\Data\ExtraService\Model\ExtraServiceQuestionValue::query()->where('code', '=', $questionValue)->first();
            \App\Data\ExtraService\Model\ExtraServicesQuestionDocuments::query()->create([
              'extra_services_document_id' => $createdDocument->id,
              'extra_service_question_value_id' => $questionValueItem->id,
              'extra_services_step_body_id' => $createdBody->id
            ]);
          }
        }
      }

    }
  }
}
