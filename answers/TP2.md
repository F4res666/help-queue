# TP2 answers

## Question 1

No, the names are different each time. `migrate:fresh` deletes all the tables and creates them again, then the seeder creates 8 new tickets. The factory uses `fake()`, which picks new random names, topics and sentences every time it runs.

## Question 2

`/tickets/999` gives a 404 Not Found page. I never wrote code to search for the ticket: the `Ticket $ticket` parameter of the `show()` method did it. Laravel sees `{ticket}` in the route, looks in the database for the ticket with id 999 (route model binding), and answers 404 because it does not exist.

## Question 3

I got a 404 Not Found. Laravel checks routes from top to bottom and uses the first one that matches. `/tickets/{ticket}` was above `/tickets/create` and `{ticket}` accepts any value, so Laravel thought `create` was a ticket id. It found no ticket with that id and answered 404. The create route was never reached.

## Question 4

Without `@csrf` I got the error 419 Page Expired. The token protects against CSRF attacks (Cross-Site Request Forgery): another website could make my browser send a form to this site without me knowing. `@csrf` adds a secret token to the form, and Laravel refuses any POST request that does not have the right token.



## Exercise 5 results

1. Empty form: "The name field is required." and "The topic field is required."
2. Name but no topic: "The topic field is required." The name I typed stayed in the field.
3. Topic changed to Cooking: "The selected topic is invalid."

## Question 5

The name I typed is still in the field after the form is refused. This comes from `value="{{ old('name') }}"` in create.blade.php: when validation fails, Laravel redirects back to the form with the old values, and `old('name')` puts the name back in the input.

## Question 6

The user controls the browser, so they can change the HTML (like I did with the developer tools) or send a request without using the form at all. The limits in the form are only for display and can't be trusted. The server is the only place where the data can be checked for sure, here with `Rule::in(Ticket::TOPICS)` in the controller.


## Question 7

The delete form has two hidden fields:
- `_token`: added by `@csrf`. It is the secret CSRF token, so Laravel knows the form really comes from this site.
- `_method` with the value `DELETE`: added by `@method('DELETE')`. HTML forms can only send GET or POST, so the form is sent as POST and Laravel reads `_method` to treat it as a DELETE request, which matches the `tickets.destroy` route.



## Exercise 7: routes before

```
  GET|HEAD   tickets ........... tickets.index › TicketController@index
  POST       tickets ........... tickets.store › TicketController@store
  GET|HEAD   tickets/create .. tickets.create › TicketController@create
  GET|HEAD   tickets/{ticket} .... tickets.show › TicketController@show
  DELETE     tickets/{ticket} tickets.destroy › TicketController@destr…
```

## Exercise 7: routes after

```
    GET|HEAD   tickets ........... tickets.index › TicketController@index
    POST       tickets ........... tickets.store › TicketController@store
    GET|HEAD   tickets/create .. tickets.create › TicketController@create
    GET|HEAD   tickets/{ticket} .... tickets.show › TicketController@show
    DELETE     tickets/{ticket} tickets.destroy › TicketController@destr…
```


## Question 8

Nothing changed: the five routes have the same methods, URLs, names and controller methods as before, but now they are written in two lines instead of five. Route::resource works without any other change because my controller already follows Laravel's conventions: the methods are called index, create, store, show and destroy, the route names are tickets.index, tickets.create, etc., and the parameter is {ticket}, which matches `Ticket $ticket` in show() and destroy(). Route::resource creates exactly these routes automatically, and only() keeps the five I use (without edit and update).


