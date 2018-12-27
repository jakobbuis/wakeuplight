# Wake-up light
> Basic gradual wake-up light for the morning using a Yeelight II Color

## Installation
1. Install PHP and Git.
1. Clone the repository.
1. Copy `.env.example` to `.env` and add the IP-address of your Yeelight.
1. Run `php composer.phar install` to install all dependencies.
1. Create a cronjob to run `php wakeup.php` at the desired time (the program takes 15 minutes). Try [crontab.guru](https://crontab.guru) to build your ideal schedule.

## Copyright
Copyright [Jakob Buis](https://www.jakobbuis.nl) 2018. Currently proprietary, additional licensing to be determined later.
