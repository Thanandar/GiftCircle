alter table users add budget float not null;

alter table users add marketing int(1) unsigned not null default 0;

alter table users add dob date not null;

alter table shops add domain varchar(255) not null;
alter table shops add deep_url text not null;
alter table gifts add affiliate_url text not null;
