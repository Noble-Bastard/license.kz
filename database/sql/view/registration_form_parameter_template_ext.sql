create or replace view registration_form_parameter_template_ext
as
  select
    rfpt.id,
    rfgt.registration_form_template_id,
    rfpt.registration_form_group_template_id,
    pg.name registration_form_group_template_name,
    rfgt.order_number registration_form_group_template_order_number,
    rfpt.parameter_type_id,
    pt.name parameter_type_name,
    pt.data_type parameter_type_data_type,
    rfpt.caption,
    rfpt.is_active,
    rfpt.comment,
    rfpt.order_number,
    rfpt.optionset_type_id,
    ot.name optionset_type_name,
    ovt.optionset_id_list,
    ovt.optionset_value_list,
    pds.date_format parameter_datetime_format,
    pds.default_value parameter_datetime_default_value,
    pns.max_value parameter_number_max_value,
    pns.min_value parameter_number_min_value,
    pns.round_type parameter_number_round_type,
    pns.default_value parameter_number_default_value,
    pts.validation_mask parameter_text_validation_mask,
    pts.default_value parameter_text_default_value
  from registration_form_parameter_template rfpt
    left join registration_form_group_template rfgt
      on rfgt.id = rfpt.registration_form_group_template_id
    left join parameter_group pg
      on pg.id = rfgt.parameter_group_id
    left join parameter_type pt
      on pt.id = rfpt.parameter_type_id
      left join parameter_datetime_setting pds
      on pds.parameter_type_id = pt.id
      left join parameter_number_setting pns
        on pns.parameter_type_id = pt.id
      left join parameter_text_setting pts
        on pts.parameter_type_id = pt.id
    left join optionset_type ot
      on ot.id = rfpt.optionset_type_id
    left join (select
                 optionset_type_id,
                 group_concat(optionset_value SEPARATOR ';') optionset_value_list,
                 group_concat(optionset_id SEPARATOR ';') optionset_id_list
               from optionset_value_template
               group by optionset_type_id) ovt
      on ovt.optionset_type_id = ot.id


