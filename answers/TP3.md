## Question 1

The server refused the value `sleeping`: the rule `Rule::in(Ticket::STATUSES)` only accepts waiting, helping and done, so validation failed with the error "The selected status is invalid." The status of the ticket did not change. On my page the message is not displayed, because show.blade.php has no `@error('status')` block, so Laravel only redirected back to the ticket page. When I clicked again, the page had reloaded with the normal value `helping`, so it worked.


## Question 2

`Ticket::waiting()->toSql()` gives:

select * from "tickets" where "status" = ? order by "id" asc

The scope builds a query that selects the tickets whose status is "waiting", ordered by id. The `?` is a placeholder: Laravel sends the value 'waiting' separately, which protects against SQL injection.


## Question 3

My ticket page says 3 people ahead of me. In the queue, the Waiting section shows 4 tickets and mine is number 4, so there are 4 - 1 = 3 people before me: the numbers match. The tickets being helped and the done ones are not counted, because `$ahead` uses the `waiting()` scope.


## Question 4

The badges now show JSON, like {"id":3,"name":"Blade","created_at":"...","updated_at":"..."}, instead of just the name. The `topic` text column no longer exists, so `$ticket->topic` now calls the `topic()` relationship and returns the whole Topic object. When Blade prints an object with {{ }}, Laravel turns it into JSON. To show only the name, the views must use `$ticket->topic->name` (exercise 5).