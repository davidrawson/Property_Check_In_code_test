## Create Check Ins Lists

Install PHPUnit in the directory.
`composer require --dev phpunit/phpunit ^9`

Example of CLI command to run the class `CreateCheckInsLists.php`
`php -r 'include "CreateCheckInsLists.php"; CreateCheckInsLists::execute("application_forms.csv");'`

## Assumptions
- Check-ins with multiple tenants all move in on the same day and time.
- Check-ins can take up to 30 mins, and travelling time is 30 mins.