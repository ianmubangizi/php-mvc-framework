-- Postgres syntax
create table if not exists migrations (
  id serial primary key,
  migration varchar(255),
  create_at timestamp default current_timestamp
);

-- MySQL syntax
create table if not exists migrations (
   id int(10) auto_increment primary key,
   migration varchar(255),
   create_at timestamp default current_timestamp
);