# TP2 answers

## Question 1

No, the names are different each time. `migrate:fresh` deletes all the tables and creates them again, then the seeder creates 8 new tickets. The factory uses `fake()`, which picks new random names, topics and sentences every time it runs.

## Question 2

`/tickets/999` gives a 404 Not Found page. I never wrote code to search for the ticket: the `Ticket $ticket` parameter of the `show()` method did it. Laravel sees `{ticket}` in the route, looks in the database for the ticket with id 999 (route model binding), and answers 404 because it does not exist.

## Question 3

I got a 404 Not Found. Laravel checks routes from top to bottom and uses the first one that matches. `/tickets/{ticket}` was above `/tickets/create` and `{ticket}` accepts any value, so Laravel thought `create` was a ticket id. It found no ticket with that id and answered 404. The create route was never reached.

## Question 4

Without `@csrf` I got the error 419 Page Expired. The token protects against CSRF attacks (Cross-Site Request Forgery): another website could make my browser send a form to this site without me knowing. `@csrf` adds a secret token to the form, and Laravel refuses any POST request that does not have the right token.
