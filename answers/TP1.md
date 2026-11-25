# TP1 answers

## Question 1

The `.gitignore` file lists `/vendor` and `.env`, so Git never sends them to GitHub. `vendor/` contains all the libraries installed by Composer: it is very big and anyone can recreate it with `composer install`. `.env` contains the local configuration and secrets of my machine (the APP_KEY, database settings, passwords), which must not be published. Each person creates their own `.env` from `.env.example`.

## Exercise 2

| File | Information |
|---|---|
| routes/web.php | `Route::view('/', 'welcome')->name('home');` |
| .env | `DB_CONNECTION=sqlite` |
| database/migrations/ | 3 migrations (users, cache, jobs) |
| app/Models/User.php | name, email, password (written as `#[Fillable(['name', 'email', 'password'])]`) |

## Question 2

`/helo` gives a 404 Not Found error, because no route matches this address: I only defined `/hello`. Laravel compares the address with the routes in `routes/web.php` and finds none.

## Question 3

`/hello/a/b` gives a 404 because the parameter `{name}` only matches one part of the address, between two slashes. `/hello/a/b` has two parts after `/hello`, and no route has that shape.

## Question 4

The page shows the text `Hello <marquee>Bob!` as normal text: the `<marquee>` tag is not executed and nothing moves. `{{ }}` escapes the value: it turns special characters like `<` and `>` into harmless text before putting them in the HTML. This protects the site against XSS attacks, where someone would inject HTML or JavaScript through the address or a form.

## Question 5

The table has 7 columns: id, name, topic, description, status, created_at and updated_at. I did not write `created_at` and `updated_at` myself: they were created by the line `$table->timestamps();`.

## Question 6

`Add [name] to fillable property to allow mass assignment on [App\Models\Ticket].` (a `MassAssignmentException`).

## Question 7

My ticket has the number 4. The controller sorts the tickets with `orderBy('created_at')`, from the oldest to the newest, and my ticket was created last, after Lina, Omar and Sara.

## Final questions

1. The request goes through `public/index.php` (the entry point of Laravel), then `routes/web.php` finds the route `/tickets` and calls `TicketController@index`. The controller uses the model `app/Models/Ticket.php`, which reads the `tickets` table in the database. Then the controller returns the view `resources/views/tickets/index.blade.php`, which extends the layout `resources/views/layouts/app.blade.php`. The resulting HTML is sent back to the browser.

2. A migration is a file that describes how to create or change a table, in PHP code. It is better than a table created by hand because it is saved in Git with the project: anyone can rebuild exactly the same database with `php artisan migrate`, the changes are kept in order, and they can be undone with `down()`.

3. `Ticket::create(...)` failed because Laravel blocks mass assignment by default: it refuses to fill fields from an array unless the model lists them in `$fillable`. This protects against a user sending extra fields (for example `status` or `is_admin`) through a form.