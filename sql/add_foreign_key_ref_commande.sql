alter table lignescom 
add column ref_commande int unsigned not null after idligne,
add foreign key fk_ref_commande(ref_commande) 
references commande(idcommande)
on delete no action
on update cascade;