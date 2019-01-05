# Wake-up light
> Basic gradual wake-up light for the morning using a Yeelight II Color

## Installation
1. Install PHP and Git.
1. Clone the repository.
1. Copy `.env.example` to `.env` and add the IP-address of your Yeelight.
1. Run `php composer.phar install` to install all dependencies.
1. Create a file named `trigger` at the root of the project containing the time you want the program to fire, in the "H:i" format, e.g. "06:45".
1. Create a cronjob to run `php wakeup.php` at every minute: `* * * * * php /opt/wakeuplight/wakeup.php`.

### Optional
1. A basic web form is included to easily change the timer when you want to sleep in for once. You can make the user interface accessible by executing `sudo php -S 0.0.0.0:80 -t public &` to run the server as a daemon.

## Copyright
Copyright [Jakob Buis](https://www.jakobbuis.nl) 2018. Currently proprietary, additional licensing to be determined later.
