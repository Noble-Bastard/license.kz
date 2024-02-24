create or replace view service_ext
as
  select distinct
    s.id,
    s.description,
    s.is_active,
    s.name,
    s.code,
    s.service_start_date,
    s.service_end_date,
    s.service_thematic_group_id,
    stg.name service_thematic_group_name,
    s.execution_days_from,
    s.execution_days_to,
    s.counter_type_id,
    ct.name counter_type_name,
    ss.total_service_cost,
    ss.total_execution_work_day_cnt,
    ss.currency_id,
    crn.name currency_name,
    sctg.id as service_category_id,
    sctg.country_id,
    s.comment,
    srft.registration_form_template_id,
    rft.name registration_form_template_name,
    s.license_type_id,
    s.executive_agency,
    s.live_period,
    s.service_type_id,
    sc.base_cost,
    sc.additional_cost,
    sc.currency_id service_currency_id,
    crn_s.name service_currency_name,
    s.additional_approvals,
    s.special_terms,
    s.npa_link
  from service s
    left join service_thematic_group stg
      on stg.id = s.service_thematic_group_id
      left join service_category sctg
        on sctg.id = stg.service_category_id
    left join counter_type ct
      on ct.id = s.counter_type_id
    left join (select
                 ss.service_id,
                 sum(st.execution_work_day_cnt) total_execution_work_day_cnt,
                 sum(ch.cost) total_service_cost,
                 ch.currency_id
               from service_step_map ss
                 inner join (  select
                                service_step_id,
                                max(create_date) as max_create_date
                              from service_step_cost_hist
                              group by service_step_id) schm
                   on schm.service_step_id = ss.service_step_id
                    left join service_step st
                    on st.id = ss.service_step_id
                 inner join service_step_cost_hist ch
                   on ch.service_step_id = ss.service_step_id
                      and ch.create_date = schm.max_create_date
               group by ss.service_id, ch.currency_id) ss
      on ss.service_id = s.id
    left join (
        select
            sch.service_id,
            sch.base_cost,
            sch.additional_cost,
            sch.currency_id
        from
            service_cost_hist sch
            inner join (
                select
                    service_id,
                    max(create_date) as max_create_date
                from service_cost_hist
                group by service_id
            ) schmax
            on schmax.service_id = sch.service_id
            and schmax.max_create_date = sch.create_date
      ) sc
      on sc.service_id = s.id
    left join currency crn
      on crn.id = ss.currency_id
    left join currency crn_s
      on crn_s.id = sc.currency_id
    left join service_registration_form_template srft
    on srft.service_id = s.id
        left join registration_form_template rft
        on rft.id = srft.registration_form_template_id

