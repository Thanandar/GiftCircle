Circles of gifts

Random:
* how to "confirm a list" so that GC emails friends?
* friend email and login email will have to match to auth lists
* can you delete a list if someone's bought/reserved something from it?
* what happens when you remove a friend who's bought/reserved something?

Competitors:
* http://lifehacker.com/5414134/five-best-wishlist-tools


== MODELS ==

User
	first name
	surname
	email
	pw


Gift list
	owner_id
	name
	*Friends - find matching users by email
	*Gifts

Friends
	owner_id
	first name
	surname
	email
	birthday
	address

Gift
	name
	price
	url
	list_id
	category_id
	is_reserved
	is_purchased
	purchaser_id

Category
	name

Shop
	name
	url

Department
	shop_id
	category_id
	url

== CONTROLLERS ==

Home
	Home (& login)
User
	Register
	Login
	View all lists (my lists, friends lists, shopping list)
List
	Create
	View (shows gifts and friends)
Friend
	Add
Gift
	Add
Admin?

== VIEWS ==
lists of gifts (mine, friends, reserved)
friends on a list (circle)
products on a list
Add an existing / new friend to a list
add a gift to a list (browse link & form)
browse for an item (list of shops)
