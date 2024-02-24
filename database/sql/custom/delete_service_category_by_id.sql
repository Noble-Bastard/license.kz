select @catalogid := catalog_id from service_category_catalog where service_category_id = 1;

delete from service_category_catalog where service_category_id = 1;

delete from catalog where catalog_parent_id = @catalogid;
delete from catalog where id = @catalogid;

delete from service_category where id = 1;