-- MySQL syntax

-- Create the migrations tabel
create table if not exists migrations (
   id int(10) auto_increment primary key,
   migration varchar(255),
   create_at timestamp default current_timestamp
);