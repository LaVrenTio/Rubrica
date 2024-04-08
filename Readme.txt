
Dopo aver creato il progetto Symfony, puoi aggiungere Doctrine eseguendo il seguente comando nella directory del tuo progetto:

```bash
composer require symfony/orm-pack
```

Questo comando installerà il pacchetto `symfony/orm-pack`, che include Doctrine insieme ad altri componenti correlati, come il bundle DoctrineBundle.

Dopo l'installazione, puoi configurare Doctrine nel tuo progetto Symfony seguendo la documentazione ufficiale di Symfony e Doctrine. 
Ad esempio, puoi configurare le connessioni al database e creare le entità Doctrine per mappare le tue tabelle del database.

Ricorda di eseguire i comandi `doctrine:schema:update --force` o `doctrine:migrations:migrate` per creare o 
aggiornare il database in base al tuo schema delle entità.