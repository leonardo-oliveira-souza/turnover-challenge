# Turnover Challenge

Firt of all, you need to install Kool/Docker/DockerCompose - [https://kool.dev/docs/getting-started/installation](https://kool.dev/docs/getting-started/installation)

After that, run the follow commands

```
cp .env.example .env

kool start

kool run composer install

kool run yarn install

kool run yarn dev

kool run artisan key:generate

kool run artisan migrate --seed
```

Now you are able to access the `http://localhost`.

For admin access, use the follow credentials:
```
username: admin
password: qwe123
```