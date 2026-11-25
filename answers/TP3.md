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



## Question 5

I got the message "The selected topic id is invalid." under the topic field. It comes from the rule `exists:topics,id` in store(): Laravel looks in the topics table for a row with id 99, does not find one, and refuses the form.



## Question 6

I clicked the "Git" badge and the page /topics/1 shows 2 tickets. The TopicController gets them with `$topic->tickets()`, the hasMany relationship of the Topic model, which selects the tickets whose topic_id is the id of this topic. This count includes all statuses (waiting, helping and done).



## Question 7

The list contains 10 items: the waiting tickets only, the same number as in the Waiting section of the queue, because the route uses the `waiting()` scope.

Each item has a `topic` object with the fields id, name, created_at and updated_at. It is there because of `with('topic')`.

Another program could use this data, for example a mobile app, a screen in the classroom that shows who is next, or a script in Python. JSON is a standard format that almost every language can read.



## Question 8

I could not swap with a neighbour yet, so I cloned my own repository into a new folder and followed my README. The first time, I ran `composer run dev` directly after cloning and got the error "Failed opening required vendor/autoload.php", because the vendor folder is not in Git: `composer install` creates it. After running all the README steps in order (composer install, npm install, copying .env, key:generate, migrate --seed answering yes), the project started and showed the queue with 8 tickets.





## Final questions

1. `Ticket::waiting()` selects the tickets whose status is "waiting", ordered by id. A scope is better than repeating the `where` because the rule is written in one place, in the model: the queue, the ticket page (people ahead) and `/queue.json` all use it, so if the rule changes I only change it once, and the code is easier to read.

2. The `topic_id` column is in the `tickets` table. A ticket belongs to one topic, but a topic has many tickets. Each ticket can store the one id of its topic, while a topic could not store a list of many ticket ids in a single column. So the foreign key always goes on the "many" side (belongsTo).

3. Besides a browser, `/queue.json` could be used by a mobile app, a screen in the classroom that shows who is next, a JavaScript front end, a script in Python, or a bot (for example on Discord) that announces the next person.