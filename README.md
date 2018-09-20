# Lynn Hosting

## License

All features from the hosted app are included in the open-source code. We offer a $15 per year white-label license to remove our branding for personal or business use.

### Branding Removal

To purchase a white-label license to remove our branding please email `sales@lynndigital.com`. Once your license key has been purchased you'll set it in your `.env` file for the Lynn Hosting Laravel Panel. The license key will then be inserted in a meta tag on all pages of your site. It allows us to determine if a license has been issued for a site or not, if you attempt to remove our branding without a license we will file a DMCA takedown request with your Domain and Web provider(s). If necessary legal action will be taken.

## About

Lynn Hosting is a full featured hosting panel with automated account setup, container deployment, and billing. Web Containers are powered by Docker and Docker PHP, each container is automatically deployed with an SSL certificate provided by Lets Encrypt. Because we use Docker containers, limited terminal access can be given to all users through our Web Terminal. 

## Support

To get support on setting up Lynn Hosting please contact `sales@lynndigital.com`. Please note, there may be a small fee. If you'd like one of our developers to install a fresh Lynn Hosting installation on your web server and locations please contact `sales@lynndigital.com`. We charge a $20 setup fee for a web server and up to three locations, any additional locations are $10.

### Prerequisites 

Note: you cannot run the panel and server locations on the same server.

To setup the Lynn Hosting Panel or a Server Location you must have root access to a Ubuntu >= 14.04 server with at least 2GB of RAM. We recommend [Digital Ocean](https://m.do.co/c/fab9d4a89a58), as they have an easy Cloud Firewall setup and Droplet Volumes.

We've only tested the installation of all componets on `Ubuntu 18.04`, with some modification our install scripts can run on other versions.

## Panel Setup

### Requirements

- MySQL 5.7 Database
- Redis Database
- PHP >= 7.2
- Mail Account
- Pusher Account
- Braintree Merchant Account

What's pusher? Pusher is used by Laravel Echo to manage Websocket connections. Lynn Hostings Panel uses Web Sockets to communicate with our Container Terminal. You can create a free account at [pusher.com](https://pusher.com).

By default we only support Braintree Gateway as a payment provider, they allow us to accept both Credit Card and PayPal payments. Apply for a Braintree Gateway account at [braintreepayments.com](https://apply.braintreegateway.com/signup/us).

With some modification, Lynn Hostings Panel can support Stripe payments. For more information on accepting Stripe please contact `sales@lynndigital.com`.

### Install

Clone `https://github.com/lynndigital/lynnhosting` into a directory of your choice. Move into the directory and open the `.env` file in your favorite text editor. You'll need to change a the following values.

| Key | Value | Example |
|---|---|---|
| `APP_NAME` | Website Name | `"Lynn Hosting"` |
| `APP_URL` | Website URL | `https://lynnhosting.com` |
| `DB_HOST` | Database Host | `localhost` |
| `DB_PORT` | Database Port | `3306` |
| `DB_DATABASE` | Database Name | `lynnhosting_panel` |
| `DB_USERNAME` | Database Username | `username` |
| `DB_PASSWORD` | Database Password | `password` |
| `REDIS_HOST` | Redis Host | `127.0.0.1` |
| `REDIS_PASSWORD` | Redis Password | `password` |
| `REDIS_PORT` | Redis Port | `6379` |
| `MAIL_HOST` | SMTP Server | `smtp.google.com` |
| `MAIL_PORT` | SMTP Server Port | `465` |
| `MAIL_USERNAME` | SMTP Username | `account@gmail.com` |
| `MAIL_PASSWORD` | SMTP Password | `password` |
| `MAIL_FROM_NAME` | SMTP From Name | `"Lynn Hosting"` |
| `PUSHER_APP_ID` | Pusher App ID | `0000000` |
| `PUSHER_APP_KEY` | Pusher App Key | `ajhusisnrnfjsja` |
| `PUSHER_APP_SECRET` | Pusher App Secret | `jhdiegdsjsjehfhsj` |
| `PUSHER_APP_CLUSTER` | Pusher App Cluster | `us2` |
| `BRAINTREE_MERCHANT_ID` | Braintree Merchant ID | `n.e.g` |
| `BRAINTREE_PUBLIC_KEY` | Braintree Public Key | `n.e.g` |
| `BRAINTREE_PRIVATE_KEY` | Braintree Private Key | `n.e.g` |

Once these values have been updated please save and reupload the `.env` file to your server. Then run the following commands:

```bash
$ sudo chgrp -R www-data storage bootstrap/cache
$ sudo chmod -R ug+rwx storage bootstrap/cache
$ php artisan key:generate
$ php artisan migrate
```

### Adding Plans

We use Laravels Artisan Command Wrapper for terminal commands, you can add locations and commands via the terminal. SSH into the installation directory and run `php artisan plan:new {name} {databases} {storage} {bandwidth} {emails} {domains} {price} {braintree_id}`. You must fill all values in brackets.

| argument | value |
|---|---|
| `name` | Plan Name |
| `databases` | # of Plan Databases |
| `storage` | Plan Storage in GB* |
| `bandwidth` | Plan Bandwidth in GB* |
| `emails` | # of Plan Email Accounts |
| `domains` | # of Domains per Plan |
| `price` | Plan Price |
| `braintree_id` | Braintree Plan ID |

Usage of `storage` and `bandwidth` is not automatically monitored. We are working on an integration to monitor the usage per container. 

### Adding Locations

We use Laravels Artisan Command Wrapper for terminal commands, you can add locations and commands via the terminal. SSH into the installation directory and run `location:new {name} {host} {port} {password}`. You must fill all values in brackets.

| argument | value |
|---|---|
| `name` | Location Display Name |
| `host` | Location Host |
| `port` | Location SSH Port |
| `password` | Location SSH Root Password |

The `root` password is required for all locations, full server access is necessary to manipulate containers and other componets. We are working on an integration that will allow the panel to use a non-root user with `sudo` privledges.

### Adding Pre-Install Softwares

We use Laravels Artisan Command Wrapper for terminal commands, you can add locations and commands via the terminal. SSH into the installation directory and run `software:add {name} {version} {cmd} {--before=} {--after=}`. You must fill all values in brackets.

| argument | value |
|---|---|
| `name` | Software Name |
| `version` | Software Version |
| `--before=` | Commands Run Before Software Install |
| `cmd` | Software Install Command |
| `--after=` | Commands Run After Software Install |

Use `&&` to join multiple commands, you can use `%h` to represent the containers home/web directory.

## Server Location Setup

To create a Lynn Hosting Server Location please execute `wget -O - https://gist.githubusercontent.com/0x15f/ef932499aa036a3808443fd44a8ac9a4/raw/15448c95cd7319e94bd0a213e805cfabebe5a109/install.sh | bash`. Once the script has ran please continue with the [More Steps](#more-steps) section.

### More Steps

Congrats! You've almost setup a server location. Only a few more things left to do.

You need to edit `/etc/ssh/sshd_config` on your Ubuntu Server to enable SFTP Only users. Open the file in your favorite text editor and comment out the line that starts with `Subsystem` then paste the snippet below into `sshd_config`.

```
Subsystem sftp internal-sftp
Match Group sftpusers
   ChrootDirectory %h
   ForceCommand internal-sftp
   X11Forwarding no
   AllowTCPForwarding no
   PasswordAuthentication yes
```

Now restart sshd `sudo service sshd restart`. Your server location has been setup!

TIP: If you use DigitalOcean, you can create a snapshot of your server and easily install it on other servers.
