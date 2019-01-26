# itchy-microframework

## This is a simple framework under development, don't use it in production!

**The structure is divided in 2 parts:**
1. /App - Web application
2. /Engine - Framework itself

Don't forget to run ```composer install```, developed under php 7.3 and nginx

### Entry point: /public/index.php
### Demo database on /setup/createSampleDb.sql

## Important: The classes `Request` and `Response` are just a placeholders, they have to be implemented following PSR-7



### TODO IN ORDER:

1. Write Unit test for All classes **<-Current step**
2. Fix localhost loop
3. Make sure that the classes follow SOLID principles
4. Implement a library for input validations
5. Implement a template manager **(Twig)**
6. Implement HTTP Message following PSR-7
7. Implement HTTP Handlers following PSR-15
8. Implement HTTP Factories following PSR-17
9. Implement HTTP Client following PSR-18
10. Implement ORM **(Doctrine)**
11. Implement Log system following PSR-3
12. Implement Container following PSR-11
