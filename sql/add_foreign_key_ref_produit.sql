alter table lignescom 
add column ref_produit int unsigned not null after ref_commande,
add foreign key fk_ref_produit(ref_produit) 
references produit(idproduit)
on delete no action
on update cascade;