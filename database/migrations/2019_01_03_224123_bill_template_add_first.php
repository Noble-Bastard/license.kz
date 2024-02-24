<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BillTemplateAddFirst extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("                    
            insert into bill_template (id, name,content,country_id) 
            values
              (2, 'Счет Казахстан','<table cellspacing=\"0\" style=\"border-collapse:collapse; border:none; width:511pt\">
	<tbody>
		<tr>
			<td style=\"height:11.25pt; width:16pt\">&nbsp;</td>
			<td style=\"height:11.25pt; width:16pt\">&nbsp;</td>
			<td style=\"height:11.25pt; width:16pt\">&nbsp;</td>
			<td style=\"height:11.25pt; width:16pt\">&nbsp;</td>
			<td style=\"height:11.25pt; width:16pt\">&nbsp;</td>
			<td colspan=\"33\" rowspan=\"6\" style=\"height:11.25pt; text-align:center; vertical-align:middle; white-space:normal; width:431pt\"><span style=\"font-size:8pt\">&nbsp;Внимание! Оплата данного счета означает согласие с условиями поставки товара. Уведомление об оплате<br />
			&nbsp;обязательно, в противном случае не гарантируется наличие товара на складе. Товар отпускается по факту&nbsp; прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и документов удостоверяющих личность.</span></td>
		</tr>
		<tr>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
		</tr>
		<tr>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
		</tr>
		<tr>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
		</tr>
		<tr>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
		</tr>
		<tr>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
		</tr>
		<tr>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
		</tr>
		<tr>
			<td colspan=\"12\" style=\"height:12.75pt; vertical-align:bottom; white-space:nowrap\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
		</tr>
		<tr>
			<td colspan=\"20\" style=\"height:12.0pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>Бенефициар:&nbsp;</strong></span></td>
			<td colspan=\"10\" style=\"height:12.0pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>ИИК</strong></span></td>
			<td colspan=\"8\" style=\"height:12.0pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>Кбе</strong></span></td>
		</tr>
		<tr>
			<td colspan=\"20\" style=\"height:23.25pt; vertical-align:top; white-space:normal; width:288pt\"><span style=\"font-size:9pt\"><strong>Товарищество с ограниченной ответственностью &quot;Ipravo trade&quot;</strong></span></td>
			<td colspan=\"10\" rowspan=\"2\" style=\"height:23.25pt; text-align:center; vertical-align:middle; white-space:normal; width:128pt\"><span style=\"font-size:9pt\"><strong>KZ629470398991324756&nbsp;</strong></span></td>
			<td colspan=\"8\" rowspan=\"2\" style=\"height:23.25pt; text-align:center; vertical-align:middle; white-space:normal; width:95pt\"><span style=\"font-size:9pt\"><strong>17</strong></span></td>
		</tr>
		<tr>
			<td colspan=\"20\" style=\"height:12.0pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:9pt\">БИН: 180640019423</span></td>
		</tr>
		<tr>
			<td colspan=\"20\" style=\"height:12.0pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:9pt\">Банк бенефициара:</span></td>
			<td colspan=\"8\" style=\"height:12.0pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>БИК</strong></span></td>
			<td colspan=\"10\" style=\"height:12.0pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>Код назначения платежа</strong></span></td>
		</tr>
		<tr>
			<td colspan=\"20\" style=\"height:12.0pt; vertical-align:top; white-space:normal; width:288pt\"><span style=\"font-size:9pt\">АО ДБ &laquo;Альфа-Банк&raquo;</span></td>
			<td colspan=\"8\" style=\"height:12.0pt; text-align:center; vertical-align:top; white-space:normal; width:96pt\"><span style=\"font-size:9pt\"><strong>ALFAKZKA</strong></span></td>
			<td colspan=\"10\" style=\"height:12.0pt; text-align:center; vertical-align:top; white-space:normal; width:127pt\"><span style=\"font-size:9pt\"><strong>854</strong></span></td>
		</tr>
		<tr>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
		</tr>
		<tr>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
			<td style=\"height:11.25pt\">&nbsp;</td>
		</tr>
		<tr>
			<td colspan=\"38\" rowspan=\"2\" style=\"height:11.25pt; vertical-align:middle; white-space:nowrap\"><span style=\"font-size:14pt\"><strong>Счет на оплату № @bill_number от @date.</strong></span></td>
		</tr>
		<tr>
		</tr>
		<tr>
			<td colspan=\"38\" style=\"height:6.95pt; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:8pt\">&nbsp;</span></td>
		</tr>
		<tr>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
		</tr>
		<tr>
			<td colspan=\"4\" style=\"height:24.75pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:9pt\">Поставщик:</span></td>
			<td colspan=\"34\" style=\"height:24.75pt; vertical-align:top; white-space:normal; width:447pt\"><span style=\"font-size:9pt\"><strong>&nbsp;БИН / ИИН 180640019423,Товарищество с ограниченной ответственностью &quot;Ipravo trade&quot;,РК, г. Караганда, ул. Ержанова, 41/1</strong></span></td>
		</tr>
		<tr>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
		</tr>
		<tr>
			<td colspan=\"4\" style=\"height:12.75pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:9pt\">Покупатель:</span></td>
			<td colspan=\"34\" style=\"height:12.75pt; vertical-align:top; white-space:normal; width:447pt\"><span style=\"font-family:Arial,sans-serif\"><span style=\"font-size:12px\"><strong>@client_full_name</strong></span></span></td>
		</tr>
		<tr>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
		</tr>
		<tr>
			<td colspan=\"4\" style=\"height:12.75pt; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:10pt\">Договор:</span></td>
			<td colspan=\"34\" style=\"height:12.75pt; vertical-align:bottom; white-space:normal; width:447pt\"><span style=\"font-size:10pt\"><strong>Договор @agreement_no от @agreement_start_date года</strong></span></td>
		</tr>
		<tr>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
			<td style=\"height:6.95pt\">&nbsp;</td>
		</tr>
		<tr>
			<td colspan=\"2\" style=\"height:12.75pt; text-align:center; vertical-align:middle; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>№</strong></span></td>
			<td colspan=\"5\" style=\"height:12.75pt; text-align:center; vertical-align:middle; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>Код</strong></span></td>
			<td colspan=\"11\" style=\"height:12.75pt; text-align:center; vertical-align:middle; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>Наименование</strong></span></td>
			<td colspan=\"4\" style=\"height:12.75pt; text-align:center; vertical-align:middle; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>Кол-во</strong></span></td>
			<td colspan=\"3\" style=\"height:12.75pt; text-align:center; vertical-align:middle; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>Ед.</strong></span></td>
			<td colspan=\"6\" style=\"height:12.75pt; text-align:center; vertical-align:middle; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>Цена</strong></span></td>
			<td colspan=\"6\" style=\"height:12.75pt; text-align:center; vertical-align:middle; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>Сумма</strong></span></td>
			<td style=\"height:12.75pt\">&nbsp;</td>
		</tr>
		<tr>
			<td colspan=\"2\" style=\"height:11.25pt; text-align:center; vertical-align:top; white-space:normal; width:32pt\"><span style=\"font-size:8pt\">1</span></td>
			<td colspan=\"5\" style=\"height:11.25pt; text-align:left; vertical-align:top; white-space:normal; width:65pt\"><span style=\"font-size:8pt\">@code</span></td>
			<td colspan=\"11\" style=\"height:11.25pt; text-align:left; vertical-align:top; white-space:normal; width:167pt\"><span style=\"font-size:8pt\">@service_name</span></td>
			<td colspan=\"4\" style=\"height:11.25pt; text-align:right; vertical-align:top; white-space:normal; width:48pt\"><span style=\"font-size:8pt\">1,000</span></td>
			<td colspan=\"3\" style=\"height:11.25pt; text-align:left; vertical-align:top; white-space:normal; width:37pt\"><span style=\"font-size:8pt\">услуга</span></td>
			<td colspan=\"6\" style=\"height:11.25pt; text-align:right; vertical-align:top; white-space:normal; width:75pt\"><span style=\"font-size:8pt\">@service_cost @currency</span></td>
			<td colspan=\"6\" style=\"height:11.25pt; text-align:right; vertical-align:top; white-space:normal; width:82pt\"><span style=\"font-size:8pt\">@service_cost @currency</span></td>
			<td style=\"height:11.25pt; vertical-align:bottom; white-space:normal; width:5pt\">&nbsp;</td>
		</tr>
		<tr>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\">&nbsp;</td>
		</tr>
		<tr>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt; text-align:right; vertical-align:top; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>Итого:</strong></span></td>
			<td colspan=\"6\" style=\"height:12.75pt; text-align:right; vertical-align:top; white-space:normal; width:82pt\"><span style=\"font-size:9pt\"><strong>@total</strong></span></td>
			<td style=\"height:12.75pt\">&nbsp;</td>
		</tr>
		<tr>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
		</tr>
		<tr>
			<td colspan=\"38\" style=\"height:12.75pt; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:9pt\">Всего наименований 1, на сумму @total KZT</span></td>
		</tr>
		<tr>
			<td colspan=\"36\" style=\"height:12.75pt; vertical-align:top; white-space:normal; width:496pt\"><span style=\"font-size:9pt\"><strong>Всего к оплате: @total_str</strong></span></td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td style=\"height:12.75pt\">&nbsp;</td>
		</tr>
		<tr>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td style=\"height:6.95pt\"><span style=\"font-size:8pt\">&nbsp;</span></td>
		</tr>
		<tr>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
			<td style=\"height:8.25pt\">&nbsp;</td>
		</tr>
		<tr>
			<td colspan=\"4\" style=\"height:12.75pt; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:9pt\"><strong>Исполнитель</strong></span></td>
			<td style=\"height:12.75pt\">&nbsp;</td>
			<td colspan=\"16\" style=\"height:12.75pt; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:8pt\">&nbsp;</span></td>
			<td colspan=\"17\" style=\"height:12.75pt; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:8pt\">/@manager/</span></td>
		</tr>
	</tbody>
</table>',1);                        
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
