select * from service
where code  in ('ТОО_УЧ_ФЛ_РК_ДИР_РК', 'ТОО_УЧ_ЮЛ_ЕВРАЗЭС_ДИР_РК');

delete from service where id in  (1,2);
delete from service_journal where service_id in (1,2);


delete from service_step_result where service_step_id in (
	select id from  service_step where service_id in (1,2)
);

delete from service_step_required_document where service_step_id in (
	select id from  service_step where service_id in (1,2)
);

delete from service_step_cost_hist where service_step_id in (
	select id from  service_step where service_id in (1,2)
);

delete from service_step where service_id in (1,2);


delete from project where service_journal_id in (
	select id from service_journal where service_id in (1,2)
);

delete from task where project_id in (
	select id from project where service_journal_id in (
		select id from service_journal where service_id in (1,2)
	)
);

delete from task_hist where task_id in (
	select id from task where project_id in (
		select id from project where service_journal_id in (
			select id from service_journal where service_id in (1,2)
		)
	)
);

delete from service_journal_payment where service_journal_id in (
	select id from service_journal where service_id in (1,2)
);

delete from service_journal_step where service_journal_id in (
	select id from service_journal where service_id in (1,2)
);

delete from agreement_document where agreement_id in (
	select id from agreement where service_journal_id in (
		select id from service_journal where service_id in (1,2)
	)
);

delete from payment_invoice_document where payment_invoice_id in (
	select id from payment_invoice where agreement_id in (
		select id from agreement where service_journal_id in (
			select id from service_journal where service_id in (1,2)
		)
	)
);

delete from payment_journal where payment_invoice_id in (
	select id from payment_invoice where agreement_id in (
		select id from agreement where service_journal_id in (
			select id from service_journal where service_id in (1,2)
		)
	)
);


delete from payment_invoice where agreement_id in (
	select id from agreement where service_journal_id in (
		select id from service_journal where service_id in (1,2)
	)
);

delete from agreement where service_journal_id in (
	select id from service_journal where service_id in (1,2)
);


delete from invoice_document where invoice_id in (
	select id  from invoice where service_journal_id in (
		select id from service_journal where service_id in (1,2)
	)
);

delete from invoice where service_journal_id in (
	select id from service_journal where service_id in (1,2)
);



