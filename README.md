# WARF (Web Application Request Forgery)

```
 * Dev: NuggaN85
 * Github: NuggaN85
 * Twitter: @NuggaN85
 * Copyright © 2023 All rights reserved.
 * MIT Licensed
```
 
Dans cet exemple, nous commençons par vérifier le jeton CSRF pour nous assurer que la soumission du formulaire est légitime. Si le jeton est valide, nous traitons le formulaire et générons un nouveau jeton CSRF pour une utilisation future.

Le formulaire HTML inclut un champ de jeton CSRF caché qui est envoyé avec la soumission du formulaire. Le jeton est généré en utilisant la fonction `random_bytes()` pour créer une chaîne aléatoire de 32 octets, puis converti en une chaîne hexadécimale pour une meilleure lisibilité.

Notez que cet exemple est très simple et qu'une implémentation réelle de WARF devrait inclure des mesures de sécurité supplémentaires telles que l'utilisation de cookies sécurisés et la configuration d'un délai d'expiration pour les jetons CSRF.
 
Chose faite, nous avons ajouté les mesures de sécurité suivantes :

Nous avons défini des constantes de configuration pour la durée de validité du jeton CSRF, le nom du cookie CSRF et la clé secrète utilisée pour signer le jeton CSRF.
Nous avons stocké le jeton CSRF dans un cookie sécurisé en utilisant la fonction `setcookie()` avec les options `secur`e et `httponly` pour protéger le cookie contre les attaques XSS et les interceptions réseau.
Nous avons vérifié le jeton CSRF à partir du cookie sécurisé en utilisant la fonction `hash_hmac()` pour calculer une signature de hachage du cookie et la clé secrète, puis la fonction `hash_equals()` pour comparer la signature avec le jeton CSRF stocké en session.
Nous avons supprimé le cookie CSRF expiré en utilisant la fonction `setcookie()` avec une durée de vie négative pour supprimer le cookie du navigateur.

--------------------------------------------------------------------------------------------------------------------------------------

## <strong>❤️</strong> (Contribuer) <strong>❤️</strong>

[![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg?style=flat)](https://www.paypal.me/nuggan85) [![GitHub issues](https://img.shields.io/github/issues/NuggaN85/Warf)](https://github.com/NuggaN85/Warf/issues) [![GitHub forks](https://img.shields.io/github/forks/NuggaN85/Warf)](https://github.com/NuggaN85/Warf/network) [![GitHub stars](https://img.shields.io/github/stars/NuggaN85/Warf)](https://github.com/NuggaN85/Warf/stargazers) [![GitHub license](https://img.shields.io/github/license/NuggaN85/Warf)](https://github.com/NuggaN85/Warf)

<a target="_blank" href="http://www.copyscape.com/"><img src="http://banners.copyscape.com/img/copyscape-banner-white-200x25.png" width="200" height="25" border="0" alt="Protected by Copyscape" title="Protected by Copyscape Plagiarism Checker - Do not copy content from this page." /></a>

--------------------------------------------------------------------------------------------------------------------------------------

- Signalez-nous les bugs que vous remarquez sur via [Github](https://github.com/NuggaN85/Warf/issues/).

- Nous-suggérez des modifications sur via [Github](https://github.com/NuggaN85/Warf/issues/).

- Suivez [@NuggaN85](https://twitter.com/NuggaN85) sur Twitter

- Discord : https://discord.gg/4gZsXRKdmJ

--------------------------------------------------------------------------------------------------------------------------------------
