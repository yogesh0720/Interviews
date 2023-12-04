<?php
table - bills : 
id, amount, user_id
1 10 1
2 20 1
3 30 2
4 40 2
5 50 3
6 60 3
7 70 1

table - users : 
id, email, deleted
1 abc@mail.com 1
2 pqr@mail.com 1
3 test@mail.com 0 

table - subscriptions : 
id, user_id, type
1 1 monthly
2 2 monthly
3 3 monthly


find 4th, 5th, 6th, 7th  highest bill amount for non deleted users with subscription type = monthly for given email ids;

select bills.amount
from bills 
join users on bills.userid = users.id
join subscriptions on subscriptions.userid = users.id
where subscriptions.type = 'monthly' and users.deleted='1' and email in ('abc@mail.com', 'pqr@mail.com')
order by bills.amount desc;


Class A     {    }
 
    $object1 = new A    $object2 = new A    $object3 = new A    $object4 = new A    $object5 = new A
 
    --- so on.
 
    Here i can create many objects of a same class.
 
    Please write a logic, in which an Class can be instantiated only 4 times, if it exceeds, then throw an exception.


