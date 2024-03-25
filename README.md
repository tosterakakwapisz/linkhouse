# Linkhouse

## Requirements

Composer and node.js to install dependencies. PHP 8.3 for Symfony 6.4

## Usage

Setup project

```bash
# install dependencies
composer install
npm install

# build frontend
# watch
npm run watch
# or just build
npm run dev
```

Then go to `http://localhost:8000/app` to launch frontend app.

There are 3 defined endpoints:

1. `/app` shows Vue app
1. `/articles` returns list of articles from  <https://linkhouse.pl/feed/>
1. `/article/{guid}` returns single article details. This uses integer from guid string. E.g. from `https://linkhouse.pl/?p=27269` route will use `27269` to retrieve article details. It is also implemented in Vue app to extract that integer portion.
