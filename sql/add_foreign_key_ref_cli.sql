alter table commande 
add column ref_cli int unsigned not null after date_com
add foreign key fk_ref_cli(ref_cli)
references client(id)
on delete no action
on update cascade;