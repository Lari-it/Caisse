CREATE TABLE caisse(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    numero TEXT NOT NULL
);

CREATE TABLE produit(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    designation TEXT NOT NULL,
    prix REAL NOT NULL,
    stock INTEGER NOT NULL
);

CREATE TABLE achat(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    caisse_id INTEGER NOT NULL,
    date_achat DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(caisse_id)
        REFERENCES caisse(id)
);

CREATE TABLE detail_achat(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    achat_id INTEGER NOT NULL,
    produit_id INTEGER NOT NULL,
    quantite INTEGER NOT NULL,
    prix_unitaire REAL NOT NULL,
    FOREIGN KEY(achat_id)
        REFERENCES achat(id),
    FOREIGN KEY(produit_id)
        REFERENCES produit(id)
);