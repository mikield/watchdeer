# Installation

1. Clone the repo
2. Run `composer install`
3. Create file (if not exists) `db/database.db`
4. Run `php vendor/bin/phinx migrate`
5. Run `php vendor/bin/phinx seed:run`
6. Run `php -S localhost:8000` and [click here](http://localhost:8000)



* You can config project settings in `app/config.php`
* And migrations settings in `phinx.yml`


# Copyright

Originally this code was created by me for [Daniel Kabanov](https://github.com/draobrehtom) and was published at his user name space.

But we have decided to move the code under my user name space as the code is authored by me.
