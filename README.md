## Create Check Ins Lists

Install PHPUnit in the directory.

`composer require --dev phpunit/phpunit ^9`


Run tests

`phpunit BookingTest.php`

`phpunit BookingListTest.php`

`phpunit CreateCheckInsListsTest.php`

CLI command to run the class 

`php -r 'include "CreateCheckInsLists.php"; CreateCheckInsLists::execute("application_forms.csv");'`

## Assumptions
- The csv file is to be placed in the same directory.
- Check-ins with multiple tenants in the same property all move in on the same day and time.
- Check-ins can take up to 30 mins, and travelling time is 30 mins.
