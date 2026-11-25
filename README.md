# Help Queue

A small Laravel application to manage a help queue in class: students join the queue with a form, a helper moves each ticket from waiting to helping to done, and tickets are grouped by topic.

## Requirements

- PHP 8.2 or newer
- Composer
- Node.js and npm

## Installation

```
git clone https://github.com/F4res666/help-queue.git help-queue
cd help-queue
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
composer run dev
```

The database file is not in Git: the `migrate` command offers to create it, answer **yes**.

Then open http://localhost:8000 in your browser.

## Useful pages

- `/tickets`: the queue
- `/tickets/create`: join the queue
- `/topics/1`: the tickets of one topic
- `/queue.json`: the waiting tickets as JSON