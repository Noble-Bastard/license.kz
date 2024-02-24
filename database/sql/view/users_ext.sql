create or replace view users_ext
as
select
    u.id,
    u.name,
    u.email,
    u.password,
    ur.role_id,
    r.name role_name,
    u.is_active
from users u
    left join user_role ur
    on ur.user_id = u.id
      left join role r
      on r.id = ur.role_id;
