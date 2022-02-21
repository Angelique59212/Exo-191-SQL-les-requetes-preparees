<?php
require 'Config.php';
require 'Connect.php';
require 'DataCleaner.php';

try {
    /**
     * Créez ici votre objet de connection PDO, et utilisez à chaque fois le même objet $pdo ici.
     */
    $cleaner = new DataCleaner();
    $myConnexion = Connect::dbConnect();

    $name = $cleaner->dataClean($_POST['name']);
    $first_name = $cleaner->dataClean($_POST['first_name']);
    $mail = $cleaner->dataClean($_POST['mail']);
    $password = $cleaner->dataClean($_POST['password']);
    $address = $cleaner->dataClean($_POST['address']);
    $postal_code = $cleaner->dataClean($_POST['postal_code']);
    $country = $cleaner->dataClean($_POST['country']);

    /**
     * 1. Insérez un nouvel utilisateur dans la table utilisateur.
     */

    // TODO votre code ici.
    $stmt = $myConnexion->prepare("
        INSERT INTO user (name, first_name, mail, password, address, postal_code, country)
        VALUES ('D','Angel','angelique.dehainaut@gmail.com','azerty','35 rue francois boussus',59212, 'France')
    ");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':postal_code', $postal_code);
    $stmt->bindParam(':country', $country);
    $result = $stmt->execute();

    /**
     * 2. Insérez un nouveau produit dans la table produit
     */

    $name = $cleaner->dataClean($_POST['title']);
    $first_name = $cleaner->dataClean($_POST['price']);
    $mail = $cleaner->dataClean($_POST['short_description']);
    $password = $cleaner->dataClean($_POST['long_description']);
    // TODO votre code ici.
    $stmt = $myConnexion->prepare("
        INSERT INTO products(title, price, short_description, long_description) 
        VALUES ('Enceinte',19.90,'bluetooth',
                'ceci est une version plus longue de mon article pour avoir un texte plus long')
    ");

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':short_description', $short_description);
    $stmt->bindParam(':long_description', $long_description);
    $result = $stmt->execute();

    /**
     * 3. En une seule requête, ajoutez deux nouveaux utilisateurs à la table utilisateur.
     */

    // TODO Votre code ici.
    $stmt = $myConnexion->prepare( "
        INSERT INTO user(name, first_name, mail, password, address, postal_code, country) 
        VALUES ('Laure','Lou','louane@gmail.com','123','35 rue francois boussus',59212,'France'),    
               ('Lau','Luk','lukalaurent@gmail.com','azert','35 rue francois boussus',59212,'France')   
               
    ");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':postal_code', $postal_code);
    $stmt->bindParam(':country', $country);
    $result = $stmt->execute();
    /**
     * 4. En une seule requête, ajoutez deux produits à la table produit.
     */

    // TODO Votre code ici.
    $stmt = $myConnexion->prepare( "
            INSERT INTO products(title, price, short_description, long_description) 
            VALUES ('souris',9.99,'sans fil','il faut une descritpion beaucoup plus longue'),
                   ('jeux',15.99,'dame','cet article est conçu pour les enfants de plus de 10 ans')
        ");

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':short_description', $short_description);
    $stmt->bindParam(':long_description', $long_description);
    $result = $stmt->execute();
    /**
     * 5. A l'aide des méthodes beginTransaction, commit et rollBack, insérez trois nouveaux utilisateurs dans la table utilisateur.
     */

    // TODO Votre code ici.
    $myConnexion->beginTransaction();
    $stmt = $myConnexion->prepare("");
    $insert = 'INSERT INTO user(name, first_name, mail, password, address, postal_code, country) VALUES ';

    $sql1 = $insert ."('Maghue','Timeo','timeo@gmail.com','coucou','35 rue francois',59212,'France')";
    $stmt->execute($sql1);

    $sql2 = $insert ."('boubou','Tim','laurenttitit9@gmail.com','coucou','35 rue francois',59212,'France')";
    $stmt->execute($sql2);

    $sql3 = $insert ."('Deh','Pat','patrick@gmail.com','coucou','35 rue francois',59600,'France')";
    $stmt->execute($sql3);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':postal_code', $postal_code);
    $stmt->bindParam(':country', $country);

    $myConnexion->commit();

    /**
     * 6. A l'aide des méthodes beginTransaction, commit et rollBack, insérez trois nouveaux produits dans la table produit.
     */

    $myConnexion->beginTransaction();
    $stmt = $myConnexion->prepare("");
    $insert = 'INSERT INTO products(title, price, short_description, long_description) VALUES ';

    $sql4 = $insert ."('chaise',45, 'but', 'avec appui tête')";
    $stmt->execute($sql4);

    $sql5 = $insert ."('miroir',22.99, 'bic', 'rebords ondulés')";
    $stmt->execute($sql5);

    $sql6 = $insert ."('machine à laver',300.49, 'samsung', 'avec wifi')";
    $stmt->execute($sql6);

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':short_description', $short_description);
    $stmt->bindParam(':long_description', $long_description);

    $myConnexion->commit();
}

catch (PDOException $e) {
    echo "Erreur: " .$e->getMessage()."<br>";
    $myConnexion->rollBack();
}