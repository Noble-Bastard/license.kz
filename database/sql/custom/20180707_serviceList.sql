--delete from service_step_required_document
--where service_step_id in(
--  select id
--  from service_step
--  where service_id in (
--    select id
--    from service
--    where code in ('100','110','120','130','140','150','160','170','180','190','200','210','220','230','240','250','260','270','280','290')
--  )
--);

--delete from service_step_result
--where service_step_id in(
--  select id
--  from service_step
--  where service_id in (
--    select id
--    from service
--    where code in ('100','110','120','130','140','150','160','170','180','190','200','210','220','230','240','250','260','270','280','290')
--  )
--);

--delete from service_step_cost_hist
--where service_step_id in(
--  select id
--  from service_step
--  where service_id in (
--    select id
--    from service
--    where code in ('100','110','120','130','140','150','160','170','180','190','200','210','220','230','240','250','260','270','280','290')
--  )
--);

--delete from service_step
--where service_id in (
--  select id from service
--  where code in ('100','110','120','130','140','150','160','170','180','190','200','210','220','230','240','250','260','270','280','290')
--);

--delete  from service
--where code in ('100','110','120','130','140','150','160','170','180','190','200','210','220','230','240','250','260','270','280','290');

--delete from service_thematic_group where id > 3;
--delete from service_category where id > 9;



use master
GO

set nocount on;

--xls data init
--=================================

drop TABLE IF EXISTS [dbo].[20180707_serviceList];

CREATE TABLE [dbo].[20180707_serviceList](
	[RowNo] [float] NULL,
	[ServiceCategory] [nvarchar](max) NULL,
	[ServiceThematicGroup] [nvarchar](max) NULL,
	[ServiceNo] [float] NULL,
	[ServiceName] [nvarchar](max) NULL,
	[ServiceStepName] [nvarchar](max) NULL,
	[ServiceStepRequiredDocument] [nvarchar](max) NULL,
	[ServiceStepDocument] [nvarchar](max) NULL,
	[ExecutionWorkDaysCnt] [float] NULL,
	[ServiceStepResult] [nvarchar](max) NULL,
	[FromCost] [float] NULL,
	[ToCost] [float] NULL,
	[Currency] [nvarchar](255) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]


insert into  [dbo].[20180707_serviceList]
(
	[RowNo],
	[ServiceCategory],
	[ServiceThematicGroup],
	[ServiceNo],
	[ServiceName],
	[ServiceStepName],
	[ServiceStepRequiredDocument],
	[ServiceStepDocument],
	[ExecutionWorkDaysCnt],
	[ServiceStepResult],
	[FromCost],
	[ToCost],
	[Currency]
)
select 1 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация бизнеса' as [ServiceThematicGroup],100 as [ServiceNo],N'Получение Индивидуального Идентификационного Номера (ИИН) и Электронно-цифровой подписи (ЭЦП)  для граждан физ.лиц стран-участников ЕВРАЗЭС' as [ServiceName],N'Получение ИИН  ' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'' as [ServiceStepDocument],3 as [ExecutionWorkDaysCnt],N'Получение свидетельства ИИН  ' as [ServiceStepResult],'25000' as [FromCost],'25000' as [ToCost],N'KZT' as  [Currency]
union all select 2 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация бизнеса' as [ServiceThematicGroup],100 as [ServiceNo],N'Получение Индивидуального Идентификационного Номера (ИИН) и Электронно-цифровой подписи (ЭЦП)  для граждан физ.лиц стран-участников ЕВРАЗЭС' as [ServiceName],N'Получение ЭЦП' as [ServiceStepName], N'Нотариально заверенная копия паспорта учредителя гражданина страны-участника ЕВРАЗЭС, с нотариально заверенным переводом на русский и казахский язык#
Нотариально заверенная доверенность от учредителя на получение ИИН и ЭЦП установленного образца  на представителя Ipravo#' as [ServiceStepRequiredDocument],N'Шаблон доверенности' as [ServiceStepDocument],3 as [ExecutionWorkDaysCnt],N'Получение ЭЦП на гражданина ЕВРАЗЭС' as [ServiceStepResult],'10000' as [FromCost],'10000' as [ToCost],N'KZT' as  [Currency]
union all select 3 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация бизнеса' as [ServiceThematicGroup],110 as [ServiceNo],N'Получение Индивидуального Идентификационного Номера (ИИН) и Электронно-цифровой подписи (ЭЦП)  для (иностранных)  граждан физ.лиц нерезидентов' as [ServiceName],N'Получение ИИН       ' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Шаблон доверенности' as [ServiceStepDocument],3 as [ExecutionWorkDaysCnt],N'Получение свидетельства ИИН  ' as [ServiceStepResult],'25000' as [FromCost],'25000' as [ToCost],N'KZT' as  [Currency]
union all select 4 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация бизнеса' as [ServiceThematicGroup],110 as [ServiceNo],N'Получение Индивидуального Идентификационного Номера (ИИН) и Электронно-цифровой подписи (ЭЦП)  для (иностранных)  граждан физ.лиц нерезидентов' as [ServiceName],N'Получение ЭЦП' as [ServiceStepName], N'Апостилированная/Легализованаая доверенность от учредителя на получение ИИН и ЭЦП установленного образца  на представителя Ipravo.#Апостилированная/Легализованаая доверенность от учредителя на получение ИИН и ЭЦП установленного образца  на представителя Ipravo#' as [ServiceStepRequiredDocument],N'Шаблон доверенности' as [ServiceStepDocument],3 as [ExecutionWorkDaysCnt],N'Получение ЭЦП на учредителя и директора (иностранного) гражданина нерезидента ' as [ServiceStepResult],'10000' as [FromCost],'10000' as [ToCost],N'KZT' as  [Currency]
union all select 5 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация бизнеса' as [ServiceThematicGroup],120 as [ServiceNo],N'Получение Бизнес Идентификационного Номера (БИН) и Электронно-цифровой подписи (ЭЦП)  для граждан физ.лиц стран-участников ЕВРАЗЭС' as [ServiceName],N'Получение БИН    ' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Шаблон доверенности' as [ServiceStepDocument],3 as [ExecutionWorkDaysCnt],N'Получение свидетельства БИН ' as [ServiceStepResult],'30000' as [FromCost],'30000' as [ToCost],N'KZT' as  [Currency]
union all select 6 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация бизнеса' as [ServiceThematicGroup],120 as [ServiceNo],N'Получение Бизнес Идентификационного Номера (БИН) и Электронно-цифровой подписи (ЭЦП)  для граждан физ.лиц стран-участников ЕВРАЗЭС' as [ServiceName],N'Получение ЭЦП' as [ServiceStepName], N'Выписка из торгового реестра либо его аналога (ЕГРЮЛ) с нотариально заверенным переводом на казахский и русский язык#
Копии учредительных документов: 
-Устав;
-Учредительный договор; 
-Решение учредителя/Протокол общего собрания учредителей; 
-Приказ на директора; 
-Документ подтверждающий постановку на налоговый учет в стране резидентства#
Копия паспорта директора гражданина ЕВРАЗЭС, юридического лица с нотариально заверенным переводом на казахский и русский язык#
 Доверенность от юридического лица – учредителя компании установленного образца на представителя Ipravo#' as [ServiceStepRequiredDocument],N'Шаблон доверенности' as [ServiceStepDocument],3 as [ExecutionWorkDaysCnt],N'Получение ЭЦП на юридическое лицо - учредителя' as [ServiceStepResult],'15000' as [FromCost],'15000' as [ToCost],N'KZT' as  [Currency]
union all select 7 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация бизнеса' as [ServiceThematicGroup],130 as [ServiceNo],N'Получение Бизнес Идентификационного Номера (БИН) и Электронно-цифровой подписи (ЭЦП)  для (иностранных)  граждан юр.лиц нерезидентов' as [ServiceName],N'Получение БИН    ' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Шаблон доверенности' as [ServiceStepDocument],3 as [ExecutionWorkDaysCnt],N'Получение свидетельства БИН для гражданина физ.лица стран-участников ЕВРАЗЭС' as [ServiceStepResult],'30000' as [FromCost],'30000' as [ToCost],N'KZT' as  [Currency]
union all select 8 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация бизнеса' as [ServiceThematicGroup],130 as [ServiceNo],N'Получение Бизнес Идентификационного Номера (БИН) и Электронно-цифровой подписи (ЭЦП)  для (иностранных)  граждан юр.лиц нерезидентов' as [ServiceName],N'Получение ЭЦП' as [ServiceStepName], N'Апостилированные/Легализованые копии учредительных документов (иностранного) юридичекого лица нерезидента, с нотариально заверенным переводом на русский и казахский язык:                                                                                                                                                    - Документ подтверждающей государственную регистрацию в стране резидентства; 
-Устав;
-Учредительный договор (при наличии); 
-Решение учредителя/Протокол общего собрания учредителей; 
-Приказ на директора; 
-Документ подтверждающий постановку на налоговый учет в стране резидентства с нотариально заверенным переводом на казахский и русский язык#
Апостилированная/Легализованаая копия паспорта директора юридического лица с нотариально заверенным переводом на казахский и русский язык#                                                                                                                                                                                                 Апостилированная/Легализованаая Доверенность от юридического лица – учредителя компании установленного образца на представителя Ipravo с нотариально заверенным переводом на русский и казахский язык#' as [ServiceStepRequiredDocument],N'Шаблон доверенности' as [ServiceStepDocument],3 as [ExecutionWorkDaysCnt],N'Получение ЭЦП для гражданина физ.лица стран-участников ЕВРАЗЭС' as [ServiceStepResult],'15000' as [FromCost],'15000' as [ToCost],N'KZT' as  [Currency]
union all select 9 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация бизнеса' as [ServiceThematicGroup],140 as [ServiceNo],N'Предоставление юридического адреса' as [ServiceName],N'1 этап' as [ServiceStepName], N'Копии учредительных документов юридического лица# Реквизиты юридического лица#' as [ServiceStepRequiredDocument],N'Договор субаренды помещения' as [ServiceStepDocument],2 as [ExecutionWorkDaysCnt],N'Предоставление юридического адреса ' as [ServiceStepResult],'30000' as [FromCost],'30000' as [ToCost],N'KZT' as  [Currency]
union all select 10 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация бизнеса' as [ServiceThematicGroup],150 as [ServiceNo],N'Открытие банковского счета для ТОО (РК)' as [ServiceName],N'1 этап' as [ServiceStepName], N'Копии учредительных документов юридического лица#                                       Заполненый документ с образцами подписей и оттиска печати#                                                    ' as [ServiceStepRequiredDocument],N'Нотариальная доверенность на представителя Ipravo. ' as [ServiceStepDocument],2 as [ExecutionWorkDaysCnt],N'Открытый счет в Альфа-Банке' as [ServiceStepResult],'5000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 11 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация бизнеса' as [ServiceThematicGroup],160 as [ServiceNo],N'Открытие банковского счета для ТОО (ЕВРАЗЭС)' as [ServiceName],N'1 этап' as [ServiceStepName], N'Копии учредительных документов юридического лица#                                       Заполненый документ с образцами подписей и оттиска печати#                                          Согласие на сбор и обработку персональных данных#                                           Сопроводительное письмо#                                                                             Нотариально заверенная копия паспорта учредителя гражданина страны-участника ЕВРАЗЭС, с нотариально заверенным переводом на русский и казахский язык#' as [ServiceStepRequiredDocument],N'Нотариальная доверенность на представителя Ipravo. ' as [ServiceStepDocument],2 as [ExecutionWorkDaysCnt],N'Открытый счет в Альфа-Банке' as [ServiceStepResult],'5000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 12 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация бизнеса' as [ServiceThematicGroup],170 as [ServiceNo],N'Открытие банковского счета для ТОО (Нерезидент)' as [ServiceName],N'1 этап' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Нотариальная доверенность на представителя Ipravo. ' as [ServiceStepDocument],2 as [ExecutionWorkDaysCnt],N'Открытый счет в Альфа-Банке' as [ServiceStepResult],'5000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 13 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],180 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин РК' as [ServiceName],N'Получение ЭЦП на учредителя (физ.лицо РК)' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],3 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
                           - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'20000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 14 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],180 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин РК' as [ServiceName],N'Регистрация ТОО' as [ServiceStepName], N'см. услугу получение ЭЦП на учредителя (на физ.лицо РК)#                                  Копия удостоверения личности учредителя#      
Копия удостоверения личности директора#      
Заполненная форма по регистрации ТОО#      ' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],3 as [ExecutionWorkDaysCnt],N'ЭЦП (Электронно-Цифровая Подпись) на компанию' as [ServiceStepResult],'20000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 15 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],190 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин ЕВРАЗЭС' as [ServiceName],N'Получение ИИН на Директора гр. ЕВРАЗЭС' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'20000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 16 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],190 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин ЕВРАЗЭС' as [ServiceName],N'Получение ЭЦП на учредителя (физ.лицо РК)' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'20000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 17 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],190 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин ЕВРАЗЭС' as [ServiceName],N'Регистрация ТОО' as [ServiceStepName], N'См. услугу получение ИИН (ЕВРАЗЭС)#                                                                                                                                                                                                                                         См. услугу получение ЭЦП на учредителя (на физ.лицо РК)#                                                                                                                                                                                                                               Регистрация ТОО:                                                                                                   - Копия паспорта директора гражданина страны-участника ЕВРАЗЭС с нотариально заверенным переводом на казахский и русский язык;
- Копия удостоверения личности учредителя гражданина Республики Казахстан;
- Заполненная форма по регистрации ТОО#   
' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'20000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 18 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],200 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин нерезидент' as [ServiceName],N'Получение ИИН на нерезидента' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'доверенность от юридического лица#   учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности#' as [ServiceStepResult],'50000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 19 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],200 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин нерезидент' as [ServiceName],N'Получение ЭЦП на учредителя (физ.лицо РК)' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности#' as [ServiceStepResult],'50000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 20 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],200 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин РК, директор гражданин нерезидент' as [ServiceName],N'Регистрация ТОО' as [ServiceStepName], N'См. услугу получение ИИН (на нерезидента)#                                                                                                                                                                                                                                         См. услугу получение ЭЦП на учредителя (на физ.лицо РК)#                                                                                                                                                                                                                             Регистрация ТОО:                                                                                                   - Легализованная/Апостилированная копия паспорта, с нотариально заверенным переводом на казахский и русский язык;
- Копия удостоверения личности учредителя гражданина Республики Казахстан;
- Заполненная форма по регистрации ТОО;                                                                   - ЭЦП на физ.лицо-учредителя# ' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                         - Сдача первичной стат.отчетности#' as [ServiceStepResult],'50000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 21 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],210 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо РК, директор гражданин РК' as [ServiceName],N'Получение ЭЦП на учредителя (юр.лицо РК)' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],3 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'30000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 22 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],210 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо РК, директор гражданин РК' as [ServiceName],N'Регистрация ТОО' as [ServiceStepName], N'См. услугу получение ЭЦП на учредителя (на юр.лицо РК)#                                    Регистрация ТОО копии учредительных документов:
-Устав;
-Учредительный договор;
-Решение учредителя/Протокол общего собрания учредителей; 
-Приказ на директора;
- Справка о зарегистрированном юридическом лице;
- Удостоверение личности директора гражданина Республики Казахстан;
- Заполненная форма по регистрации ТОО#                                                       - ЭЦП на юр.лицо-учредителя#
' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],3 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'30000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 23 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],220 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо РК, директор гражданин ЕВРАЗЭС' as [ServiceName],N'Получение ИИН на Директора гр. ЕВРАЗЭС' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'30000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 24 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],220 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо РК, директор гражданин ЕВРАЗЭС' as [ServiceName],N'Получение ЭЦП на учредителя (юр.лицо РК)' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'30000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 25 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],220 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо РК, директор гражданин ЕВРАЗЭС' as [ServiceName],N'Регистрация ТОО' as [ServiceStepName], N'См. услугу получение см. услугу получение ИИН (ЕВРАЗЭС)#                                        См. услугу получение ЭЦП на учредителя (на юр.лицо РК)#                                  Регистрация ТОО копии учредительных документов:
-Устав;
-Учредительный договор;
-Решение учредителя/Протокол общего собрания учредителей; 
-Приказ на директора;
- Справка о зарегистрированном юридическом лице;
- Копия паспорта директора гражданина ЕВРАЗЭС  с нотариально заверенным переводом на русском и казахском языках;
- Заполненная форма по регистрации ТОО;                                                                  - ЭЦП на юр.лицо-учредителя#' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'30000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 26 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],230 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо РК, директор гражданин нерезидент' as [ServiceName],N'Получение ИИН на Директора нерезидента' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#  ' as [ServiceStepResult],'30000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 27 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],230 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо РК, директор гражданин нерезидент' as [ServiceName],N'Получение ЭЦП на учредителя (юр.лицо РК)' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#  ' as [ServiceStepResult],'30000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 28 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N' Регистрация ТОО (учредитель физ.лицо и/или юр.лицо РК)' as [ServiceThematicGroup],230 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо РК, директор гражданин нерезидент' as [ServiceName],N'Регистрация ТОО' as [ServiceStepName], N'См. услугу получение см. услугу получение ИИН (неезидента)#                                         См. услугу получение ЭЦП на учредителя (на юр.лицо РК)#                                  Регистрация ТОО копии учредительных документов:
-Устав;
-Учредительный договор;
-Решение учредителя/Протокол общего собрания учредителей; 
-Приказ на директора;
- Справка о зарегистрированном юридическом лице#
Легализованная/Апостилированная копия паспорта, с нотариально заверенным переводом на казахский и русский язык директора нерезидента#
Форма на регистрацию#
ЭЦП на юр.лицо-учредителя#' as [ServiceStepRequiredDocument],N'Доверенность от юридического лица#   Учредителя компании установленного образца на представителя Ipravo (при необходимости)#' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#  ' as [ServiceStepResult],'30000' as [FromCost],'' as [ToCost],N'KZT' as  [Currency]
union all select 29 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],240 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор РК' as [ServiceName],N'Получение ИИН на Директора нерезидента' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'70000' as [FromCost],'70000' as [ToCost],N'KZT' as  [Currency]
union all select 30 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],240 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор РК' as [ServiceName],N'Получение ЭЦП на учредителя (юр.лицо РК)' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'70000' as [FromCost],'70000' as [ToCost],N'KZT' as  [Currency]
union all select 31 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],240 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор РК' as [ServiceName],N'Регистрация ТОО' as [ServiceStepName], N'Cм. услугу получение см. услугу получение ИИН (неезидента)#                                          Cм. услугу получение ЭЦП на учредителя (на юр.лицо РК)#                        Регистрация ТОО:                                                                                 - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
- Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС; 
- Заполненная форма по регистрации ТОО#' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'70000' as [FromCost],'70000' as [ToCost],N'KZT' as  [Currency]
union all select 32 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],250 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор ЕВРАЗЭС' as [ServiceName],N'Получение ИИН на Директора нерезидента' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#  ' as [ServiceStepResult],'70000' as [FromCost],'70000' as [ToCost],N'KZT' as  [Currency]
union all select 33 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],250 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор ЕВРАЗЭС' as [ServiceName],N'Получение ЭЦП на учредителя (юр.лицо РК)' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#  ' as [ServiceStepResult],'70000' as [FromCost],'70000' as [ToCost],N'KZT' as  [Currency]
union all select 34 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],250 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор ЕВРАЗЭС' as [ServiceName],N'Регистрация ТОО' as [ServiceStepName], N'См. услугу получение см. услугу получение ИИН (неезидента)#                                        См. услугу получение ЭЦП на учредителя (на юр.лицо РК)#                          Регистрация ТОО:                                                                                 - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
- Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС;         - Заполненная форма по регистрации ТОО#  
' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов:                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#  ' as [ServiceStepResult],'70000' as [FromCost],'70000' as [ToCost],N'KZT' as  [Currency]
union all select 35 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],260 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор нерезидент' as [ServiceName],N'Получение ИИН на Директора нерезидента' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'200000' as [FromCost],'200000' as [ToCost],N'KZT' as  [Currency]
union all select 36 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],260 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор нерезидент' as [ServiceName],N'Получение ЭЦП на учредителя (юр.лицо РК)' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'200000' as [FromCost],'200000' as [ToCost],N'KZT' as  [Currency]
union all select 37 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],260 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор нерезидент' as [ServiceName],N'Регистрация ТОО' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'200000' as [FromCost],'200000' as [ToCost],N'KZT' as  [Currency]
union all select 38 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],260 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор нерезидент' as [ServiceName],N'Регистрация компании в реестре Миграционной Полиции ' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'200000' as [FromCost],'200000' as [ToCost],N'KZT' as  [Currency]
union all select 39 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],260 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор нерезидент' as [ServiceName],N'Подача заявления в уполномоченный орган о смене директора на нерезидента Республике Казахстан' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'200000' as [FromCost],'200000' as [ToCost],N'KZT' as  [Currency]
union all select 40 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],260 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор нерезидент' as [ServiceName],N'Получение письма-приглашения с номером визовой поддержки' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'200000' as [FromCost],'200000' as [ToCost],N'KZT' as  [Currency]
union all select 41 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],260 as [ServiceNo],N'Регистрация ТОО учредитель физ.лицо гражданин ЕВРАЗЭС, директор нерезидент' as [ServiceName],N'Постановка в течении 5 (пяти) календарных суток на регистрационный учёт в УМС ДВД (по месту нахождения) по факту въезда на территорию Республики' as [ServiceStepName], N'См. услугу получение ИИН (неезидента)#                                        См. услугу получение ЭЦП на учредителя (на юр.лицо РК)#                     Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
- Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
- Заполненная форма по регистрации ТОО# 
См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""#                                                                                      См. ""визы для бизнеса в РК"" - получение визы С3#                                          ""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""# ' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'200000' as [FromCost],'200000' as [ToCost],N'KZT' as  [Currency]
union all select 42 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],270 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор РК' as [ServiceName],N'Получение ИИН на Директора нерезидента' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'110000' as [FromCost],'110000' as [ToCost],N'KZT' as  [Currency]
union all select 43 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],270 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор РК' as [ServiceName],N'Получение ЭЦП на учредителя (юр.лицо РК)' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'110000' as [FromCost],'110000' as [ToCost],N'KZT' as  [Currency]
union all select 44 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],270 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор РК' as [ServiceName],N'Получение БИН на юридическое лицо учредителя' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'110000' as [FromCost],'110000' as [ToCost],N'KZT' as  [Currency]
union all select 45 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],270 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор РК' as [ServiceName],N'Регистрация ТОО' as [ServiceStepName], N'См. услугу ""получение ИИН"" (неезидента)#                                          См. услугу ""получение ЭЦП"" на директора юридического лица учредителя#                                                                                           См. услугу ""получение БИН"" на юридическое лицо учредителя#                                                                 Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
- Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
- Заполненная форма по регистрации ТОО#' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'110000' as [FromCost],'110000' as [ToCost],N'KZT' as  [Currency]
union all select 46 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],280 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор ЕВРАЗЭС' as [ServiceName],N'Получение ИИН на Директора нерезидента' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'110000' as [FromCost],'110000' as [ToCost],N'KZT' as  [Currency]
union all select 47 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],280 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор ЕВРАЗЭС' as [ServiceName],N'Получение ЭЦП на учредителя (юр.лицо РК)' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'110000' as [FromCost],'110000' as [ToCost],N'KZT' as  [Currency]
union all select 48 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],280 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор ЕВРАЗЭС' as [ServiceName],N'Получение БИН на юридическое лицо учредителя' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'110000' as [FromCost],'110000' as [ToCost],N'KZT' as  [Currency]
union all select 49 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],280 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор ЕВРАЗЭС' as [ServiceName],N' Регистрация ТОО' as [ServiceStepName], N'См. услугу ""получение ИИН"" (неезидента)#                                          См. услугу ""получение ЭЦП"" на директора юридического лица учредителя#                                                                                           См. услугу ""получение БИН"" на юридическое лицо учредителя#                                                                Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
- Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
- Заполненная форма по регистрации ТОО#' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],5 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'110000' as [FromCost],'110000' as [ToCost],N'KZT' as  [Currency]
union all select 50 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],290 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор нерезидент' as [ServiceName],N' Получение ИИН на Директора нерезидента' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'260000' as [FromCost],'260000' as [ToCost],N'KZT' as  [Currency]
union all select 51 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],290 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор нерезидент' as [ServiceName],N' Получение ЭЦП на учредителя (юр.лицо РК)' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'260000' as [FromCost],'260000' as [ToCost],N'KZT' as  [Currency]
union all select 52 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],290 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор нерезидент' as [ServiceName],N'Получение БИН на юридическое лицо учредителя ' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'260000' as [FromCost],'260000' as [ToCost],N'KZT' as  [Currency]
union all select 53 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],290 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор нерезидент' as [ServiceName],N'Регистрация ТОО' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'260000' as [FromCost],'260000' as [ToCost],N'KZT' as  [Currency]
union all select 54 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],290 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор нерезидент' as [ServiceName],N'Регистрация компании в реестре Миграционной Полиции ' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'260000' as [FromCost],'260000' as [ToCost],N'KZT' as  [Currency]
union all select 55 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],290 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор нерезидент' as [ServiceName],N' Подача заявления в уполномоченный орган о смене директора на нерезидента Республике Казахстан' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'260000' as [FromCost],'260000' as [ToCost],N'KZT' as  [Currency]
union all select 56 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],290 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор нерезидент' as [ServiceName],N'Получение письма-приглашения с номером визовой поддержки ' as [ServiceStepName], N'' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'260000' as [FromCost],'260000' as [ToCost],N'KZT' as  [Currency]
union all select 57 as [RowNo], N'Корпоративное Право' as [ServiceCategory], N'Регистрация ТОО (учредитель физ.лицо и /или юр.лицо ЕВРАЗЭС)' as [ServiceThematicGroup],290 as [ServiceNo],N'Регистрация ТОО учредитель юр.лицо ЕВРАЗЭС, директор нерезидент' as [ServiceName],N'Постановка в течении 5 (пяти) календарных суток на регистрационный учёт в УМС ДВД (по месту нахождения) по факту въезда на территорию Республики Казахстан.                                                                         ' as [ServiceStepName], N'См. услугу ""получение ИИН"" для граждан стран-участниц ЕВРАЗЭС#                                         См. услугу ""получение ЭЦП"" на директора юридического лица учредителя#                                                                                           См. услугу ""получение БИН"" на юридическое лицо учредителя#                                                              Регистрация ТОО:                                                                                  - Электронно-цифровая подпись (ЭЦП) на каждого из учредителей;
- Копии паспортов учредителя и директора граждан стран-участников ЕВРАЗЭС (либо удостоверение личности гражданина Республики Казахстан);
- Заполненная форма по регистрации ТОО#
См. ""визы для бизнеса в РК"" - ""Регистрация приглашающей компании в миграционных органах""#                                                                                      См. ""визы для бизнеса в РК"" - получение визы С3#                                         ""визы для бизнеса в РК"" - см. ""Регистрация пребывающих иностранцев""#' as [ServiceStepRequiredDocument],N'Доверенность от физического лица учредителя компании установленного образца на представителя Ipravo (при необходимости)' as [ServiceStepDocument],30 as [ExecutionWorkDaysCnt],N'Зарегистрированное ТОО с полным пакетом разработанных учредительных документов;                          - Печать компании;
- ЭЦП (Электронно-Цифровая Подпись) на компанию;                                   - Учредительные документы;                          - Сдача первичной стат.отчетности#' as [ServiceStepResult],'260000' as [FromCost],'260000' as [ToCost],N'KZT' as  [Currency]

GO

use master 
GO

set nocount on;

--pk min values
--=================================
declare @serviceId int = 2; 
declare @serviceStepId int = 4; 
declare @serviceCode nvarchar(max) = ''

--dictionary preparation block
--=================================
declare @currencyTable table (
	id int,
	code nvarchar(max)
);
insert into @currencyTable(id, code)
select 1,	'KZT'
union all select 2, 'USD'
union all select 3, 'RUB'

declare @serviceCategoryTable table (
	id int,
	[name] nvarchar(max)
);
insert into @serviceCategoryTable(id, [name])
select 1,	'Регистрация бизнеса'
union all select 2,	'Недвижимость'
union all select 3,	'Семья'
union all select 4,	'Трудоустройство'
union all select 5,	'Налоги и финансы'
union all select 6,	'Бухгалтерия'
union all select 7,	'Гражданство, миграция, имиграция'
union all select 8,	'Представление в суде'
union all select 9,	'Строительство'

declare @serviceThematicGroupTable table (
	id int,
	categoryId int,
	[name] nvarchar(max)
);

insert into @serviceThematicGroupTable(id, categoryId, [name])
select 1,	1,	'Аутсорсинг'
union all select 2,	1,	'Бухгалтерские услуги'
union all select 3,	1,	'Юридические услуги'


--migration generation 
--=================================
declare 
	@rowNo [float],
	@serviceCategory [nvarchar](255),
	@serviceThematicGroup [nvarchar](255),
	@serviceNo [float],
	@prevServiceNo [float],
	@serviceName [nvarchar](255),
	@serviceStepName [nvarchar](255),
	@serviceStepRequiredDocument [nvarchar](max),
	@serviceStepDocument [nvarchar](255),
	@executionWorkDaysCnt [float],
	@serviceStepResult [nvarchar](255),
	@fromCost [float],
	@toCost [float] ,
	@currency [nvarchar](255);

declare  serviceXlsData cursor fast_forward for
select
	RowNo,
	ServiceCategory,
	ServiceThematicGroup,
	ServiceNo,
	rtrim(ltrim(ServiceName)),
	rtrim(ltrim(ServiceStepName)),
	rtrim(ltrim(ServiceStepRequiredDocument)),
	rtrim(ltrim(ServiceStepDocument)),
	ExecutionWorkDaysCnt,
	rtrim(ltrim(ServiceStepResult)),
	FromCost,
	ToCost,
	Currency
from  [dbo].[20180707_serviceList]
order by ServiceNo;

open serviceXlsData;

fetch next from  serviceXlsData
into
	@rowNo,
	@serviceCategory,
	@serviceThematicGroup,
	@serviceNo,
	@serviceName,
	@serviceStepName,
	@serviceStepRequiredDocument,
	@serviceStepDocument,
	@executionWorkDaysCnt,
	@serviceStepResult,
	@fromCost,
	@toCost,
	@currency;

set @prevServiceNo = '';
declare @stepNumber int = 1;

while @@FETCH_STATUS = 0 begin


	--insert service
	if(@prevServiceNo != @serviceNo) begin

		--check category and thematic group existance
		declare @serviceCategoryId int = 0;
		select
			@serviceCategoryId = id 
		from @serviceCategoryTable where lower(name) = lower(@serviceCategory)
		if (@serviceCategoryId = 0) begin
		
			select @serviceCategoryId = max(id) + 1
			from @serviceCategoryTable;
			insert into @serviceCategoryTable(id, [name])
			select @serviceCategoryId, @serviceCategory;

			declare @serviceCategoryTemplate nvarchar(max) = 
				'DB::statement(''' + char(10)                      
				+ '    insert into service_category(id, name, description)' + char(10)   
				+ '    values' + char(10)  
				+ '      (' + cast(@serviceCategoryId as nvarchar(max)) + ', \''' + @serviceCategory + '\'', \''' + @serviceCategory + '\'');' + char(10)                                                     
				+ ''');' + char(10)  
			print @serviceCategoryTemplate;

		end;
	
		declare @serviceThematicGroupId int = 0;
		select 
			@serviceThematicGroupId = id
		from @serviceThematicGroupTable
		where lower(name) = lower(@serviceThematicGroup)
		and categoryId = @serviceCategoryId;

		if (@serviceThematicGroupId = 0) begin

			select @serviceThematicGroupId = max(id) + 1
			from @serviceThematicGroupTable;
			insert into @serviceThematicGroupTable(id, categoryId, [name])
			select @serviceThematicGroupId, @serviceCategoryId, @serviceThematicGroup;

			declare @serviceThematicGroupTemplate nvarchar(max) = 
				'DB::statement(''' + char(10)                     
				+ '    insert into service_thematic_group (id, service_category_id, name, description)' + char(10)  
				+ '    values' + char(10) 
				+ '      (' + cast(@serviceThematicGroupId as nvarchar(max)) + ', ' + cast(@serviceCategoryId as nvarchar(max)) + ', \''' + @serviceThematicGroup + '\'', \''' + @serviceThematicGroup + '\'');' + char(10)                                                    
				+ ''');' + char(10) 
			print @serviceThematicGroupTemplate;

		end;


		print '//service - ' + cast(@serviceNo as nvarchar(max))
		set @serviceId += 1;

		declare @totalDaysCnt int = @executionWorkDaysCnt;
		select
			@totalDaysCnt = sum(isnull(ExecutionWorkDaysCnt,0))
		from [dbo].[20180707_serviceList]
		where ServiceNo = @serviceNo
		
		declare @serviceTemplate nvarchar(max) = 
			'DB::statement(''' + char(10)                     
			+ '    insert into service (id, service_thematic_group_id, code, name, description, execution_days_from, execution_days_to, is_active, service_start_date, service_end_date, comment) ' + char(10) 
			+ '    values' + char(10) 
			+ '      (' + char(10) 
			+ '          ' + cast(@serviceId as nvarchar(max)) + ', ' + cast(@serviceThematicGroupId as nvarchar(max)) + ',  ' + char(10) 
			+ '          \''' + cast(@serviceNo as nvarchar(max)) + '\'',' + char(10) 
			+ '          \''' + @serviceName + '\'' ,' + char(10) 
			+ '          \'''+ @serviceName + '\'',' + char(10) 
			+ '          ' + cast(@executionWorkDaysCnt as nvarchar(max)) + ',' + char(10) 
			+ '          ' + cast(@totalDaysCnt as nvarchar(max)) + ',' + char(10) 
			+ '          true,' + char(10) 
			+ '          \''2018-01-01\'',' + char(10) 
			+ '          null,' + char(10) 
			+ '          null' + char(10) 
			+ '      );' + char(10) 
			+ ''');' + char(10);
		print @serviceTemplate;
		set @prevServiceNo = @serviceNo;
		set @stepNumber = 1;
	end;

	--insert service step
	set @serviceStepId += 1;
	declare @serviceStepTemplate nvarchar(max) = 
		'DB::statement(''' + char(10) 
		+ '    insert into service_step (id, service_id, description, step_number, is_required, execution_work_day_cnt, counter_type_id, is_active)' + char(10) 
		+ '    values' + char(10)
		+ '    (' + cast(@serviceStepId as nvarchar(max)) + ',' + cast(@serviceId as nvarchar(max)) + ',\''' + @serviceStepName + '\'',' + cast(@stepNumber as nvarchar(max)) + ',true,' + cast(@executionWorkDaysCnt as nvarchar(max)) + ',1,true);' + char(10) 
		+ ''');' + char(10) 
	print @serviceStepTemplate;
	set @stepNumber += 1;

	--insert service step required documents
	declare @documentName nvarchar(max) = '';
	declare serviceStepTemplateRequiredDocument cursor fast_forward
	for
	select
		rtrim(ltrim(value))
	from string_split(@serviceStepRequiredDocument,'#')
	where ltrim(rtrim(value)) != ''
	open serviceStepTemplateRequiredDocument

	fetch next from serviceStepTemplateRequiredDocument
	into
		@documentName;

	declare @docNumber int = 1;
	while @@FETCH_STATUS = 0 begin
		
		declare @serviceStepTemplateRequiredDocument nvarchar(max) = 
			'DB::statement(''' + char(10) 
			+ '    insert into service_step_required_document (service_step_id, document_number, description, document_template_id)' + char(10) 
			+ '    values' + char(10) 
			+ '    (' + cast(@serviceStepId as nvarchar(max)) + ',' + cast(@docNumber as nvarchar(max)) +  ',\''' + @documentName + '\'',null);' + char(10) 
			+ ''');' + char(10) 
		print @serviceStepTemplateRequiredDocument;
		set @docNumber += 1;

		fetch next from serviceStepTemplateRequiredDocument
		into
			@documentName;
	end;

	close serviceStepTemplateRequiredDocument
	deallocate serviceStepTemplateRequiredDocument

	declare @stepResultName nvarchar(max) = '';
	declare serviceStepResultTemplate cursor fast_forward
	for
	select
		rtrim(ltrim(value))
	from string_split(@serviceStepResult,'#')
	where ltrim(rtrim(value)) != ''
	open serviceStepResultTemplate

	fetch next from serviceStepResultTemplate
	into
		@stepResultName;

	while @@FETCH_STATUS = 0 begin

		declare @serviceStepResultTemplate nvarchar(max) = 
			'DB::statement(''' + char(10) 
			+ '	insert into service_step_result (service_step_id, description)' + char(10) 
			+ '	values' + char(10) 
			+ '	(' + cast(@serviceStepId as nvarchar(max)) + ',\''' + @stepResultName + '\'');' + char(10) 
			+ ''');' + char(10) 
		print @serviceStepResultTemplate;

		fetch next from serviceStepResultTemplate
		into
			@stepResultName;
	end;
	
	close serviceStepResultTemplate;
	deallocate serviceStepResultTemplate;

	declare @currencyId int = 0;
	select
		@currencyId = id
	from @currencyTable
	where code = @currency;

	if(@currencyId = 0) begin
		declare @msg nvarchar(max)= 'Currency not found - ' + @currency;
		THROW 51000, @msg, 1;   
	end;

	declare @serviceStepCostHistTemplate nvarchar(max) = 
		'DB::statement(''' + char(10) 
		+ '	insert into service_step_cost_hist (service_step_id, cost, currency_id, created_by, create_date)' + char(10) 
		+ '	values' + char(10) 
		+ '	(' + cast(@serviceStepId as nvarchar(max)) + ',' + cast(@fromCost as nvarchar(max)) + ',' + cast(@currencyId as nvarchar(max)) + ',null,\''2018-01-01\'');' + char(10) 
		+ ''');' + char(10) 
	print @serviceStepCostHistTemplate;


	fetch next from  serviceXlsData
	into
		@rowNo,
		@serviceCategory,
		@serviceThematicGroup,
		@serviceNo,
		@serviceName,
		@serviceStepName,
		@serviceStepRequiredDocument,
		@serviceStepDocument,
		@executionWorkDaysCnt,
		@serviceStepResult,
		@fromCost,
		@toCost,
		@currency;

end;

close serviceXlsData;
deallocate serviceXlsData;