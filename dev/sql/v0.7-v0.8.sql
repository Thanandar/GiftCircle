
alter table gifts add cleared int(1) not null;

alter table gifts add bought_price varchar(255) not null;

alter table shops add orderfield int(10) not null;

